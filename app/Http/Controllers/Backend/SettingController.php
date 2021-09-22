<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'mobile' => 'nullable|numeric',
            'email' => 'nullable|email',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'google' => 'nullable|string',
            'rss' => 'nullable|string',
            'youtube' => 'nullable|string',
            'instagram' => 'nullable|string',
            'line1' => 'nullable|string',
            'line2' => 'nullable|string',
            'line3' => 'nullable|string',
            'time1' => 'nullable|string',
            'time2' => 'nullable|string',
            'time3' => 'nullable|string',
            'logo' => 'nullable|image',
            'about' => 'nullable|string',
            'advance_amount' => 'nullable|numeric',
            'advance_message' => 'nullable|string',

        ]);

        update_static_option('mobile', $request->mobile);
        update_static_option('email', $request->email);
        update_static_option('address', $request->address);

        update_static_option('facebook', $request->facebook ?? '#');
        update_static_option('twitter', $request->twitter ?? '#');
        update_static_option('linkedin', $request->linkedin ?? '#');
        update_static_option('google', $request->google ?? '#');
        update_static_option('rss', $request->rss ?? '#');
        update_static_option('youtube', $request->youtube ?? '#');
        update_static_option('instagram', $request->instagram ?? '#');

        update_static_option('facebook_page_id', $request->facebook_page_id);
        update_static_option('facebook_page_access_token', $request->facebook_page_access_token);

        update_static_option('line1', $request->line1);
        update_static_option('line2', $request->line2);
        update_static_option('line3', $request->line3);
        update_static_option('time1', $request->time1);
        update_static_option('time2', $request->time2);
        update_static_option('time3', $request->time3);

        update_static_option('about', $request->about);
        update_static_option('advance_amount', $request->advance_amount);
        update_static_option('advance_message', $request->advance_message);

       if($request->hasFile('logo')){
        update_static_option('logo',file_uploader('uploads/logo/', $request->logo, Carbon::now()->format('Y-m-d H-i-s-a') .'-'. Str::random(8)));
        
      }
      return back()->with('success','Successfully updated');

    }
}
