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
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

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
                    'advance_amount'   => 'required|numeric|min:'.get_static_option('advance_amount'),
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
            $user->assignRole('Customer');
        } else {
            //Validation check for auth user
            $request->validate([
                'appointment_data'  => 'required|string', // get from hidden
                'schedule'          => 'required|exists:schedules,id', // get from hidden
                'service'           => 'required|exists:services,id',
                'message'           => 'nullable|string',
                'advance_amount'   => 'required|numeric|min:'.get_static_option('advance_amount'),
            ]);
            $user = Auth::user();
        }

        try {
            $schedule = \App\Models\Schedule::find($request->schedule) ?? null;
            $max_participent_in_this_day = Appointment::where('appointment_data', date('Y-m-d', strtotime(request()->appointment_data)))->where('schedule_id',  $request->schedule)->where('status','!=', 'Reject')->count();
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
                    //'message' => $exception->getMessage(),
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

    public function getContactForm(){
        return view('frontend.contact');
    }

    public function handleContactForm(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required|email', 'phone' => 'required|numeric','message' => 'required']);
        $data = ['name' => $request->get('name') , 'email' => $request->get('email') ,'phone' => $request->get('phone'), 'messageBody' => $request->get('message') ];
        Mail::send('emails.email', $data, function ($message) use ($data)        {
            $message->from($data['email'], $data['name']);
            $message->to('moumitasub@gmail.com', 'Admin')
                ->subject('Contact Us Message');
        });
        toastr()->success('Thank you for your feedback');
        return back()->with('alert', 'Success!');;
    }

    public function getRegisterFormWithRefCode($ref_code = null){
        $invalid_ref_alert = null;
        if(!$ref_code || !User::where('referral_code', $ref_code)->exists()){
            $invalid_ref_alert = 'Invalid referral code';
        }

        return view('frontend.ref-register',compact('ref_code', 'invalid_ref_alert'));
    }

    public function registrationWithRefCode(Request $request, $ref_code){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone|min:6|max:18',
            'password' => 'required|confirmed|string|min:4|max:50',
        ]);

        $ref_user = User::where('referral_code', $ref_code)->first();
        if(!$ref_code || !$ref_user){
            return redirect()->back()->with('error', 'Invalid referral code');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'refer_by_id' => $ref_user->id,
        ])->assignRole('Customer');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }
}
