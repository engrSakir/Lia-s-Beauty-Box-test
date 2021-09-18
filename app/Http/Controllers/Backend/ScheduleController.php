<?php

namespace App\Http\Controllers\Backend;

use Acaronlex\LaravelCalendar\Calendar;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule_days = [
            [
                'day_name' => 'saturday',
                'data' =>  Schedule::where('schedule_day', 'saturday')->get()
            ],
            [
                'day_name' => 'sunday',
                'data' =>  Schedule::where('schedule_day', 'sunday')->get()
            ],
            [
                'day_name' => 'monday',
                'data' =>  Schedule::where('schedule_day', 'monday')->get()
            ],
            [
                'day_name' => 'tuesday',
                'data' =>  Schedule::where('schedule_day', 'tuesday')->get()
            ],
            [
                'day_name' => 'wednesday',
                'data' =>  Schedule::where('schedule_day', 'wednesday')->get()
            ],
            [
                'day_name' => 'thursday',
                'data' =>  Schedule::where('schedule_day', 'thursday')->get()
            ],
            [
                'day_name' => 'friday',
                'data' =>  Schedule::where('schedule_day', 'friday')->get()
            ],
        ];
        return view('backend.schedule.index', compact('schedule_days'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.schedule.create');
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
            'title' => 'required',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'schedule_day' => 'required',
        ]);
        try {
            foreach ($request->schedule_day as $schedule_day){
                $schedule = new Schedule();
                $schedule->title                = $request->title;
                $schedule->starting_time        = $request->starting_time;
                $schedule->ending_time          = $request->ending_time;
                $schedule->schedule_day         = $schedule_day;
                $schedule->maximum_participant  = $request->maximum_participant;
                $schedule->save();
            }
        }catch (\Exception $exception){
            toastr()->error('Something went wrong!');
            return back();
        }
        toastr()->success('successfully created!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('backend.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'schedule_day' => 'required',
        ]);
        $schedule->title                = $request->title;
        $schedule->starting_time        = $request->starting_time;
        $schedule->ending_time          = $request->ending_time;
        $schedule->schedule_day         = $request->schedule_day;
        $schedule->maximum_participant  = $request->maximum_participant;
        $schedule->save();
        toastr()->success('successfully updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
