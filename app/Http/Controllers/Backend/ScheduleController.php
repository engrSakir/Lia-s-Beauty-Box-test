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
//        $schedules = Schedule::all();
//        return view('backend.schedule.index', compact('schedules'));

//        $events = [];
//
//        $events[] = \Acaronlex\LaravelCalendar\Calendar::event(
//            'Event One', //event title
//            false, //full day event?
//            Carbon::now(), //start time (you can also use Carbon instead of DateTime)
//            Carbon::now()->addHour(3), //end time (you can also use Carbon instead of DateTime)
//            0 //optionally, you can specify an event ID
//        );
//
//        $events[] = \Acaronlex\LaravelCalendar\Calendar::event(
//            "Valentine's Day", //event title
//            true, //full day event?
//            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
//            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
//            'stringEventId' //optionally, you can specify an event ID
//        );
//
//        $calendar = new Calendar();
//        $calendar->addEvents($events)
//            ->setOptions([
//                'locale' => 'fr',
//                'firstDay' => 0,
//                'displayEventTime' => true,
//                'selectable' => true,
//                'initialView' => 'timeGridWeek',
//                'headerToolbar' => [
//                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
//                ]
//            ]);
//        $calendar->setId('1');
//        $calendar->setCallbacks([
//            'select' => 'function(selectionInfo){}',
//            'eventClick' => 'function(event){}'
//        ]);
//
////        dd($calendar);
////        return view('hello', compact('calendar'));
//        return view('backend.schedule.index', compact('calendar'));

        $schedules = Schedule::all();
        return view('backend.schedule.index', compact('schedules'));
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
        //
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
        //
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
