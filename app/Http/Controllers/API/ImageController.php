<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function insert_image(Request $request)
    {
    	
        $validator = Validator::make($request->all(), [
                    'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
            ]);
            if ($validator->fails()) {
                return response()->json($validator->messages(),401);
            }

        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            //$this->save();

            return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"failed"]);
        }
    }
}
