<?php

namespace App\Http\Controllers\API;
use App\AdAmenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdAmenityController extends Controller
{
    public function add_ad_amenity(Request $request){
    	try{
	    	
	    	$input=$request->all();
	    	
	        	$status=AdAmenity::create($input);

		    	if($status){
		    		return response()->json($status);
		    	}
		    	else{
		    		return response()->json("failed");	
		    	}
	        }
	    }
	    catch (\Exception $e) {
   	 		return response()->json([$e->getMessage()]);
		}
    }
}
