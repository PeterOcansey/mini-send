<?php 
    namespace App\MiniSend\Traits;

    use Illuminate\Http\Request;
    use App\MiniSend\Events\ErrorEvents;
    use App\MiniSend\Api\ApiResponse;
    use App\MiniSend\Utils\Generators;
    use App\MiniSend\Utils\Constants;
    
    trait EmailTrait {

        private function uid()
        {
            $email_uid = '';
            do {
                $email_uid = Generators::generateEmailUid();
            } while ( $this->emailTransactionRepo->getEmailTransactionByUid( $email_uid ) );

            return $email_uid;
        }

        public function status( String $status )
        {
            $this->status = $status;
            $this->update();

        }

        public function getAttachments()
        {
            //Generate attachemnt urls
            $attachment_urls = [];
            $attachments = $this->attachments;
            if( $attachments && count( $attachments ) > 0 )
            {
                foreach( $attachments as $attachment )
                {
                    array_push( $attachment_urls, env('APP_URL') . "/storage/" . $attachment->file_name );
                }
            }
            
            $this['attachment_urls'] = $attachment_urls;

            //Remove the attachments object from the transaciton
            unset( $this['attachments'] );
        }

    }
?>