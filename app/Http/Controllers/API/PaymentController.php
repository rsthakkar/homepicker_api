<?php

namespace App\Http\Controllers\API;

use App\Payment;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function add_payment(Request $request)
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
	           		"payment"=>"required"
	        ]);
	    if ($validator->fails()) {
	        return response()->json($validator->messages(),401);
	    }
	   	$pay=Payment::create($input);

		return response()->json($pay);

    }
}
