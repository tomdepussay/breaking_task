<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class ResetPasswordNotification extends Notification
{
    protected $token;
    protected $notifiable;

    public function __construct($token, $notifiable)
    {
        $this->token = $token;
        $this->notifiable = $notifiable;

        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->notifiable->getEmailForPasswordReset()
        ], false));

        $response = Http::withToken(env('RESEND_API_KEY'))->post('https://api.resend.com/emails', [
            'from' => env('RESEND_FROM'),
            'to' => $this->notifiable->email,
            'subject' => 'Réinitialisation de votre mot de passe',
            'html' => view('emails.reset-password', ['resetUrl' => $resetUrl])->render(),
        ]);

        if ($response->failed()) {
            logger()->error('Resend reset password email failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
    }

    public function via($notifiable)
    {
        return [];
    }
}
