<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Livewire\Component;

class Appointment extends Component
{
    public $date, $schedules, $selected_schedule, $services, $service_categories, $service_category, $searched_key_in_busket, $staffs;
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
        dd($this->basket);
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
