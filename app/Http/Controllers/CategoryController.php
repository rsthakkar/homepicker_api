<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Exception;

class CategoryController extends Controller
{
	public function show_cat(){
		$cats=Category::all();
		return view('admin.categories',['cats'=>$cats]);   
	}

	public function add_cat(Request $request){
    	try{
	    	Category::create($request->all());
	    	return redirect()->back()->with('success', 'Succesfully Category Added!');
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
	    $category = Category::findOrFail($id);

	    $category->delete();

	    return redirect()->back()->with('success', 'Succesfully Category Deleted!');
	}

    public function update(Request $request){
		Category::where('id',$request->id)->update(['cat_name'=>$request->cat_name]);
		return redirect()->back()->with('success', 'Succesfully Category Updated!');
	}
}
