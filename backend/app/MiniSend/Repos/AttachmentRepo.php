<?php

namespace App\MiniSend\Repos;

use App\Models\Attachment;
use App\MiniSend\Utils\Constants;


class AttachmentRepo
{

    public function saveAttachments( Array $data, $email_transaction_id )
    {
        $attachments = [];
        foreach( $data as $attachment)
        {
            $attachment['email_transaction_id'] = $email_transaction_id;
            array_push($attachments, Attachment::create( $attachment ) );
        }

        return $attachments;
    }
}