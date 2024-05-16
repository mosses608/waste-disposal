<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Alphaolomi\Azampay\Events\AzampayCallback;

class AzampayCallbackListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AzampayCallback  $event): void
    {
        //
    }

}
