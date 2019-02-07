<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Lists extends Model{
	protected $fillable = ['price','city_id','developer_id','name','is_on_sale'];
	
    public static function search($searchCriteria){
		$sqlCondition=array();
		if(isset($searchCriteria['id'])){
			$sqlCondition[]=['lists.id', '=', $searchCriteria['id']];
		}else{
			if(isset($searchCriteria['title'])){
				$sqlCondition[]=['lists.name', 'like', '%'.$searchCriteria['title'].'%'];
			}
			if(isset($searchCriteria['country'])){
				$sqlCondition[]=['cities.country', '=', $searchCriteria['country']];
			}
			if(isset($searchCriteria['price'])){
				$sqlCondition[]=['price', '=', $searchCriteria['price']];
			}
			if(isset($searchCriteria['is_on_sale'])){
				$sqlCondition[]=['is_on_sale', '=', $searchCriteria['is_on_sale']];
			}
		}
		$r = DB::table('lists')
				->join('cities', 'lists.city_id', '=', 'cities.id')
				->where($sqlCondition)
				->select('lists.*', 'cities.country')
				->orderBy('lists.id', 'asc')
				->get();
		return $r;
	}

	public static function getListForShow($listId){
		$r = DB::table('lists')
				->join('cities', 'lists.city_id', '=', 'cities.id')
				->join('developers', 'lists.developer_id', '=', 'developers.id')
				->where([['lists.id', '=', $listId]])
				->select('lists.*', 'cities.country','cities.name as city', 'developers.name as developer')
				->get();
		if(count($r)==1){
			return $r[0];
		}else{
			return $r;
		}
		
	}
}
