<?php

namespace App\MiniSend\Activities;


use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\MiniSend\Repos\EmailTransactionRepo;
use App\MiniSend\Repos\AttachmentRepo;
use App\MiniSend\Api\ApiResponse;
use App\MiniSend\Utils\Constants;
use App\MiniSend\Traits\EmailTrait;
use App\MiniSend\Traits\AttachmentTrait;
use App\MiniSend\Traits\ValidatorTrait;
use App\Events\EmailPostedEvent;

class EmailTransactionActivity 
{
    use ValidatorTrait;
    use EmailTrait;
    use AttachmentTrait;

    protected EmailTransactionRepo $emailTransactionRepo;
    protected AttachmentRepo $attachmentRepo;

    public function __construct( EmailTransactionRepo $emailTransactionRepo, AttachmentRepo $attachmentRepo )
    {
        $this->emailTransactionRepo = $emailTransactionRepo;
        $this->attachmentRepo = $attachmentRepo;
    }

    public function listTransactions( $filters )
    {        
        $transactions = $this->emailTransactionRepo->getTransactionsPaginated( $filters );

        foreach( $transactions as $key => $transaction )
        {
            //Generate attachemnt urls
            $attachment_urls = [];
            $attachments = $transaction->attachments;
            if( $attachments && count( $attachments ) > 0 )
            {
                foreach( $attachments as $attachment )
                {
                    array_push( $attachment_urls, env('APP_URL') . "/storage/" . $attachment->file_name );
                }
            }
            
            $transaction['attachment_urls'] = $attachment_urls;

            //Remove the attachments object from the transacitonn
            unset( $transaction['attachments'] );
        }

        return ApiResponse::success( "Email transactions retrieved successfully", ['data' => $transactions] );
    }

    public function getEmailTransaction( $uid )
    {
        $transaction = $this->getEmailTransactionByUid( $uid );

        if( !$transaction )
        {
            return ApiResponse::notFoundError("Email transaction not found");
        }
        
        //Generate attachemnt urls
        $attachment_urls = [];
        $attachments = $transaction->attachments;
        if( $attachments && count( $attachments ) > 0 )
        {
            foreach( $attachments as $attachment )
            {
                array_push( $attachment_urls, env('APP_URL') . "/storage/" . $attachment->file_name );
            }
        }
        
        $transaction['attachment_urls'] = $attachment_urls;

        //Remove the attachments object from the transacitonn
        unset( $transaction['attachments'] );

        return ApiResponse::success( "Email transaction retrieved successfully", ["data" => $transaction] );
    }

    public function getEmailTransactionByUid( $uid )
    {
        return  $this->emailTransactionRepo->getEmailTransactionByUid( $uid );
    }

    public function sendEmail( Request $request )
    {
        Log::info( $request );

        $data = $request->post();

        //Validate request data
        $error_response = $this->validateRequest( $data, [
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|max:200',
        ] );
        if( $error_response ) return $error_response;

        //Initialize uid and status data
        $data['uid'] = $this->uid();
        $data['status'] = Constants::STATUS_POSTED;
        $attachment_urls = [];
        
        // Create new email transaction record
        if( $emailTransaction = $this->emailTransactionRepo->saveEmailTransaction( $data ) )
        {
            if ( $request->hasFile( 'attachments' ) ) 
            {
                $attachments = $this->processAttachments( $request );
                $attachments = $this->attachmentRepo->saveAttachments( $attachments, $emailTransaction->id );

                //Get url to saved attachemnts
                foreach( $attachments as $attachment )
                {
                   array_push( $attachment_urls, env('APP_URL') . "/storage/" . $attachment->file_name );
                }
            }

            $emailTransaction['attachment_urls'] = $attachment_urls;

            //Broadcast an email has been posted event
            EmailPostedEvent::dispatch( $emailTransaction );

            return ApiResponse::success( "Email posted successfully!", ['data' => $emailTransaction] );
        }

        return ApiResponse::generalError( "Something went wrong while trying to post email" );
    }
}