<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MiniSend\Activities\EmailTransactionActivity;
use App\MiniSend\Events\ErrorEvents;
use App\MiniSend\Api\ApiResponse;

class EmailController extends Controller
{

    protected EmailTransactionActivity $emailActivity;

    public function __construct( EmailTransactionActivity $emailActivity )
    {
        $this->emailActivity = $emailActivity;
    }

    public function index( Request $request )
    {
        try{
            
            return $this->emailActivity->listTransactions( $request->all() );

        }catch(\Exception $e){

            ErrorEvents::ServerErrorOccurred($e);
            return ApiResponse::serverError();

        }
    }

    public function store(Request $request)
    {
        try{
            
            return $this->emailActivity->sendEmail( $request );

        }catch(\Exception $e){

            ErrorEvents::ServerErrorOccurred($e);
            return ApiResponse::serverError();

        }
    }

    public function show( Request $request, $uid )
    {
        try{
            
            return $this->emailActivity->getEmailTransaction( $uid );

        }catch(\Exception $e){

            ErrorEvents::ServerErrorOccurred($e);
            return ApiResponse::serverError();

        }
    }
}
