<?php

namespace App\Helpers\Mail;

use Illuminate\Support\Facades\Mail;

trait MailHelper
{

    public function sendMailForUserCreate($user)
    {
        $subject = 'Mail from karaoke';
        $data = [
            'title' => 'Account created for ' . $user->name,
            'body' => 'Your account has been created successfully. Please login to your account. Please click on the link to login.' . env('APP_BASE_URL') . '',
        ];
        $this->sendMail($user->email, $subject, 'mails.user', $data);
    }

    public function sendMail($to, $subject, $view, $data = [])
    {
        $details = [
            'to' => $to,
            'subject' => $subject,
            'view' => $view,
            'data' => $data
        ];
        Mail::to($to)->send(new \App\Mail\SendMail($details));
    }
}
