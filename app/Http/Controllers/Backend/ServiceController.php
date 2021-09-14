<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Service;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services= Service::all();
        return view('backend.service.index',compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceCategories=ServiceCategory::all();
        return view('backend.service.create',compact('serviceCategories'));

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
            'service_name' => 'required',
            'price' => 'required',
            'category_id' => 'required',   
        ]);

      

        $service = new Service();
        $service->name = $request->service_name;   
        $service->price = $request->price; 
        $service->category_id = $request->category_id;                   
        $service->description = $request->description;                
        if ($request->file('image')) {
            $service->image = file_uploader('uploads/service-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($service->name, '-'));
        }
        $service->save();

        toastr()->success('Successfully Saved!');   
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $serviceCategories=ServiceCategory::all();

        
        return view('backend.service.edit',['serviceCategories' => $serviceCategories,'service'=>$service]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required',
            'price' => 'required',
            'category_id' => 'required',   
        ]);

      

      
        $service->name = $request->service_name;   
        $service->price = $request->price; 
        $service->category_id = $request->category_id;                   
        $service->description = $request->description;                
        if ($request->file('image')) {
            $service->image = file_uploader('uploads/service-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($service->name, '-'));
        }
        $service->save();

        toastr()->success('Successfully Updated!');   
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
