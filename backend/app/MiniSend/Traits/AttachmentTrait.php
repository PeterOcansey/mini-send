<?php 
    namespace App\MiniSend\Traits;

    use Illuminate\Http\Request;
    use App\MiniSend\Events\ErrorEvents;
    use App\MiniSend\Api\ApiResponse;
    use App\MiniSend\Utils\Generators;
    use App\MiniSend\Utils\Constants;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;
    
    trait AttachmentTrait {

        
        private function processAttachments( Request $request )
        {
            $attachments = [];
            foreach ( $request->file('attachments') as $file ) 
            {
                //Store file and get generated name
                $path = Storage::disk('public')->putFile( 'attachments', $file );
                
                //Add new file info
                array_push( $attachments, [
                        'file_name' => $path,
                        'file_original_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                        'file_type' => $file->getClientMimeType()
                        ] );
            }

            return $attachments;
        }
    }
?>