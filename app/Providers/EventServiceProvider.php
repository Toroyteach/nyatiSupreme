<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            // \App\Listeners\SendEmailVerificationNotification::class,
             \App\Listeners\SendWelcomeEmail::class,
        ],
        \App\Events\OrderPlaced::class => [
            \App\Listeners\SendOrderConfirmationEmail::class,
        ],
        \App\Events\OrderStatusChangedEvent::class => [
            \App\Listeners\SendEmailNotification::class,
        ],
        \App\Events\LowCount::class => [
            \App\Listeners\NotifyLowCount::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
