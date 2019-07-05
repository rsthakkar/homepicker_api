<?php

namespace App\Http\Controllers\API;
use App\Loginuser;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public $successStatus = 200;
    //
	public function login(){
       if(Auth::attempt(['mobile_no' => request('monumber'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('random')-> accessToken; 
            return response()->json($success, 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
    	$input=$request->all();
        $validator = Validator::make($input, [ 
            'firstname' => 'required', 
            'lastname'=> 'required',
            'mobile_no' => 'required|unique:loginusers', 
            'email' => 'required|email', 
            'password' => 'required', 
            //'c_password' => 'required|same:password',
            'address' => 'required', 
            'city_id' => 'required',
            'gender'=> 'required',
            'dob'=>'required',
            'org_name'=>'required'

        ]);
		if ($validator->fails()) { 
		        return response()->json(['error'=>$validator->errors()], 401);            
		    } 
		 $input = $request->all();

		 $input['category_id']=1;
		        //$input['dob']="2012-01-01"; 
		 //return response()->json([$input], $this-> successStatus);  
		        $input['password'] = bcrypt($input['password']);
		        Loginuser::create([
		        	'mobile_no'=>$input['mobile_no'],
		        	'password'=>$input['password'],
		        ]);

		        $user=Loginuser::select('id')
		        		->where('mobile_no',$input['mobile_no'])
		        		->first();
		        		
		        $input['category_id']=1;		

		        Member::create([
		        	'login_id'=>$user['id'],
		        	'firstname'=>$input['firstname'],
		        	'lastname'=>$input['lastname'],
		        	'gender'=>$input['gender'],
		        	'date_of_birth'=>$input['dob'],
		        	'email'=>$input['email'],
		        	'category_id'=>$input['category_id'],
		        	'address'=>$input['address'],
		        	'city_id'=>$input['city_id'],
		        	'org_name'=>$input['org_name'],

		        ]);



		        //$success['token'] =  $user->createToken('MyApp')-> accessToken; 
		        //$success['name'] =  $user->name;
			return response()->json(['status'=>'success'], $this-> successStatus); 
		    }
		/** 
		     * details api 
		     * 
		     * @return \Illuminate\Http\Response 
		     */ 
		public function details() 
	    { 
	        $user = Auth::user();
	        $userdata = DB::table('loginusers')
	        			->leftjoin('members','loginusers.id','=','members.login_id')
	        			->leftJoin('cities','cities.id','members.city_id')
	        			->where('members.login_id',$user->id)
	        			->get();

	        return response()->json($userdata); 
	    } 

	    public function update(Request $request){
	    	$user = Auth::user();
	    	// $member=Member::where('')
	    	// return $user->id;
	    	$input=$request->all();
        	$validator = Validator::make($input, [ 
            'firstname' => 'required', 
            'lastname'=> 'required',
            'mobile_no' => 'required', 
            'email' => 'required|email', 
            // 'password' => 'required', 
            //'c_password' => 'required|same:password',
            'address' => 'required', 
            // 'city_id' => 'required',
        ]);
		if ($validator->fails()) { 
		        return response()->json(['error'=>$validator->errors()], 401);            
		    } 
		        Loginuser::where('id',$user->id)->update([
		        	'mobile_no'=>$request->mobile_no,
		        ]);
		         $user2=Loginuser::select('id')
		        		->where('mobile_no',$request->mobile_no)
		        		->first();
		        // return $user2->id;
		        DB::table('members')
		        		->where('login_id',$user2->id)
		        		->update([
		        			'firstname'=>$input['firstname'],
				        	'lastname'=>$input['lastname'],
				        	'date_of_birth'=>$input['dob'],
				        	'email'=>$input['email'],
				        	'address'=>$input['address'],
		        		]);
		        // return $member;



		        //$success['token'] =  $user->createToken('MyApp')-> accessToken; 
		        //$success['name'] =  $user->name;
			return response()->json(['status'=>'success'], $this-> successStatus); 
	    }
		public function logout()
		{ 
			$accessToken = Auth::user()->token();
	        DB::table('oauth_refresh_tokens')
	            ->where('access_token_id', $accessToken->id)
	            ->update([
	                'revoked' => true
	            ]);

	        $accessToken->revoke();
	        return response()->json(["message"=>"Logged out successfully!"], 200);
		}
}
