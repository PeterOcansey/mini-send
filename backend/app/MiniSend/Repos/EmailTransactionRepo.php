<?php

namespace App\MiniSend\Repos;

use App\Models\EmailTransaction;


class EmailTransactionRepo
{
    public function findPropertyById($id)
    {
        return EmailTransaction::find($id);
    }
}