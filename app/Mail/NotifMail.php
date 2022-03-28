<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $users;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        //
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.notif-mail')
        ->to($this->users);
    }
}
