<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable=[
    				"member_id",
		    	 	"org_name",
		    	 	"type",
		    	 	"city_id",
		    	 	"area_id",
		    	 	"address",
		    	 	"start_date",
		    	 	"end_date",
		    	 	"description",
		    	 	"status",
		    	 	"paymentStatus",
		    	 	"contact_no",
		    	 	"show_contact_details",
		    	 	"fees",
    ];
}
