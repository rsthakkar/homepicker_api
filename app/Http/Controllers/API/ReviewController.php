<?php

namespace App\Http\Controllers\API;

use App\Advertisement;
use App\Review;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function add_review(Request $request)
    {
    	$user = Auth::user();
	    $input = $request->all();
	   	if(!Member::where('login_id','=',$user->id)->first())
	   	{
	    	return response()->json(["message"=>"You are not a member"]);
	   	}
	   	else
	   	{
	   		$member= Member::where('login_id','=',$user->id)->first();
	   	}
	    	//return $input['org_name'];
	   	$input['member_id']=$member->id;
	   	$validator = Validator::make($input, [
	           		"member_id"=>"required",
	           		"ad_id"=>"required",
	           		"review_text"=>"required"
	        ]);
	    if ($validator->fails()) {
	        return response()->json($validator->messages(),401);
	    }
	   	$review=Review::create($input);

		return response()->json($review);
    }

    public function show_reviews1($ad_id)
    {
    	$user = Auth::user();
    	if(!Member::where('login_id','=',$user->id)->first())
	   	{
	    	return response()->json(["message"=>"You are not a member"]);
	   	}
	   	$member= Member::where('login_id','=',$user->id)->first();

    	$ad_review=DB::table('reviews')
    			->leftjoin('members','members.id','reviews.member_id')
    			->select('reviews.*','members.firstname','members.lastname')
    			->where('ad_id',$ad_id)
    			->get();

    	return response()->json($ad_review);
    }
}
