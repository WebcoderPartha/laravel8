<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        $trashed = Category::onlyTrashed()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashed'));
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
        // Custom Validation error Message
        $validate = $request->validate([
           'category_name' => 'required|unique:categories|max:100'
        ],[
            'category_name.required' => 'Field must not be empty',
            'category_name.max' => 'The category name must not be greater than 3 characters.',
        ]);

//        $userid = Auth::id();
//        $category_name = $request->category_name;
//        $insert = Category::create([
//           'user_id' => $userid,
//           'category_name' => $category_name,
//            'created_at' => Carbon::now('Asia/Dhaka')->format('Y')
//        ]);

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->category_name;
        $category->save();


        return redirect()->back()->with('success', 'Category added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
           'category_name' => 'required|max:255|unique:categories,category_name,'.$category->id,
        ],[
            'category_name.required' => 'Field must not be empty'
        ]);


        $category->user_id = Auth::user()->id;
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('category.all')->with('update', $request->category_name.' category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', $category->category_name.' category trashed successfully!');
    }

    public function restoreCategory($id){

        $restore = Category::withTrashed()->find($id);
        $restore->restore();
        return redirect()->route('category.all')->with('success', $restore->category_name.' category restored successfully!');

    }

    public function permanentDelete($id){
        $pDelete = Category::onlyTrashed()->find($id);
        $pDelete->forceDelete();
        return redirect()->route('category.all')->with('success', $pDelete->category_name.' category deleted successfully!');
    }


}
