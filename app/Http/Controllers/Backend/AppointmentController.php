<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::orderBy('id', 'desc')->paginate(20);
        return view('backend.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $serviceCategories = ServiceCategory::all();
        return view('backend.appointment.create', compact('users', 'serviceCategories'));
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
            'phone'     => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            $request->validate([
                'appointment_data'  => 'required|string', // get from hidden
                'schedule'          => 'required|exists:schedules,id', // get from hidden
                'service'           => 'required|exists:services,id',
                'message'           => 'nullable|string',
            ]);
        } else {
            $request->validate(
                [
                    'name'      => 'required|string',
                    'email'     => 'required|unique:users,email',
                    'phone'     => 'required|unique:users,phone',
                    'appointment_data' => 'required|string', // get from hidden
                    'schedule'  => 'required|exists:schedules,id', // get from hidden
                    'service'   => 'required|exists:services,id',
                    'message'   => 'nullable|string',
                    'transaction_id'     => 'nullable',
                    'advance_amount'     => 'nullable|numeric',
                ],
                [
                    'email.unique' => 'This email already used. Please use another email.',
                    'phone.unique' => 'This phone number already used. Please use another phone number.',
                ]
            );
            $password = Str::random(8);
            $user = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone        = $request->phone;
            $user->password     = bcrypt($password);
            $user->save();
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
                    // 'message' => $exception->getMessage(),
                ];
            }
            toastr()->error('Something went wrong!');
            return back();
        }

        if (request()->ajax()) {
            return [
                'type' => 'success',
                'message' => 'Successfully done.',
            ];
        }

        toastr()->success('Successfully Done!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        if (request()->ajax()) {
            return [
                'appointment' => $appointment,
                'service' => $appointment->service ?? null,
                'vat_percentage' => $appointment->customer->category->vat_percentage ?? 0,
                'discount_percentage' => $appointment->customer->category->discount_percentage ?? 0,
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $users = User::all();
        $serviceCategories = ServiceCategory::all();
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
        return view('backend.appointment.edit', compact('appointment', 'users', 'serviceCategories', 'schedule_days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //Only Status change
        if ($request->request_for == 'StatusChange') {
            $request->validate([
                'status' => 'required'
            ]);
            if ($appointment->status == $request->status) {
                if ($request->ajax()) {
                    return response()->json([
                        'type' => 'worning',
                        'message' => 'Status already ' . $request->status
                    ]);
                }
                toastr()->error('Status already ' . $request->status);
                return back();
            }
            $appointment->status = $request->status;
            $appointment->save();
            if (request()->ajax()) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'Status successfully change to ' . $appointment->status
                ]);
            }
            toastr()->success('Status successfully change to ' . $appointment->status);
            return back();
        } else {
            //Full update
            $request->validate([
                'phone'     => 'required',
            ]);

            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                $request->validate([
                    'appointment_data'  => 'required|string', // get from hidden
                    'schedule'          => 'required|exists:schedules,id', // get from hidden
                    'service'           => 'required|exists:services,id',
                    'message'           => 'nullable|string',
                ]);
            } else {
                $request->validate(
                    [
                        'name'      => 'required|string',
                        'email'     => 'required|unique:users,email',
                        'phone'     => 'required|unique:users,phone',
                        'appointment_data' => 'required|string', // get from hidden
                        'schedule'  => 'required|exists:schedules,id', // get from hidden
                        'service'   => 'required|exists:services,id',
                        'message'   => 'nullable|string',
                        'transaction_id'     => 'nullable',
                        'advance_amount'     => 'nullable|numeric',
                    ],
                    [
                        'email.unique' => 'This email already used. Please use another email.',
                        'phone.unique' => 'This phone number already used. Please use another phone number.',
                    ]
                );
                $password = Str::random(8);
                $user = new User();
                $user->name         = $request->name;
                $user->email        = $request->email;
                $user->phone        = $request->phone;
                $user->password     = bcrypt($password);
                $user->save();
            }

            try {
                $appointment->customer_id       = $user->id;
                $appointment->appointment_data  = date('Y-m-d', strtotime($request->appointment_data));
                $appointment->schedule_id       = $request->schedule;
                $appointment->service_id        = $request->service;
                $appointment->transaction_id        = $request->transaction_id;
                $appointment->advance_amount           = $request->advance_amount;
                $appointment->message           = 'Booking by admin';
                $appointment->booked_by_admin   = true;
                $appointment->save();
            } catch (\Exception $exception) {
                if (request()->ajax()) {
                    return [
                        'type' => 'error',
                        'message' => 'Something went wrong.',
                    ];
                }
                toastr()->error('Something went wrong!');
                return back();
            }

            if (request()->ajax()) {
                return [
                    'type' => 'success',
                    'message' => 'Successfully updated.',
                ];
            }

            toastr()->success('Successfully updated!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
