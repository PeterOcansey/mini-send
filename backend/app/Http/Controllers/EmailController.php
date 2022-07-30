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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{
            
            return $this->emailActivity->sendEmail( $request->post() );

        }catch(\Exception $e){

            ErrorEvents::ServerErrorOccurred($e);
            return ApiResponse::serverError();

        }
    }

    public function show(EmailTransaction $emailTransaction)
    {
        //
    }

    public function edit(EmailTransaction $emailTransaction)
    {
        //
    }

    public function update(Request $request, EmailTransaction $emailTransaction)
    {
        //
    }

    public function destroy(EmailTransaction $emailTransaction)
    {
        //
    }
}
