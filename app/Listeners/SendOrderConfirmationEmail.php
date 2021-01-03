<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderConfirmationMail;
use App\Events\OrderPlaced;
//use Illuminate\Auth\Events\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Notification;
use App\Notifications\newOrderNotification;
use App\Models\Admin;

class SendOrderConfirmationEmail
{

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        //
        //dd($event->order['grand_total']);
        Mail::to($event->order['email'])->send(new OrderConfirmationMail($event->order));

        $userSchema = Admin::all();
        $when = Carbon::now()->addSecond(10);
        Notification::send($userSchema, (new newOrderNotification($event->order))->delay($when));
    }
}
