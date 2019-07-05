<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 


class AdvertisementController extends Controller
{
    public function show_ads(){
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
    	return view('admin.ads',['ads'=>$ads]);   

    }

    public function show_ad_id($id){
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
    					'facilities.facility_description',
    					'criterias.criteria_search',
    					'criterias.criteria_description',
    					'images.img_name1','images.img_name2','images.img_name3','images.img_name4',
    					'cities.city'
    				)
    			->where('advertisements.id',$id)
    			->first();
    			// echo "<pre>";print_r($ads);
    			// return;
    	return view('admin.ad_id',['ads'=>$ads]);   

    }
}
