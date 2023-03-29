<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use Illuminate\Database\Eloquent\Collection;


//model
use App\Models\User;


class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $User;
    protected $MerchandiseCollection;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $User , Collection $MerchandiseCollection)
    {
        $this->User = $User;
        $this->MerchandiseCollection = $MerchandiseCollection;

        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail_binding=[
            'user'=>$this->User,
            'merchandise_data'=>$this->MerchandiseCollection
        ];

        Mail::send(
            'email.NewMerchandiseMail',
            $mail_binding,
            function($mail)use($mail_binding){
                $mail->to($mail_binding['user']->email);
                $mail->from('sxs0507@gmail.com');
                $mail->subject('最新商品資訊');
            });
    }
}
