<?php

namespace App\Listeners;

use App\Events\OrderStatusChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatuschangeMail;

class SendEmailNotification
{
    /**
     * Handle the event.
     *
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChangedEvent $event)
    {
        //
        Mail::to($event->order['email'])->send(new OrderStatuschangeMail($event->order));
    }
}
