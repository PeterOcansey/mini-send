<?php 
    namespace App\MiniSend\Traits;

    use Illuminate\Http\Request;
    use App\Editor\Events\ErrorEvents;
    use App\Utils\ApiResponse;
    use Validator;
    
    trait ValidatorTrait {

        private function validateRequest( Array $data, Array $fields )
        {
            $validator = Validator::make( $data, $fields );
    
            if ( $validator->fails() ) 
            {
                return ApiResponse::validationError( $validator->errors() );
            }

            return null;
        }

        private function validateRquestEmailContent( Array $data )
        {
            if( !isset( $data['content_text'] ) || !isset( $data['content_html'] ) )
            {
                return ApiResponse::validationError( "A text content or html content is required to send a mail" );
            }

            return null;
        }

    }
?>