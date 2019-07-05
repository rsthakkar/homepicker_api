<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable=[
    	"ad_id",
		"amenities_description",
   		"amenities_search"
    ];
}
