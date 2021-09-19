<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials= Testimonial::all();
        return view('backend.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.create');

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
            'name'         => 'required|string',
            'image'         => 'required|image',
            'message'         => 'nullable|string',
            'designation'         => 'nullable|string',
            

        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        $testimonial->designation = $request->designation;
        if ($request->file('image')) {
            $testimonial->image = file_uploader('uploads/testimonial-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $testimonial->save();

        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('backend.testimonial.edit', compact('testimonial'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'         => 'required|string',
            'image'         => 'image',
            'message'         => 'nullable|string',
            'designation'         => 'nullable|string',
            

        ]);

        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        $testimonial->designation = $request->designation;
        if ($request->file('image')) {
            $testimonial->image = file_uploader('uploads/testimonial-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8));
        }
        $testimonial->save();

        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
