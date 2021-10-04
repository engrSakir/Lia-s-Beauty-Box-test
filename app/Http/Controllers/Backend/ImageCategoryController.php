<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImageCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ImageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageCategories = ImageCategory::orderBy('id','DESC')->get();
        return view('backend.image_category.index', compact('imageCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imageCategories = ImageCategory::all();
        return view('backend.image_category.create',compact('imageCategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string',
        ]);
        $imageCategory = new ImageCategory();
        $imageCategory->name = $request->category_name;
        $imageCategory->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageCategory  $imageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ImageCategory $imageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageCategory  $imageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageCategory $imageCategory)
    {
        $imageCategories = ImageCategory::all();
        return view('backend.image_category.edit', compact('imageCategory', 'imageCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageCategory  $imageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageCategory $imageCategory)
    {
        $request->validate([
            'category_name' => 'required|string',
        ]);
        $imageCategory->name = $request->category_name;
        $imageCategory->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageCategory  $imageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageCategory $imageCategory)
    {
        $imageCategory->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
