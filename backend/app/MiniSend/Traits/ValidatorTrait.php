<?php 
    namespace App\MiniSend\Traits;

    use Illuminate\Http\Request;
    use App\MiniSend\Events\ErrorEvents;
    use App\MiniSend\Api\ApiResponse;
    use Validator;
    use Illuminate\Support\Facades\Log;
    
    trait ValidatorTrait {

        private function validateRequest( Array $data, Array $fields )
        {
            $validator = Validator::make( $data, $fields );
    
            if ( $validator->fails() ) 
            {
                return ApiResponse::validationError( ['errors' => $validator->errors()] );
            }

            if( !isset( $data['content_text'] ) && !isset( $data['content_html'] ) )
            {
                return ApiResponse::validationError( [], "A text content or html content is required to send a mail" );
            }

            return null;
        }

    }
?>