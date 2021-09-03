<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{

    public function index(){

        $galleries = Gallery::all();
        return view('admin.multipic.index', compact('galleries'));

    }

    public function store(Request $request){

        $validate = $request->validate([
           'gallery' => 'required'
        ]);

        $images = $request->file('gallery');

        foreach ($images as $image){

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(300, 200)->save('images/gallery/'.$name_gen);

            $location = 'images/gallery/'.$name_gen;

            $upload = new Gallery();
            $upload->gallery = $location;

            $upload->save();

        }

        return Redirect::back()->with('success', 'Gallery uploaded successfully!');

    }

}
