<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class PasswordController extends Controller
{

    public function index(){

        return view('admin.user.password');

    }



    public function updatePassword( Request $request ){

        $validate = $request->validate([
            'oldpassword'           => 'required',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
            $hashed_password = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashed_password)){

            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password has been updated successfully.');

        }else{

            return Redirect::back()->with('success', 'Old password not correct!');

        }

    }

}
