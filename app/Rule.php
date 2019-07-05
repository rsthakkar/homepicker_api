<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable=[
    	'rule_description',
    	'rule_search',
    	'ad_id',
    ];
}
