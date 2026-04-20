<?php

namespace App\Console;

use App\Models\DesignerPayment;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // Expire subscription purchases automatically
        $schedule->call(function () {
            \App\Models\SubscriptionPurchase::where('status', 1)
                ->whereDate('expire_date', '<', now()->toDateString())
                ->update(['status' => 0]);
        })->everyMinute();


        $schedule->call(function () {
            $setting = Setting::first();
            $job_auto_approve_days = $setting ? (int)$setting->job_auto_approve_days : 0;

            $projects = \App\Models\Project::where('status', 1)->get();
            foreach ($projects as $project) {
               $checkOrderStatus = \App\Models\OrderDetails::where('project_id', $project->id)->first();

               if ($checkOrderStatus && $checkOrderStatus->created_at) {
                   $approveDate = \Carbon\Carbon::parse($checkOrderStatus->created_at)->addDays($job_auto_approve_days);

                   if (now()->greaterThanOrEqualTo($approveDate)) {
                       $project->update(['status' => 2]);
                   }
               }
            }
        })->everyMinute();

        // Expire projects and update linked order status
        $schedule->call(function () {
            // Find active projects that have passed their expire_date
            $expiredProjects = \App\Models\Project::where('status', '!=', 0)
                ->whereDate('expire_date', '<', now()->toDateString())
                ->get();

            foreach ($expiredProjects as $project) {
                // Update the project status to 0
                $project->update(['status' => 0]);

                $order = Order::where('project_id', $project->id)->where('status',0)->first();
                if ($order) {
                     Payment::create([
                        'order_id' => $order->id,
                        'project_id' => $order->project_id,
                        'user_id' => $order->user_id,
                        'amount' =>  $order->amount,
                        'card_type'=>$order->card_type ?? null,
                        'bank_txn' => $order->bank_txn ?? null,
                        'designer_paid_status' => 0,
                    ]);
                    $order->status = 2;
                    $order->save();
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
