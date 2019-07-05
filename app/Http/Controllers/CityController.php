<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\City;
use App\State;
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
    	
    	return view('admin.city',['cities'=>$cities,'states'=>$states]);   
    }

    public function add_city(Request $request){
    	try{
	    	City::create($request->all());
	    	return redirect()->back()->with('success', 'Succesfully City Added!');
    	}
    	catch (Exception $e){
		   $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
	        return redirect()->back()->with('success', 'Already Exist!');
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
