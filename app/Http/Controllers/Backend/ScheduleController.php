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
        $times = ['12 AM', '01 AM', '02 AM', '03 AM', '04 AM', '05 AM', '06 AM', '07 AM',  '08 AM', '09 AM', '10 AM', '11 AM',
            '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM', '06 PM', '07 PM', '08 PM', '09 PM', '10 PM', '11 PM'];

//        $schedule_days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

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

//        dd($schedule_days);
//        return $schedule_days;
        return view('backend.schedule.index', compact('schedules', 'times', 'schedule_days'));
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
