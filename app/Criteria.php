<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable=[
    	"ad_id",
		"criteria_search",
    	"criteria_description"
    ];
}
