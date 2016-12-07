<?php

namespace App\Listeners;

use App\Events\BuyEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BuyListener
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
     * @param  BuyEvent  $event
     * @return void
     */
    public function handle(BuyEvent $event)
    {
        //
        $event->take();
    }
}
