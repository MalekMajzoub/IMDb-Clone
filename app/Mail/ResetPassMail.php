<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class ResetPassMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $new_password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $new_password)
    {
        $this->name = $name;
        $this->new_password = $new_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset-pass');
    }
}
