<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//          https://laravel.com/docs/8.x/mail#configuration
          return $this
              ->from('PitCanasta@PitCanasta.com')
              ->subject('Thank you for Registering with Pit Canasta')
              ->replyTo('Verify@PitCanasta.com')
              ->view('auth.register');
    }
}
