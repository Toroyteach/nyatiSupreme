<?php

namespace App\Listeners;

use App\Events\OrderStatusChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatuschangeMail;
use Notification;
use App\Notifications\OrderCompleted;
use App\Models\Admin;
use Carbon\Carbon;

class SendEmailNotification implements ShouldQueue
{
    /**
     * Handle the event. this sends email to customers on status change
     *
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChangedEvent $event)
    {
        //
        Mail::to($event->order['email'])->send(new OrderStatuschangeMail($event->order));

        $userSchema = Admin::all();
        $when = Carbon::now()->addSecond(10);
        Notification::send($userSchema, (new OrderCompleted($event->order))->delay($when));
    }
}
