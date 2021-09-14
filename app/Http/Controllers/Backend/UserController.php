<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        return view('backend.user.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');

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
            'user_name' => 'required|string',
            'user_email' => 'required|unique:users,email',
            'user_phone' => 'required|string|max:11',   
        ]);

      

        $user = new User();
        $user->name = $request->user_name;  
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;   
        $user->password = Hash::make($request->user_pass);   

 
                       
        if ($request->file('image')) {
            $user->image = file_uploader('uploads/user-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($user->name, '-'));
        }
        $user->save();

        toastr()->success('Successfully Saved!');   
        return back();
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
    public function edit(User $user)
    {
        return view('backend.user.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'user_name' => 'required|string',
            'user_phone' => 'required|string|max:11',   
        ]);

      

        $user->name = $request->user_name;  
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;   

 
                       
        if ($request->file('image')) {
            $user->image = file_uploader('uploads/user-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($user->name, '-'));
        }
        $user->save();

        toastr()->success('Successfully Updated!');   
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
