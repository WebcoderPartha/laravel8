<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\HomeAbout;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){

        $brands     = Brand::all();
        $homeAbout  = HomeAbout::find(3);
        return view('home', compact('brands', 'homeAbout'));
    }

}
