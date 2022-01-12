<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;

class Invoice extends Component
{
    public $appointments, $selected_appointment, $services, $service_categories;
    public $basket = array();
    public $name, $email, $phone, $address, $transaction_id, $advance_amount, $message;

    public function mount(){
        $this->appointments = Appointment::where('status', 'Approved')->get();
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
    }

    public function render()
    {
        return view('livewire.widgets.invoice');
    }

    public function select_appointment(Appointment $appointment){
        // dd($appointment);
        $this->basket = array();
        foreach($appointment->items as $item){
            array_push($this->basket, [
                'id' => $item->service_id,
                'qty' => $item->quantity,
                'name' => Service::find($item->service_id)->name,
                'price' => Service::find($item->service_id)->price,
                'sub_total_price' => Service::find($item->service_id)->price,
                'staff_id' => $item->staff_id,
            ]);
        }
    }
}
