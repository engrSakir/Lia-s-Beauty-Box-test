<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\ImageCategory;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Banner;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FrontEndController extends Controller
{

    public function home()
    {
        $clients = Client::all();
        $galleries = Gallery::all();
        $imageCategories = ImageCategory::all();
        $serviceCategories = ServiceCategory::all();
        $services = Service::all();
        $banners = Banner::all();
        $testimonials = Testimonial::all();
        return view('frontend.home', compact('testimonials', 'banners', 'clients', 'galleries', 'imageCategories', 'serviceCategories', 'services'));
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
                $schedule = \App\Models\Schedule::find(request()->schedule_id) ?? null;
                if ($schedule) {
                    $max_participent_in_this_day = Appointment::where('appointment_data', date('Y-m-d', strtotime(request()->appointment_data)))->where('schedule_id',  $schedule->id)->count();
                    return [
                        'schedule' => $schedule,
                        'booking_count' => $max_participent_in_this_day,
                    ];
                } else {
                    return 'Invalid Schedule';
                }
            }
        }

        $serviceCategories = ServiceCategory::all();
        return view('frontend.booking', compact('serviceCategories'));
    }

    public function bookingStore(Request $request)
    {
        if (!auth()->check()) {
            //Validation check for gust user | Create user first
            $request->validate(
                [
                    'name'      => 'required|string',
                    'email'     => 'required|unique:users,email',
                    'phone'     => 'required|unique:users,phone',
                    'transaction_id'     => 'required|string',
                    'advance_amount'     => 'required|numeric',
                    'appointment_data' => 'required|string', // get from hidden
                    'schedule'  => 'required|exists:schedules,id', // get from hidden
                    'service'   => 'required|exists:services,id',
                    'message'   => 'nullable|string',
                ],
                [
                    'email.unique' => 'Already you have an account. Please login before order or use another email.',
                    'phone.unique' => 'Already you have an account. Please login before order or use another phone.',
                ]
            );

            $password = Str::random(8);
            $user = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone        = $request->phone;
            $user->password     = bcrypt($password);
            $user->save();
        } else {
            //Validation check for auth user
            $request->validate([
                'appointment_data'  => 'required|string', // get from hidden
                'schedule'          => 'required|exists:schedules,id', // get from hidden
                'service'           => 'required|exists:services,id',
                'message'           => 'nullable|string',
            ]);
            $user = Auth::user();
        }

        try {
            $schedule = \App\Models\Schedule::find($request->schedule) ?? null;
            $max_participent_in_this_day = Appointment::where('appointment_data', date('Y-m-d', strtotime(request()->appointment_data)))->where('schedule_id',  $request->schedule)->count();
            if ($max_participent_in_this_day < $schedule->maximum_participant) {
                $appointment = new Appointment();
                $appointment->customer_id       = $user->id;
                $appointment->appointment_data  = date('Y-m-d', strtotime($request->appointment_data));
                $appointment->schedule_id       = $request->schedule;
                $appointment->service_id        = $request->service;
                $appointment->message           = $request->message;
                $appointment->transaction_id    = $request->transaction_id;
                $appointment->advance_amount    = $request->advance_amount;
                $appointment->save();
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Housefull',
                ];
            }
        } catch (\Exception $exception) {
            if (request()->ajax()) {
                return [
                    'type' => 'error',
                    'message' => 'Something went wrong.',
                    // 'message' => $exception->getMessage(),
                ];
            }
            toastr()->error('Something went wrong!');
            return back();
        }

        if (request()->ajax()) {
            return [
                'type' => 'success',
                'message' => 'Thank you! We received your request.',
            ];
        }

        toastr()->success('Successfully Done!');
        return back();
    }

    public function service()
    {
        $serviceCategories = ServiceCategory::all();
        return view('frontend.service', compact('serviceCategories'));
    }

    public function serviceDetails($slug)
    {
        $service = Service::where('slug', $slug)->first();
        if ($service) {
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
            return view('frontend.service-details', compact('service', 'schedule_days'));
        } else {
            abort(404);
        }
    }
}
