<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\MiniSend\Traits\EmailTrait;

class EmailTransaction extends Model
{
    use HasFactory;
    use EmailTrait;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    protected $appends = ['is_html'];

    public function getIsHtmlAttribute()
	{
		return ( $this->content_html ) ? true : false;

	}

    public function getCreatedAtAttribute( $value )
    {
        $created_date = Carbon::parse( $value );
        return $created_date->isToday() ? $created_date->format('g:i A') : $created_date->format('M d');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'email_transaction_id');
    }
}
