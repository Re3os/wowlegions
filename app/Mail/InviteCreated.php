<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Invite;

class InviteCreated extends Mailable
{

    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    public function build() {
        return $this->from(config('app.email_robot'))->view('mail.invite')->with(['invite' => $this->invite])->subject('Приглашение на игровой сервер ' . config('app.name'));
    }
}
