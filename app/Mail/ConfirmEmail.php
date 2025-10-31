<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Confirme seu e-mail - DevsAPI')
            ->view('emails.confirm')
            ->with([
                'name'  => $this->user->name,
                'email' => $this->user->email,
                'token' => $this->token,
            ]);
    }
}
