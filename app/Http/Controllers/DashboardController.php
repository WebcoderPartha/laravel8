<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{

    public function index(){

        return view('admin.index');

    }

    public function adminLogout(){

        Auth::logout();

        return Redirect::route('login')->with('success', 'Logout Successfully');

    }

}
