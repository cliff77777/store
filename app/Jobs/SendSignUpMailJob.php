<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendSignUpMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mail_binding;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_binding)
    {
        //
        $this->mail_binding=$mail_binding;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $mail_binding=$this->mail_binding;
        Mail::send(
            'email.signUpEmailNotification',
            $mail_binding,
            function($mail) use ($mail_binding){
                $mail->to($mail_binding['email']);
                $mail->from(env('MAIL_USERNAME'));
                $mail->subject("恭喜您完成註冊!!");
            } 
        );

    }
}
