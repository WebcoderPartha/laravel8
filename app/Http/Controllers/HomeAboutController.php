<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeAbout = HomeAbout::where('id', 3)->get();

//        return $homeAbout;
        return view('admin.home-about.index', compact('homeAbout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.home-about.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate(array(
            'title'         => 'required',
            'short_desc'    => 'required',
            'description'   => 'required'
        ));

        $store          = new HomeAbout();
        $store->title       = $request->title;
        $store->short_desc  = $request->short_desc;
        $store->description = $request->description;
        $store->save();

        return Redirect::route('admin.home.about')->with('success', 'Data stored successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeAbout  $homeAbout
     * @return \Illuminate\Http\Response
     */
    public function show(HomeAbout $homeAbout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeAbout  $homeAbout
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeAbout $homeAbout)
    {
        return view('admin.home-about.edit', compact('homeAbout'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeAbout  $homeAbout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeAbout $homeAbout)
    {

        $validate = $request->validate([
            'title'         => 'required',
            'short_desc'    => 'required',
            'description'   => 'required'
        ]);

        $homeAbout->title       = $request->title;
        $homeAbout->short_desc  = $request->short_desc;
        $homeAbout->description = $request->description;
        $homeAbout->save();

        return Redirect::route('admin.home.about')->with('success', 'Data updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeAbout  $homeAbout
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeAbout $homeAbout)
    {
        //
    }
}
