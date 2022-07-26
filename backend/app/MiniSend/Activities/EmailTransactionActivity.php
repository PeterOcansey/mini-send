<?php

namespace App\MiniSend\Activities;


use Illuminate\Support\Facades\Log;
use App\MiniSend\Repos\EmailTransactionRepo;
use App\MiniSend\Api\ApiResponse;
use App\MiniSend\Utils\Constants;

class EmailTransactionActivity 
{

    protected EmailTransactionRepo $emailTransactionRepo;

    public function __construct( EmailTransactionRepo $emailTransactionRepo )
    {
        $this->emailTransactionRepo = $emailTransactionRepo;
    }

}