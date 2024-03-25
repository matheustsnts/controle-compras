<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use stdClass;

class newLaravelTips extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct(stdClass $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $this->subject('Novo episódio está no ar');
        $this->to($this->user->email, $this->user->name);
        Mail::send(new newLaravelTips($this->user));
    }
}
