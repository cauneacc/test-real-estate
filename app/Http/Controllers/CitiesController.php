<?php

namespace App\Http\Controllers;

use App\Cities;

class CitiesController extends Controller
{
    public function indexCountries()
    {
        return Cities::getCountries();
    }
	
    public function index()
    {
        return Cities::all();
    }

}
