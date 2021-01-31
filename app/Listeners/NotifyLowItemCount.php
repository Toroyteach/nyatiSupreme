<?php

namespace App\Listeners;

use App\Events\LowItemCount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyLowItemCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LowItemCount  $event
     * @return void
     */
    public function handle(LowItemCount $event)
    {
        //
        dd($event->lowCountData);
    }
}
