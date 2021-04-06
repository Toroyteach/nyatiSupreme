<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;

//this listener sends a welcom email to newly created user

class SendWelcomeEmail implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //
        //dd('call mail listener');
        Mail::to($event->user->email)->send(new WelcomeNewUserMail());
    }
}
