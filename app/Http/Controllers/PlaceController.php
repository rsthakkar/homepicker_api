<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Loginuser;

class PlaceController extends Controller
{
    public function show_members(){
    	$members=Member::all();
    	return view('admin.members',['members'=>$members]);
    }
}
