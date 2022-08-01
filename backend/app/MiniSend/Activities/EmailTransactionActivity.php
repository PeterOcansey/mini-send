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


    /**
     * Get Transactions
     * 
     * @method listTransactions( Array $filters )
     * 
     * @return Response( Array[ EmailTransaction] )
     */
    public function listTransactions( $filters )
    {        
        $transactions = $this->emailTransactionRepo->getTransactionsPaginated( $filters );

        foreach( $transactions as $key => $transaction )
        {
            //Generate attachemnt urls
            $transaction->getAttachments();
        }

        return ApiResponse::success( "Email transactions retrieved successfully", ['data' => $transactions] );
    }

    /**
     * Get Transaction By UID
     * 
     * @method getEmailTransaction( String $uid )
     * 
     * @return Response( EmailTransaction )
     */
    public function getEmailTransaction( $uid )
    {
        $transaction = $this->getEmailTransactionByUid( $uid );

        if( !$transaction )
        {
            return ApiResponse::notFoundError("Email transaction not found");
        }
        
        //Generate attachemnt urls
        $transaction->getAttachments();

        return ApiResponse::success( "Email transaction retrieved successfully", ["data" => $transaction] );
    }

    /**
     * Get Transaction By UID
     * 
     * @method getEmailTransactionByUid( String $uid )
     * 
     * @return EmailTransaction
     */

    public function getEmailTransactionByUid( $uid )
    {
        return  $this->emailTransactionRepo->getEmailTransactionByUid( $uid );
    }


     /**
     * Post an email
     * 
     * @method sendEmail( Request $request )
     * 
     * @return Response( EmailTransaction )
     */
    public function sendEmail( Request $request )
    {
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
        
        // Create new email transaction record
        if( $emailTransaction = $this->emailTransactionRepo->saveEmailTransaction( $data ) )
        {
            //Process and Save attachements
            if ( $request->hasFile( 'attachments' ) ) 
            {
                $attachments = $this->processAttachments( $request );
                $this->attachmentRepo->saveAttachments( $attachments, $emailTransaction->id );
            }

            //Get attachment urls
            $emailTransaction->getAttachments();

            //Broadcast an email has been posted event
            EmailPostedEvent::dispatch( $emailTransaction );

            return ApiResponse::success( "Email posted successfully!", ['data' => $emailTransaction] );
        }

        return ApiResponse::generalError( "Something went wrong while trying to post email" );
    }
}