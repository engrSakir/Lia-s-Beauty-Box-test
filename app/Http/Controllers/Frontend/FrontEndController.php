<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Gallery;


class FrontEndController extends Controller
{

    public function home()
    {
        $clients = Client::all();
        $galleries = Gallery::all();
        return view('frontend.home', ['clients' => $clients, 'galleries' => $galleries]);
    }

    public function booking()
    {
        if (request()->ajax()) {
            if (request()->request_for == "Schedules by Date") {
                $weekMap = [
                    0 => 'sunday',
                    1 => 'monday',
                    2 => 'tuesday',
                    3 => 'wednesday',
                    4 => 'thursday',
                    5 => 'friday',
                    6 => 'saturday',
                ];
                $day_name = $weekMap[date('w', strtotime(request()->appointment_data))];
                return [
                    'day_name' => $day_name,
                    'date' => request()->appointment_data,
                    'schedules' => \App\Models\Schedule::where('schedule_day', $day_name)->get()
                ];
            }

            if (request()->request_for == "Schedule Details") {
                return  \App\Models\Schedule::find(request()->schedule_id) ?? null;
            }
        }

        return view('frontend.booking');
    }
}
