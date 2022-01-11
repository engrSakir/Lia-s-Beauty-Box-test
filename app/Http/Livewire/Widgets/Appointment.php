<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Schedule;
use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;

class Appointment extends Component
{
    public $date, $schedules, $selected_schedule, $services, $service_categories, $service_category;

    public function mount()
    {
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
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
        dd('store');
    }
}
