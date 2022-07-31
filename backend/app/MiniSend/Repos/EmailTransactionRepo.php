<?php

namespace App\MiniSend\Repos;

use App\Models\EmailTransaction;
use App\MiniSend\Utils\Constants;


class EmailTransactionRepo
{
    public function getTransactionsPaginated( Array $filters )
    {
        $predicate = EmailTransaction::query();

        foreach ( $filters as $key => $filter ) 
        {
            if( in_array( $key, Constants::FILTER_PARAM_IGNORE_LIST ) )
            {
                continue;
            }
    
            $predicate->where( $key, $filter );
         }

        return $predicate->orderBy('created_at', 'DESC')->paginate( $filters['pageSize'] ?? Constants::DEFAULT_PAGE_SIZE );
    }

    public function getEmailTransactionByUid( String $uid )
    {
        return EmailTransaction::where( 'uid', $uid )->first();
    }

    public function getEmailTransactionById( $id )
    {
        return EmailTransaction::find( $id );
    }

    public function saveEmailTransaction( Array $data )
    {
        return EmailTransaction::create( $data );
    }

    public function updateStatus( EmailTransaction $emailTransaction, String $status )
    {
        $emailTransaction->status = $status;

        return $emailTransaction->update();
    }
}