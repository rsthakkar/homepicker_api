<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Area;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class AreaController extends Controller
{
	public function get_areas($city_id){
		$areas=Area::where("city_id","=",$city_id)->get();
		$count=$areas->count();
	
		if($areas->count()>0)
			return response()->json($areas,200);
		else
			return response()->json(["message"=>"no data available"],401);
	}

    public function get_areas_count(){
        $areas=Area::all();
        $count=$areas->count();
    
        if($areas->count()>0)
            return response()->json(["count"=>$count],200);
        else
            return response()->json(["message"=>"no data available"],401);
    }

	public function add_area(Request $request){
		$validator = Validator::make($request->all(), [
                    "city_id"=>"required",
                    "area"=>"required"
            ]);
            if ($validator->fails()) {
                return response()->json($validator->messages(),401);
            }
            else{
            	try{
        	    	Area::create($request->all());
        	    	return response()->json(["status"=>"success"],200);
            	}
            	catch (Exception $e){
        		    $errorCode = $e->errorInfo[1];
        		    if($errorCode == 1062){
        	           return response()->json(["status"=>"failed(already exist)"],401);
            		}
        		}
            }   
	}    
}
