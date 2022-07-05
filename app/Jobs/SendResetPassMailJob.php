<?php

namespace App\Jobs;

use App\Mail\ResetPassMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendResetPassMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $new_password;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $new_password)
    {
        $this->user = $user;
        $this->new_password = $new_password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Redis::throttle('reset-pass')->allow(2)->every(1)->then(function () {
            Mail::to($this->user->email)->send(new ResetPassMail($this->user->name, $this->new_password));
        }, function () {
            return $this->release(2);
        });
    }
}
