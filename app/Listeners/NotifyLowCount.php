<?php

namespace App\Listeners;

use App\Events\LowCount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Notification;
use App\Models\Admin;
use Carbon\Carbon;
use App\Notifications\LowCountNotification;
use App\Mail\LowCountEmail;

class NotifyLowCount
{
    /**
     * Handle the event.
     *
     * @param  LowCount  $event
     * @return void
     */
    public function handle(LowCount $event)
    {
        //mail to admin

        $userSchema = Admin::all();
        $when = Carbon::now()->addSecond(0);
        dd($event->lowCountData);
        Notification::send($userSchema, (new LowCountNotification($event->lowCountData))->delay($when));

        foreach($userSchema as $user) {
            Mail::to($user)->send(new LowCountEmail($event->lowCountData));
         }
    }
}
