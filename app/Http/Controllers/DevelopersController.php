<?php

namespace App\Http\Controllers;

use App\Developers;

class DevelopersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Developers::all();
    }
}
