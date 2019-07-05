<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable=[
    	'ad_id','member_id','review_text'
    ];
}
