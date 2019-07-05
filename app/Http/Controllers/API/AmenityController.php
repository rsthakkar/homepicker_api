<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Amenity;

class AmenityController extends Controller
{
    //
    public function add_amenity(Request $request){
    	try{
    		$validator = Validator::make($input, [
	           		"aminities_details"=>"required"
	        ]);
	        if ($validator->fails()) {
	            return response()->json($validator->messages(),401);
	        }
	    	Amenity::create($request->all());
	    	return response()->json(["status"=>"success"],200);
    	}
    	catch (Exception $e){
		    $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
	        	return response()->json([$e->getMessage()],401);
    		}
		}   
    }

    public function get_all_amenities(){
		try{
			$am=Amenity::all();
			if(count($am)>0){
				return response()->json(["data"=>$am]);
			}
			else{
				return response()->json(["message"=>"no data"]);
			}
		}
		catch (\Exception $e) {
   	 		return response()->json([$e->getMessage()]);
		}
	}
}
