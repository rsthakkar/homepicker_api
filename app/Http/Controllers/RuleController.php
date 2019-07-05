<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;
use Exception;

class RuleController extends Controller
{
     public function show_rules(){
    	$rules=Rule::all();
    	return view('admin.rule',['rules'=>$rules]);   
    }

    public function add_rule(Request $request){
    	try{
	    	Rule::create($request->all());
	    	return redirect()->back()->with('success', 'Succesfully Rule Added!');
    	}
    	catch (Exception $e){
		   $errorCode = $e->errorInfo[1];
		    if($errorCode){
	        	return redirect()->back()->with('success', 'Error occured');
    		}
		}   
    }

    public function update(Request $request){
		Rule::where('id',$request->id)->update(['rule_description'=>$request->rule_description]);
		return redirect()->back()->with('success', 'Succesfully Rule Updated!');
	}

	public function destroy($id)
	{
	    $rule = Rule::findOrFail($id);

	    $rule->delete();

	    return redirect()->back()->with('success', 'Succesfully Rule Deleted!');
	}

}
