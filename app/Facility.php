<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
	protected $fillable=[
    	"ad_id",
		"facility_search",
		"facility_description",
		"rooms"
	];
}
