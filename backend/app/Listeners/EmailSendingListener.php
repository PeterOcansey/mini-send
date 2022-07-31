<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class EmailSendingListener
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
     * @param  object  $event
     * @return void
     */
    public function handle( $event )
    {
        $event->message->getHeaders()
        ->addTextHeader("X-Mailgun-Variables", json_encode([
            "type" => "verification",
            "id"   => "123456"
        ]));
    }
}
