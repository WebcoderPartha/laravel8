<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{

    public function index(){

        $sliders = Slider::paginate(10);
        return view('admin.slider.index', compact('sliders'));

    }

    public function storeSlider( Request $request ){

        $validate = $request->validate(array(
            'title'         => 'required|unique:sliders',
            'description'   => 'required',
            'image'         => 'required|mimes:jpg,jpeg,png'

        ),array(
            'title.required' => 'Title field is required!'
        ));

        if ($image_file = $request->file('image')){

            $name_gen = Str::of($request->title)->slug('-');
            $img_ext = $image_file->extension();
            $image_name = $name_gen.'.'.$img_ext;
            $location = 'frontend/slider/';
            $final_image = $location.$image_name;
            Image::make($image_file)->resize(1920, 1088)->save('frontend/slider/'.$image_name);

            // Data Store
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->image = $final_image;
            $slider->save();

            return Redirect::back()->with('success', 'Slider added successfully.');


        }

    }


    public function destroySlider( $id ){

        $slider = Slider::find( $id );

        $image = $slider->image;

        $delete = $slider->delete();

        if ($delete){
            unlink($image);
        }

        return Redirect::back()->with('success', $slider->title.' slider deleted successfully');

    }


}
