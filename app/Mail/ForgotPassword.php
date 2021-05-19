<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params = null) {

        $this->params = $params;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Api::email.forgot-password')->subject('[CAS] Mã xác thực quên mật khẩu')->with($this->params);
    }
}
