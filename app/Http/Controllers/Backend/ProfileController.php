<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
            'phone' => 'nullable|string|max:11',
            'user_pass' => 'nullable|string|min:4',
            'image' => 'nullable|image',
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if($user->password){
            $user->password = Hash::make($request->user_pass);
        }
        if ($request->file('image')) {
            $user->image = file_uploader('uploads/profile-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::slug($user->name, '-'));
        }
        $user->save();
        toastr()->success('Successfully Updated!');
        return back();
    }
}
