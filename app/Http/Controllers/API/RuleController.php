<?php

namespace App\Http\Controllers\API;
use App\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RuleController extends Controller
{
    public function get_all_rules(){
    	try{
			$rules=Rule::all();
			if(count($rules)>0){
				return response()->json(["data"=>$rules]);
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
