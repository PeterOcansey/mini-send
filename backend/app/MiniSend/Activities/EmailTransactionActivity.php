<?php

namespace App\MiniSend\Activities;


use Illuminate\Support\Facades\Log;
use App\MiniSend\Repos\EmailTransactionRepo;
use App\MiniSend\Api\ApiResponse;
use App\MiniSend\Utils\Constants;
use Illuminate\Http\Request;
use App\MiniSend\Traits\ValidatorTrait;
use App\MiniSEnd\Traits\EmailTrait;
use App\Events\EmailPostedEvent;

class EmailTransactionActivity 
{
    use ValidatorTrait;
    use EmailTrait;

    protected EmailTransactionRepo $emailTransactionRepo;

    public function __construct( EmailTransactionRepo $emailTransactionRepo )
    {
        $this->emailTransactionRepo = $emailTransactionRepo;
    }

    public function listTransactions( $filters )
    {        
        $transactions = $this->emailTransactionRepo->getTransactionsPaginated( $filters );

        return ApiResponse::success( "Email transactions retrieved successfully", ['data' => $transactions] );
    }

    public function getEmailTransactionByUid( $uid )
    {
        return  $this->emailTransactionRepo->getEmailTransactionByUid( $uid );
    }

    public function sendEmail( Array $data )
    {
        //Validate request data
        $error_response = $this->validateRequest( $data, [
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|max:200',
        ] );
        if( $error_response ) return $error_response;

        $data['uid'] = $this->uid();
        $data['status'] = Constants::STATUS_POSTED;
        
        // Create new email transaction record
        if( $emailTransaction = $this->emailTransactionRepo->saveEmailTransaction( $data ) )
        {
            EmailPostedEvent::dispatch( $emailTransaction );

            return ApiResponse::success( "Email posted successfully!", ['data' => $emailTransaction] );
        }

        return ApiResponse::generalError( "Something went wrong while trying to post email" );
    }

    public function updateMailStatus( $id, $status )
    {
        $emailTransaction = $this->emailTransactionRepo->getEmailTransactionById( $id );
        if( !$emailTransaction )
        {
            return Apiresponse::notFoundError( "Email transaction not found" );
        }

        if( $emailTransaction = $this->emailTransactionRepo->updateStatus( $emailTransaction, $status ) )
        {
            return ApiResponse::success( "Email status updated successfully!", ['data' => $emailTransaction] );
        }

        return ApiResponse::generalError( "Something went wrong while trying to update email status" );
    }

}