<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function getCreatedAtAttribute( $value )
    {
        $created_date = Carbon::parse( $value );
        return $created_date->isToday() ? $created_date->format('g:i A') : $created_date->format('M d');
    }
}
