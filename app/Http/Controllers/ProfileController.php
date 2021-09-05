<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function userProfile(){
        if (Auth::user()){
            $user = User::find(Auth::id());
            if ($user){
                return view('admin.user.profile', compact('user'));
            }
        }else{
            return redirect()->back();
        }
    }

    public function updateProfile( Request $request ){

        $validate = $request->validate([
            'name'                  => 'required',
            'email'                 => 'required',
            'profile_photo_path'    => 'mimes:jpg,png,jpeg'
        ]);

        if (Auth::user()){

            if ($file = $request->file('profile_photo_path')){

                $img_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($request->profile_photo_path)->resize(30, 40)->save('backend/assets/img/user/'.$img_gen);

                $imagelocation = 'backend/assets/img/user/'.$img_gen;

                $user = User::find(Auth::id());

                $user->name                 = $request->name;
                $user->email                = $request->email;
                $user->profile_photo_path   = $imagelocation;
                $user->save();

                Toastr::success('Profile updated successfully with image');
                return Redirect::back();

            }else{

                $user = User::find(Auth::id());
                $user->name                 = $request->name;
                $user->email                = $request->email;
                $user->save();
                Toastr::success('Profile updated successfully without image');
                return Redirect::back();

            }

        }


    }


}
