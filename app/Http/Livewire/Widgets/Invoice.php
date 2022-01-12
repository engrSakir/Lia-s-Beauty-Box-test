<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Livewire\Component;

class Invoice extends Component
{
    public $appointments, $selected_appointment, $services, $service_categories, $employees;
    public $basket = array();
    public $name, $email, $phone, $address, $transaction_id, $advance_amount, $message;

    public function mount(){
        $this->appointments = Appointment::where('status', 'Approved')->get();
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
        $this->employees = User::role('Employee')->get();
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

    public function chnage_price($price, $basket_key)
    {
        $this->basket[$basket_key]['price'] = (double)$price;
    }

    public function chnage_employee($staff_id, $basket_key)
    {
        $this->basket[$basket_key]['staff_id'] = (int)$staff_id;
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
}
