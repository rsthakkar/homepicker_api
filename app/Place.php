<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable=[
    	"ad_id",
		"place_search",
		"place_description"
	];
}
