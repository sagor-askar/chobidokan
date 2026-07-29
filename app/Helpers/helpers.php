<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

if (!function_exists('send_custom_email')) {
    /**
     * Helper function to send custom emails using Blade views.
     *
     * @param string $to Recipient email address
     * @param string $subject Email subject
     * @param string $view Blade view name (e.g., 'emails.signup_verification')
     * @param array $data Data array to pass to the view
     * @return bool
     */
    function send_custom_email($to, $subject, $view, $data = [])
    {
        try {
            Mail::send($view, $data, function ($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
            });
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email to {$to}. Error: " . $e->getMessage());
            return false;
        }
    }
}
