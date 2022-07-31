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

    }
?>