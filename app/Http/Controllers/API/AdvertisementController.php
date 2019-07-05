<?php

namespace App\Http\Controllers\API;

use App\Member;
use App\Facility;
use App\Criteria;
use App\Rule;
use App\Image;
use App\Place;
use App\Amenity;
use App\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AdvertisementController extends Controller
{
    public function insert_ad(Request $request){
    	try{

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
	           		"org_name"=>"required",
		    	  	"type"=>"required",
		    	  	"city_id"=>"required",
		    	  	"area_id"=>"required",
		    	  	"address"=>"required",
		    	  	"start_date"=>"required|date",
		    	  	"end_date"=>"required|date",
		    	  	"description"=>"required",
                    //'img_name1' => 'required|image|mimes:bmp, jpeg,png,jpg,gif,svg|max:2048',

		    	  	// "status"=>"required",
		    	  	// "paymentStatus"=>"required",
		    	 	"contact_no"=>"required",
		    	 	"show_contact_details"=>"required",
		    	 	"fees"=>"required",
		    	 	"rule_search"=>"required",
		    	 	"amenities_search"=>"required",
		    	 	"criteria_search"=>"required",
		    	 	"facility_search"=>"required",
		    	 	"place_search"=>"required",
	        ]);
	        if ($validator->fails()) {
	            return response()->json($validator->messages(),401);
	        }
	        else{
	        	$ad=Advertisement::create([
		    	 	"member_id"=>$input["member_id"],
		    	 	"org_name"=>$input["org_name"],
		    	 	"type"=>$input["type"],
		    	 	"city_id"=>$input["city_id"],
		    	 	"area_id"=>$input["area_id"],
		    	 	"address"=>$input["address"],
		    	 	"start_date"=>$input["start_date"],
		    	 	"end_date"=>$input["end_date"],
		    	 	"description"=>$input["description"],
		    	 	"status"=>$input["status"],
		    	 	"paymentStatus"=>$input["paymentStatus"],
		    	 	"contact_no"=>$input["contact_no"],
		    	 	"show_contact_details"=>$input["show_contact_details"],
		    	 	"fees"=>$input["fees"],
		    	]);

		    	Rule::create([
		    		"ad_id"=>$ad->id,
		    		"rule_description"=>$request->rule_description,
		    		"rule_search"=>$input["rule_search"]
		    	]);

		    	Amenity::create([
		    		"ad_id"=>$ad->id,
		    		"amenities_details"=>$request->amenities_description,
		    		"amenities_search"=>$input["amenities_search"]
		    	]);

		    	Criteria::create([
		    		"ad_id"=>$ad->id,
		    		"criteria_search"=>$input["criteria_search"],
		    		"criteria_description"=>$request->criteria_description
		    	]);

		    	Facility::create([
		    		"ad_id"=>$ad->id,
		    		"facility_search"=>$input["facility_search"],
		    		"facility_description"=>$request->facility_description,
		    		"rooms"=>2
		    	]);

		    	Place::create([
		    		"ad_id"=>$ad->id,
		    		"place_search"=>$input["place_search"],
		    		"place_description"=>$request->place_description
		    	]);

		    	if ($request->hasFile('img_name1')) {
		            $image1 = $request->file('img_name1');
		            $name1 = time().'1.'. $image1->getClientOriginalExtension();
		            $destinationPath1 = public_path('/images');
		            $image1->move($destinationPath1, $name1);
		            //$this->save();
				}

		        if ($request->hasFile('img_name2')) {
		            $image2 = $request->file('img_name2');
		            $name2 = time().'2.'.$image2->getClientOriginalExtension();
		            $destinationPath2  = public_path('/images');
		            $image2->move($destinationPath2, $name2);
		            //$this->save();
		        }

		        if ($request->hasFile('img_name3')) {
		            $image3 = $request->file('img_name3');
		            $name3 = time().'3.'.$image3->getClientOriginalExtension();
		            $destinationPath3 = public_path('/images');
		            $image3->move($destinationPath3, $name3);
		            //$this->save();
		        }

		        if ($request->hasFile('img_name4')) {
		            $image4 = $request->file('img_name4');
		            $name4 = time().'4.'.$image4->getClientOriginalExtension();
		            $destinationPath4 = public_path('/images');
		            $image4->move($destinationPath4, $name4);
		            //$this->save();
		        }

		        Image::create([
		        	'ad_id'=>$ad->id,
		        	'img_name1'=>isset($name1) ? $name1 : 'default.jpg',
		        	'img_name2'=>isset($name2) ? $name2 : 'default.jpg',
		        	'img_name3'=>isset($name3) ? $name3 : 'default.jpg',
		        	'img_name4'=>isset($name4) ? $name4 : 'default.jpg',
		        ]);



		    	return response()->json($ad);
	        }
	    }
	    catch (\Exception $e) {
   	 		return response()->json([$e->getMessage()]);
		}
	}

	public function get_all_ad(){
    	$ads=DB::table('advertisements')
    			->leftJoin('members','members.id','=','advertisements.member_id')
    			->leftJoin('rules','rules.ad_id','=','advertisements.id')
    			->leftJoin('amenities','amenities.ad_id','=','advertisements.id')
    			->leftJoin('criterias','criterias.ad_id','=','advertisements.id')
    			->leftJoin('facilities','facilities.ad_id','=','advertisements.id')
    			->leftJoin('places','places.ad_id','=','advertisements.id')
    			->leftJoin('images','images.ad_id','=','advertisements.id')
    			->select('advertisements.*',
    					'members.firstname',
    					'members.lastname',
    					'rules.rule_search',
    					'rules.rule_description',
    					'amenities.amenities_search',
    					'amenities.amenities_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4'

    				)
    			->get();

    	// return $ads;
    	return response()->json($ads);   
    }

    public function get_cat_ad($cat){
    	$ads=DB::table('advertisements')
    			->leftJoin('members','members.id','=','advertisements.member_id')
    			->leftJoin('rules','rules.ad_id','=','advertisements.id')
    			->leftJoin('amenities','amenities.ad_id','=','advertisements.id')
    			->leftJoin('criterias','criterias.ad_id','=','advertisements.id')
    			->leftJoin('facilities','facilities.ad_id','=','advertisements.id')
    			->leftJoin('places','places.ad_id','=','advertisements.id')
    			->leftJoin('images','images.ad_id','=','advertisements.id')
    			->select('advertisements.*',
    					'members.firstname',
    					'members.lastname',
    					'rules.rule_search',
    					'rules.rule_description',
    					'amenities.amenities_search',
    					'amenities.amenities_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4'
    				)
    			->where('advertisements.type',$cat)
    			->get();

    	// return $ads;
    	return response()->json($ads);   

    }

    public function get_id_ad($id){
    	$ads=DB::table('advertisements')
    			->leftJoin('members','members.id','=','advertisements.member_id')
    			->leftJoin('rules','rules.ad_id','=','advertisements.id')
    			->leftJoin('amenities','amenities.ad_id','=','advertisements.id')
    			->leftJoin('criterias','criterias.ad_id','=','advertisements.id')
    			->leftJoin('facilities','facilities.ad_id','=','advertisements.id')
    			->leftJoin('places','places.ad_id','=','advertisements.id')
    			->leftJoin('images','images.ad_id','=','advertisements.id')
    			->leftJoin('cities','cities.id','=','advertisements.city_id')
    			->select('advertisements.*',
    					'members.firstname',
    					'members.lastname',
    					'rules.rule_search',
    					'rules.rule_description',
    					'amenities.amenities_search',
    					'amenities.amenities_description',
    					'places.place_search',
    					'places.place_description',
    					'facilities.facility_search',
    					'facilities.rooms',
    					'facilities.facility_description',
    					'criterias.criteria_search',
    					'criterias.criteria_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4',
    					'cities.city'
    				)
    			->where('advertisements.id',$id)
    			->get();

    	return response()->json($ads);   

    }

    public function ad_search(Request $request){
    	$search=$request->search;
    	$ads=DB::table('advertisements')
    			->leftJoin('members','members.id','=','advertisements.member_id')
    			->leftJoin('rules','rules.ad_id','=','advertisements.id')
    			->leftJoin('amenities','amenities.ad_id','=','advertisements.id')
    			->leftJoin('criterias','criterias.ad_id','=','advertisements.id')
    			->leftJoin('facilities','facilities.ad_id','=','advertisements.id')
    			->leftJoin('places','places.ad_id','=','advertisements.id')
    			->leftJoin('cities','cities.id','=','advertisements.city_id')
    			->leftJoin('areas','areas.id','=','advertisements.area_id')
    			->leftJoin('images','images.ad_id','=','advertisements.id')
    			->select('advertisements.*',
    					'members.firstname',
    					'members.lastname',
    					'rules.rule_search',
    					'rules.rule_description',
    					'amenities.amenities_search',
    					'amenities.amenities_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4',
    					'cities.city',
    					'areas.area'
    				)
	   ->where('advertisements.org_name', 'LIKE', "%{$search}%") 
	   ->orWhere('cities.city', 'LIKE', "%{$search}%") 
	   ->orWhere('areas.area', 'LIKE', "%{$search}%") 
	   ->get();

    	return response()->json($ads);   

    }

    public function my_ads(){
	   	$user = Auth::user();
	   	$ads=DB::table('advertisements')
    			->leftJoin('members','members.id','=','advertisements.member_id')
    			->leftJoin('rules','rules.ad_id','=','advertisements.id')
    			->leftJoin('amenities','amenities.ad_id','=','advertisements.id')
    			->leftJoin('criterias','criterias.ad_id','=','advertisements.id')
    			->leftJoin('facilities','facilities.ad_id','=','advertisements.id')
    			->leftJoin('places','places.ad_id','=','advertisements.id')
    			->leftJoin('cities','cities.id','=','advertisements.city_id')
    			->leftJoin('images','images.ad_id','=','advertisements.id')
    			->select('advertisements.*',
    					'members.firstname',
    					'members.lastname',
    					'rules.rule_search',
    					'rules.rule_description',
    					'amenities.amenities_search',
    					'amenities.amenities_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4',
    					'facilities.facility_search',
    					'facilities.facility_description',
    					'facilities.rooms',
    					'criterias.criteria_search',
    					'criterias.criteria_description',
    					'places.place_search',
    					'places.place_description',
    					'cities.city'
    				)
    			->where('advertisements.member_id',$user->id)
    			->get();

    	return response()->json($ads);   

    }

    public function update_ads(Request $request){
    	$user = Auth::user();
	    	
	    	if(!Member::where('login_id','=',$user->id)->first())
	    	{
	    		return response()->json(["message"=>"You are not a member"]);
	    	}
	    	else
	    	{
	    		$member= Member::where('login_id','=',$user->id)->first();
	    	}
	    	//return $input['org_name'];
	    	
	    	
	    	$validator = Validator::make($request->all(), [
	           		// "member_id"=>"required",
	    		"id"=>"required",
	           		"org_name"=>"required",
		    	  	"type"=>"required",
		    	  	// "city_id"=>"required",
		    	  	// "area_id"=>"required",
		    	  	"address"=>"required",
		    	  	// "start_date"=>"required|date",
		    	  	// "end_date"=>"required|date",
		    	  	"description"=>"required",
                    //'img_name1' => 'required|image|mimes:bmp, jpeg,png,jpg,gif,svg|max:2048',

		    	  	// "status"=>"required",
		    	  	// "paymentStatus"=>"required",
		    	 	"contact_no"=>"required",
		    	 	// "show_contact_details"=>"required",
		    	 	"fees"=>"required",
		    	 	"rule_search"=>"required",
		    	 	"amenities_search"=>"required",
		    	 	"criteria_search"=>"required",
		    	 	"facility_search"=>"required",
		    	 	"place_search"=>"required", 
	        ]);
	        if ($validator->fails()) {
	            return response()->json($validator->messages(),401);
	        }
	        else{
	        	$ad=Advertisement::where('id',$request->id)->update([
		    	 	// "member_id"=>$input["member_id"],
		    	 	"org_name"=>$request->org_name,
		    	 	"type"=>$request->type,
		    	 	"city_id"=>$request->city_id,
		    	 	"area_id"=>$request->area_id,
		    	 	"address"=>$request->address,
		    	 	// "start_date"=>$request->start_date,
		    	 	// "end_date"=>$request->end_date,
		    	 	"description"=>$request->description,
		    	 	// "status"=>$request->status,
		    	 	// "paymentStatus"=>$request->paymentStatus,
		    	 	"contact_no"=>$request->contact_no,
		    	 	// "show_contact_details"=>$request->show_contact_details,
		    	 	"fees"=>$request->fees,
		    	]);

		    	Rule::where('ad_id',$request->id)->update([
		    		// "ad_id"=>$ad->id,
		    		"rule_description"=>$request->rule_description,
		    		"rule_search"=>$request->rule_search
		    	]);

		    	Amenity:: where('ad_id',$request->id)->update([
		    		// "ad_id"=>$ad->id,
		    		"amenities_description"=>$request->amenities_description,
		    		"amenities_search"=>$request->amenities_search
		    	]);

		    	Criteria::where('ad_id',$request->id)->update([
		    		// "ad_id"=>$ad->id,
		    		"criteria_search"=>$request->criteria_search,
		    		"criteria_description"=>$request->criteria_description
		    	]);

		    	Facility::where('ad_id',$request->id)->update([
		    		// "ad_id"=>$ad->id,
		    		"facility_search"=>$request->facility_search,
		    		"facility_description"=>$request->facility_description,
		    		"rooms"=>2 
		    	]);

		    	Place::where('ad_id',$request->id)->update([
		    		// "ad_id"=>$ad->id,
		    		"place_search"=>$request->place_search,
		    		"place_description"=>$request->place_description
		    	]);

		  //   	if ($request->hasFile('img_name1')) {
		  //           $image1 = $request->file('img_name1');
		  //           $name1 = time().'1.'. $image1->getClientOriginalExtension();
		  //           $destinationPath1 = public_path('/images');
		  //           $image1->move($destinationPath1, $name1);
		  //           //$this->save();
				// }

		  //       if ($request->hasFile('img_name2')) {
		  //           $image2 = $request->file('img_name2');
		  //           $name2 = time().'2.'.$image2->getClientOriginalExtension();
		  //           $destinationPath2  = public_path('/images');
		  //           $image2->move($destinationPath2, $name2);
		  //           //$this->save();
		  //       }

		  //       if ($request->hasFile('img_name3')) {
		  //           $image3 = $request->file('img_name3');
		  //           $name3 = time().'3.'.$image3->getClientOriginalExtension();
		  //           $destinationPath3 = public_path('/images');
		  //           $image3->move($destinationPath3, $name3);
		  //           //$this->save();
		  //       }

		  //       if ($request->hasFile('img_name4')) {
		  //           $image4 = $request->file('img_name4');
		  //           $name4 = time().'4.'.$image4->getClientOriginalExtension();
		  //           $destinationPath4 = public_path('/images');
		  //           $image4->move($destinationPath4, $name4);
		  //           //$this->save();
		  //       }

		  //       Image::create([
		  //       	'ad_id'=>$ad->id,
		  //       	'img_name1'=>isset($name1) ? $name1 : null,
		  //       	'img_name2'=>isset($name2) ? $name2 : null,
		  //       	'img_name3'=>isset($name3) ? $name3 : null,
		  //       	'img_name4'=>isset($name4) ? $name4 : null,
		  //       ]);
		    }	


		    	return response()->json('success');
    }
}
