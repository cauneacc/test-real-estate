<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Cities extends Model
{
	public static function getCountries(){
		$countries = DB::table('cities')
				->groupBy('country')
				->select('country')
				->orderBy('country', 'asc')
				->get();

		$result=[];
		foreach($countries as &$country){
			$result[]=$country->country;
		}
		return $result;
	}
}
