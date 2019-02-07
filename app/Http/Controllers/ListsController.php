<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Lists;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$this->validate($request, [
			'id' => 'numeric',
			'title' => 'string|min:1|max:191',
			'country' => 'string|min:1|max:191',
			'price' => 'sometimes|integer',
			'is_on_sale' => 'boolean'
		]);
		$data=$request->only(['id', 'title','country','price','is_on_sale']);
        return Lists::search($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = $this->validate($request, [
            'name' => 'required|string|min:3|max:191',
			'city_id' => 'required|integer',
			'developer_id' => 'required|integer',
            'price' => 'required|numeric|min:1',
            'is_on_sale' => 'boolean',
        ]);
        
        if ($validator){
            return response()->json([$validator->errors()->all()]);
        }else{
			$data=$request->only(['name', 'city_id', 'developer_id','price','is_on_sale']);
			Lists::create($data);
			return response()->json(['success'=>'Entry was added succesfully']);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $listId
     * @return \Illuminate\Http\Response
     */
    public function show(int $listId)
    {
		return response()->json(Lists::getListForShow($listId));

    }
	
	public function listEntries(){
		return view('listEntries');
	}
	
	public function showEntry(){
		return view('showEntry');
	}
	

}
