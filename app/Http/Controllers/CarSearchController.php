<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarSearch\CarSearch;

class CarSearchController extends Controller
{
    public function filter(Request $request){
        return CarSearch::apply($request);
    }    
}
