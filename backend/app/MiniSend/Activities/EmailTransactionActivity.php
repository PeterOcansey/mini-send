<?php

namespace App\MiniSend\Activities;


use Illuminate\Support\Facades\Log;
use App\MiniSend\Repos\EmailTransactionRepo;
use App\MiniSend\Api\ApiResponse;
use App\MiniSend\Utils\Constants;
use Illuminate\Http\Request;
use App\MiniSend\Traits\ValidatorTrait;
use App\MiniSEnd\Traits\EmailTrait;

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

    public function sendEmail( Array $data )
    {
        //Validate request data
        $error_response = $this->validateRequest( $data, [
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|max:200',
        ] );

        if( $error_response )
        {
            return $error_response;
        }

        //Check if we have a text or html content to send
        if( $error_respoonse = $this->validateRquestEmailContent( $data ) )
        {
            return $error_response;
        }

        $data['uid'] = $this->uid(); 
    }

}