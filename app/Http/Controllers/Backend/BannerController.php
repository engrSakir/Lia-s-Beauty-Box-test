<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id','DESC')->get();
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'title'         => 'required|string',
            'image'         => 'required|image',
            'short_description'         => 'nullable|string',
            'primary_text'         => 'nullable|string',
            'secondary_text'         => 'nullable|string',
            'link'         => 'nullable|string',

        ]);
        $banner = new Banner();
        $banner->name = $request->title;
        $banner->primary_text = $request->primary_text;
        $banner->secondary_text = $request->secondary_text;
        $banner->link = $request->link;
        $banner->short_description = $request->short_description;
        if ($request->file('image')) {
            $banner->image = file_uploader('uploads/banner-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $banner->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'         => 'required|string',
            'image'         => 'image',
            'short_description'         => 'nullable|string',
            'primary_text'         => 'nullable|string',
            'secondary_text'         => 'nullable|string',
            'link'         => 'nullable|string',

        ]);

        $banner->name = $request->title;
        $banner->primary_text = $request->primary_text;
        $banner->secondary_text = $request->secondary_text;
        $banner->link = $request->link;
        $banner->short_description = $request->short_description;
        if ($request->file('image')) {
            $banner->image = file_uploader('uploads/banner-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $banner->save();
        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
