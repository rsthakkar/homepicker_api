<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable=[
    	'login_id','firstname','lastname','gender','date_of_birth','email','category_id','address','city_id','org_name'
    ];
}
