<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Jetsky;

class JetskyInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $jetsky;

    public function __construct(User $user, Jetsky $jetsky)
    {
        $this->user = $user;
        $this->jetsky = $jetsky;
    }

    public function build()
    {
        return $this->view('jetsky_info');
    }
}
