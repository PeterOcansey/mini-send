<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\MiniSend\Activities\EmailTransactionActivity;
use App\MiniSend\Utils\Constants;

class EmailSentListener
{
    private EmailTransactionActivity $emailActivity;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( EmailTransactionActivity $emailActivity )
    {
        $this->emailActivity = $emailActivity;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle( $event )
    {
        Log::info( $event->message );
        Log::info( $event->data );

        //EmailTransactionActivity
        $emailTransaction = $this->emailActivity->getEmailTransactionByUid( $event->message->message['Mini-Send-UID'] );
        if( $emailTransaction )
        {
            $emailTransaction->status( Constants::STATUS_SENT );
        }

    }
}
