<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id','DESC')->get();
        return view('backend.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.client.create');
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
            'client_name'  => 'required',
            'image'         => 'required|image',
        ]);
        $client = new Client();
        $client->name = $request->client_name;
        if ($request->file('image')) {
            $client->logo = file_uploader('uploads/client-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($request->client_name, '-'));
        }
        $client->save();
        toastr()->success('Successfully Saved!');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('backend.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_name'  => 'required',
            'image'         => 'image',
        ]);
        $client->name = $request->client_name;
        if ($request->file('image')) {
            $client->logo = file_uploader('uploads/client-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($request->client_name, '-'));
        }
        $client->save();
        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
