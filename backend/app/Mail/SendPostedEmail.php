<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTransaction;

class SendPostedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public EmailTransaction $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailTransaction $email)
    {
        //
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;

        $this->withSwiftMessage(function ( $message ) use( $email ) {
            $message->getHeaders()->addTextHeader(
                'Mini-Send-UID', $email->uid
            );
        })
        ->from($email->from)
        ->subject($email->subject);

        $email->is_html ? $this->view('emails.posted-html') :  $this->text('emails.posted-text');

        return $this;
    }
}
