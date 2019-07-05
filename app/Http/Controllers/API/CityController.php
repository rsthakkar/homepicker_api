<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use App\City;
use App\State;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function show_cities(){
    	$cities=DB::table('cities')
    				->join('states','cities.state_id','=','states.id')
    				->select('cities.*','states.state_name')
    				->get();

    	$states=State::all();
    	
    	return response()->json($cities);   
    }

    public function add_city(Request $request){

        $request["state_id"]=1;
        $validator = Validator::make($request->all(), [
                    "city"=>"required",
                    "state_id"=>"required"
            ]);
            if ($validator->fails()) {
                return response()->json($validator->messages(),401);
            }
            else{
            	try{
        	    	City::create($request->all());
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

    public function destroy($id)
	{
	    $city = City::findOrFail($id);

	    $city->delete();

	    return redirect()->back()->with('success', 'Succesfully City Deleted!');
	}

	public function update(Request $request){
		City::where('id',$request->id)->update(['city'=>$request->city,'state_id'=>$request->state_id]);
		return redirect()->back()->with('success', 'Succesfully City Updated!');
	}

	
}
