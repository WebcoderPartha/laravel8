<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
           'brand_name'     => 'required|unique:brands|max:50',
            'brand_image'   => 'required|mimes:jpg,jpeg,png'
        ],[
            'brand_name.required' => 'Field must not be empty!'
        ]);

        if ($image_file = $request->file('brand_image')){

//            $uniqid = hexdec(uniqid());
//            $image_ext = $image_file->getClientOriginalExtension();
//            $image = $uniqid.'.'.$image_ext;
//            $location = "images/brand/";
//            $final_image = $location.$image;
//            $image_file->move($location,$image);

            $image = hexdec(uniqid()).'.'.$image_file->getClientOriginalExtension();

            Image::make($image_file)->resize(300, 200)->save('images/brand/'.$image);

            $image_path = 'images/brand/'.$image;
//
//            $brand = Brand();
//            $brand->brand_name = $request->brand_name;
//            $brand->brand_image = $image_path;
//            $brand->save();
            Brand::create([
               'brand_name' =>$request->brand_name,
               'brand_image' => $image_path
            ]);

            return Redirect::back()->with('success', 'Brand added successfully!');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('brand_image')){
            $oldBrand = Brand::find($id);
            unlink($oldBrand->brand_image);

            $file = $request->file('brand_image');
            $imageExt = Str::lower($file->getClientOriginalExtension());
            $name_gen = hexdec(uniqid());
            $image_name = $name_gen.'.'.$imageExt;
            $location = "images/brand/";
            $full_image = $location.$image_name;
            $file->move($location, $image_name);

            $oldBrand->brand_name = $request->brand_name;
            $oldBrand->brand_image = $full_image;
            $oldBrand->save();

            return Redirect::route('brand.index')->with('success', 'Brand updated successfully with image');

        }else{

            $brand = Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->save();
            return Redirect::route('brand.index')->with('success', 'Brand updated successfully without image');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        $image = $brand->brand_image;

        $delete = $brand->delete();

        if ($delete){

            unlink($image);
            return Redirect::back()->with('success', $brand->brand_name.' deleted successfully!');

        }


    }
}
