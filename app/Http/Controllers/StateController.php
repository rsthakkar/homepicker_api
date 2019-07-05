<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Exception;

class StateController extends Controller
{
    public function add_state(Request $request){
    	try{
	    	State::create($request->all());
	    	return redirect()->back()->with('success', 'Succesfully State Added!');
    		}
    	catch (Exception $e){
		   $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
	        return redirect()->back()->with('success', 'Already Exist!');
    		}
		}   
    }

    public function show_states(){
    	$states=State::all();
    	return view('admin.states',['states'=>$states]);   
    }

    public function destroy($id)
	{
	    $state = State::findOrFail($id);

	    $state->delete();

	    return redirect()->back()->with('success', 'Succesfully State Deleted!');
	}
	public function update(Request $request){
		State::where('id',$request->id)->update(['state_name'=>$request->state_name]);
		return redirect()->back()->with('success', 'Succesfully State Updated!');
	}
}
