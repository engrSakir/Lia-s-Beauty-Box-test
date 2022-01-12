<?php

namespace App\Http\Livewire\Widgets;

use App\Models\AppointmentItem;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Mail;

class Appointment extends Component
{
    public $date, $schedules, $selected_schedule, $services, $service_categories, $service_category, $searched_key_in_busket, $staffs, $admin_mode;
    public $basket = array();

    public function mount()
    {
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
        $this->staffs = User::role('Employee')->get();
    }

    public function render()
    {
        if ($this->date) {
            // $this->schedules = 'Yes';
            $weekMap = [
                0 => 'sunday',
                1 => 'monday',
                2 => 'tuesday',
                3 => 'wednesday',
                4 => 'thursday',
                5 => 'friday',
                6 => 'saturday',
            ];
            $day_name = $weekMap[date('w', strtotime($this->date))];
            $this->schedules = [
                'day_name' => $day_name,
                'date' => $this->date,
                'data_set' => \App\Models\Schedule::where('schedule_day', $day_name)->get()
            ];
        }
        return view('livewire.widgets.appointment');
    }

    public function select_schedule(Schedule $schedule)
    {
        $this->selected_schedule = $schedule;
    }

    public function store()
    {
        if (count($this->basket) == 0) {
            //return alert
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'You have to select some service']);
        } else {
            $this->validate([
                'date'  => 'required|string',
                'selected_schedule' => 'required|exists:schedules,id',
            ]);
            if (!$this->admin_mode) {
                //Common Validation check for all user
                $this->validate([
                    'message'           => 'nullable|string',
                    'transaction_id'     => 'required|string',
                    'advance_amount'   => 'required|numeric|min:' . get_static_option('advance_amount'),
                ]);
                if (!auth()->check()) {
                    //Validation check for guest user | Create user first
                    $this->validate(
                        [
                            'name'      => 'required|string',
                            'email'     => 'nullable|email', //Not Unique because Email is Nullable
                            'phone'     => 'required|unique:users,phone',
                            'address'     => 'nullable|string',
                            'message'   => 'nullable|string',
                        ],
                        [
                            'phone.unique' => 'Already you have an account. Please login before order or use another phone.',
                        ]
                    );
                    $password = Str::random(8);
                    $user = new User();
                    $user->name         = $this->name;
                    $user->email        = $this->email;
                    $user->phone        = $this->phone;
                    $user->address        = $this->address;
                    $user->password     = bcrypt($password);
                    $user->save();
                    $user->assignRole('Customer');
                } else {
                    $user = Auth::user();
                }
            } else {
                // Validattion For admin
                $this->validate(
                    [
                        'name'      => 'required|string',
                        'email'     => 'nullable|email',
                        'phone'     => 'required|string',
                        'address'     => 'nullable|string',
                    ]
                );
                if ($this->email) {
                    $user = User::where('email', $this->email)->first();
                } else if ($this->phone) {
                    $user = User::where('phone', $this->phone)->first();
                } else {
                    $user = User::where('name', $this->name)->first();
                }

                $password = null;

                if (!$user) {
                    $this->validate(
                        [
                            'name'      => 'required|string',
                            'email'     => 'nullable|email', //Not Unique because Email is Nullable
                            'phone'     => 'required|unique:users,phone',
                            'address'     => 'nullable|string',
                            'message'   => 'nullable|string',
                        ],
                        [
                            'phone.unique' => 'This phone number already used. Please use another phone number.',
                        ]
                    );
                    $password = Str::random(8);
                    $user = new User();
                    $user->password     = bcrypt($password);
                }
                //New save or auto update
                $user->name         = $this->name;
                $user->email        = $this->email;
                $user->phone        = $this->phone;
                $user->address      = $this->address;
                $user->save();
                if ($password) {
                    $user->assignRole('Customer');
                }
            }
            //Create Schedule
            $max_participent_in_this_day = Appointment::where('appointment_data', date('Y-m-d', strtotime($this->date)))
                ->where('schedule_id',  $this->selected_schedule->id)
                ->where('status', '!=', 'Reject')->count();
            if ($max_participent_in_this_day > $this->selected_schedule->maximum_participant) {
                //Not Available Caz Max Participent.
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Max Participent Is Over']);
            } else {
                // Available For New Appointment.
                $appointment = new Appointment();
                $appointment->customer_id       = $user->id;
                $appointment->appointment_data  = date('Y-m-d', strtotime($this->date));
                $appointment->schedule_id       = $this->selected_schedule;
                $appointment->transaction_id    = $this->transaction_id;
                $appointment->advance_amount    = $this->advance_amount ?? 0;
                if ($this->admin_mode) {
                    $appointment->status            = 'Approved'; //Administritive auto approve 
                }
                $appointment->save();

                //Create Appointment Items
                foreach ($this->basket as $array_key => $basket) {
                    $appointment_item = new AppointmentItem();
                    $appointment_item->appointment_id = $appointment->id;
                    $appointment_item->staff_id = $basket['staff_id'];
                    $appointment_item->service_id = $basket['id'];
                    $appointment_item->quantity = $basket['qty'];
                    $appointment_item->save();
                }
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Save']);
                //Email Sending..
                if ($appointment->customer->email) {
                    try {
                        $data = [
                            'from'    => 'from@email.com',
                            'to'      => $appointment->customer->email,
                            'subject' => 'Booking Approved',
                            'pdf'     => PDF::loadView('backend.invoice.advance-inv-pdf', compact('appointment')),
                        ];
                        Mail::send(
                            'emails.adance_payment',
                            ['data' => $data],
                            function ($message) use ($data) {
                                $message
                                    ->from($data['from'])
                                    ->to($data['to'])
                                    ->subject($data['subject'])
                                    ->attachData($data['pdf']->output(), 'invoice.pdf');
                            }
                        );
                        // Success Alert of Email Sending
                        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Email Sent']);
                    } catch (\Exception $exception) {
                        // Error Alert of Email Not Sending
                        $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
                    }
                }
            }
        }
    }

    public function addToCard($id)
    {
        $this->searched_key_in_busket = null;
        foreach ($this->basket as $array_key => $val) {
            if ($val['id'] === $id) {
                $this->searched_key_in_busket =  $array_key;
            }
        }
        if ($this->searched_key_in_busket === null || count($this->basket) < 1) {
            array_push($this->basket, [
                'id' => $id,
                'qty' => 1,
                'name' => Service::find($id)->name,
                'price' => Service::find($id)->price,
                'sub_total_price' => Service::find($id)->price,
                'staff_id' => null,
            ]);
        } else {
            $this->basket[$this->searched_key_in_busket]['qty']++;
            $this->basket[$this->searched_key_in_busket]['sub_total_price'] += Service::find($id)->price;
        }
    }

    public function removeFromCard($id)
    {
        try {
            $this->searched_key_in_busket = null;
            foreach ($this->basket as $array_key => $val) {
                if ($val['id'] === $id) {
                    $this->searched_key_in_busket =  $array_key;
                }
            }
            if ($this->basket[$this->searched_key_in_busket]['qty'] > 1) {
                $this->basket[$this->searched_key_in_busket]['qty']--;
                $this->basket[$this->searched_key_in_busket]['sub_total_price'] -= Service::find($id)->price;
            } else {
                unset($this->basket[$this->searched_key_in_busket]);
            }
        } catch (\Exception $e) {
        }
    }


    public function allRemoveFromCard($id)
    {
        try {
            $this->searched_key_in_busket = null;
            foreach ($this->basket as $array_key => $val) {
                if ($val['id'] === $id) {
                    $this->searched_key_in_busket =  $array_key;
                }
            }
            unset($this->basket[$this->searched_key_in_busket]);
        } catch (\Exception $e) {
        }
    }

    public function staff_assign($staff_id, $basket_key)
    {
        $this->basket[$basket_key]['staff_id'] = $staff_id;
    }
}
