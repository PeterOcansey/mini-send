<?php 
    namespace App\MiniSend\Traits;

    use Illuminate\Http\Request;
    use App\MiniSend\Events\ErrorEvents;
    use App\MiniSend\Api\ApiResponse;
    use App\MiniSend\Utils\Generators;
    
    trait EmailTrait {

        private function uid()
        {
            $email_uid = '';
            do {
                $email_uid = Generators::generateEmailUid();
            } while ( $this->emailTransactionRepo->getEmailTransactionByUid( $email_uid ) );

            return $email_uid;
        }

    }
?>