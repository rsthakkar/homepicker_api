<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\City;
use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{


    public function show_areas(){
		//$areas=Area::all();
		$cities=City::all();
		$areas=DB::table('areas')
					->join('cities','areas.city_id','=','cities.id')
					->join('states','cities.state_id','=','states.id')
					->select('areas.*','cities.city','states.state_name')
					->get();	
		//return $cities;
		return view('admin.area',['cities'=>$cities,'areas'=>$areas]);
	}

	public function add_area(Request $request){
    	try{
	    	Area::create($request->all());
	    	return redirect()->back()->with('success', 'Succesfully City Added!');
    	}
    	catch (Exception $e){
		   	$errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
	        return redirect()->back()->with('success', 'Already Exist!');
    		}
		}   
    }

    public function update(Request $request){
		Area::where('id',$request->id)->update(['area'=>$request->area,'pincode'=>$request->pincode,'city_id'=>$request->city_id]);
		return redirect()->back()->with('success', 'Succesfully City Updated!');
	}

	public function destroy($id)
	{
	    $area = Area::findOrFail($id);

	    $area->delete();

	    return redirect()->back()->with('success', 'Succesfully City Deleted!');
	}
}
