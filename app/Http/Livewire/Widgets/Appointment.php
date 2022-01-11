<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;

class Appointment extends Component
{
    public $date, $schedules;

    public function render()
    {
        if($this->date){
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
                'schedules' => \App\Models\Schedule::where('schedule_day', $day_name)->get()
            ];
        }
        return view('livewire.widgets.appointment');
    }
}
