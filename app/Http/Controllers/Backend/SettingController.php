<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'email' => 'required|email',
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'linkedin' => 'required|string',
            'google' => 'required|string',
            'rss' => 'required|string',
            'youtube' => 'required|string',
            'instagram' => 'required|string',
            'line1' => 'required|string',
            'line2' => 'required|string',
            'line3' => 'required|string',
            'time1' => 'required|string',
            'time2' => 'required|string',
            'time3' => 'required|string',
            'logo_image' => 'nullable|image',

        ]);

        update_static_option('mobile', $request->mobile);
        update_static_option('email', $request->email);
        update_static_option('address', $request->address);

        update_static_option('facebook', $request->facebook);
        update_static_option('twitter', $request->twitter);
        update_static_option('linkedin', $request->linkedin);
        update_static_option('google', $request->google);
        update_static_option('rss', $request->rss);
        update_static_option('youtube', $request->youtube);
        update_static_option('instagram', $request->instagram);

        update_static_option('facebook_page_id', $request->facebook_page_id);
        update_static_option('facebook_page_access_token', $request->facebook_page_access_token);

        update_static_option('line1', $request->line1);
        update_static_option('line2', $request->line2);
        update_static_option('line3', $request->line3);
        update_static_option('time1', $request->time1);
        update_static_option('time2', $request->time2);
        update_static_option('time3', $request->time3);

        if($request->hasFile('logo_image')){
            $path = 'public/upload/logo_image/';
            $image_name= str_random(40) . '.' . $request->logo_image->extension();
            $request->file('logo_image')->move($path, $image_name);
            update_static_option('logo_image', $path.$image_name);
      }
      return back()->with('success','Successfully updated');

    }
}
