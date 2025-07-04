<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Project;
use App\Models\Story;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function projectStore(Request $request)
    {
        $data = $request->all();
        $data['user_id'] =  Auth::user()->id;
        $data['status'] =  1;
        $data['publish_date'] =Carbon::now()->format('Y-m-d');

        $project = Project::create($data);

        if ($request->hasFile('project_file')) {
            $file = $request->file('project_file');
            $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/project/' . $fileName;
            $file->move(public_path('uploads/project'), $fileName);
            $project->project_file = $filePath;
        }
        $project->save();

        $subscription = Subscription::find($request->subscription_id);

        Order::create([
            'project_id' => $project->id,
            'user_id' => Auth::user()->id,
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price,
        ]);

        return redirect()->route('welcome')->with('success', 'Successfully Post Submitted!');
    }
}
