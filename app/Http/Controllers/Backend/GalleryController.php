<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\ImageCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id','DESC')->get();
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ImageCategory::all();
        return view('backend.gallery.create', compact('categories'));
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
            'image'         => 'required|image',
            'short_description'         => 'nullable|string',
            'imagecategory_id'   => 'required:exists:image_categories,id',

        ]);
        $gallery = new Gallery();
        $gallery->short_description = $request->short_description;
        $gallery->imagecategory_id = $request->imagecategory_id;
        if ($request->file('image')) {
            $gallery->image = file_uploader('uploads/gallery-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $gallery->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $imageCategories = ImageCategory::all();
        return view('backend.gallery.edit', compact('gallery','imageCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image'         => 'image',
            'short_description'         => 'nullable|string',
            'imagecategory_id'   => 'required:exists:image_categories,id',


        ]);
        $gallery->short_description = $request->short_description;
        $gallery->imagecategory_id = $request->imagecategory_id;
        if ($request->file('image')) {
            $gallery->image = file_uploader('uploads/gallery-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $gallery->save();
        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
