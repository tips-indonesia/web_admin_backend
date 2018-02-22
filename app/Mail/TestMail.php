<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $name = "";
    private $email = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $nama)
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.tes')
                    ->with("name", $this->name)
                    ->with("email", $this->email)
                    ->subject("[no-reply] Your email password reset.");
    }
}
