<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendPostedEmail;
use App\MiniSend\Activities\EmailTransactionActivity;
use App\MiniSend\Utils\Constants;


class EmailPostedListener implements ShouldQueue
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
        if( $event->email )
        {
            Mail::to( $event->email->to )->send( new SendPostedEmail( $event->email ) );
        }
        
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed( $event, $exception )
    {
        Log::info( "Job Failed Event Exception" );
        Log::info( $event->email );
        if( $event->email )
        {
            $event->email->status( Constants::STATUS_FAILED );
        }
    }
}
