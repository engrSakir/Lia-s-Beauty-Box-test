<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Appointment;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Livewire\Component;

class Invoice extends Component
{
    public $appointments, $selected_appointment, $services, $service_categories, $employees, $payment_methods;
    public $basket = array();
    public $total_price, $price_after_discount, $total_vat, $advance_payment, $have_to_pay, $total_include_vat, $selected_payment_method, $discount_percentage, $discount_fixed;

    public function mount()
    {
        $this->appointments = Appointment::where('status', 'Approved')->get();
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
        $this->employees = User::role('Employee')->get();
        $this->payment_methods = PaymentMethod::all();
    }

    public function render()
    {
        $this->calculation();
        return view('livewire.widgets.invoice');
    }

    public function select_appointment($appointment)
    {
        if (!$appointment) {
            $this->basket = array();
        } else {
            $appointment = Appointment::find($appointment);
            $this->basket = array();
            foreach ($appointment->items as $item) {
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

    public function chnage_price($price, $basket_key)
    {
        $this->basket[$basket_key]['price'] = (float)$price;
    }

    public function chnage_employee($staff_id, $basket_key)
    {
        $this->basket[$basket_key]['staff_id'] = (int)$staff_id;
    }

    public function addToCard($id)
    {
        if (!$this->selected_appointment) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Selected appointment not found']);
        } else {
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


    public function calculation()
    {
        $this->total_price =  $this->price_after_discount = $this->total_vat = $this->advance_payment
            = $this->have_to_pay = $this->total_include_vat = 0;
        if ($this->selected_appointment) {
            $appointment = Appointment::find($this->selected_appointment);
            //Total Price
            $this->advance_payment = $appointment->advance_amount;
            foreach ($this->basket as $array_key => $basket_item) {
                $this->total_price += $basket_item['price'] * $basket_item['qty'];
            }
            //Price After Discount
            $this->price_after_discount = $this->total_price - round(((float)$this->discount_percentage / 100) * $this->total_price, 2);
            $this->price_after_discount = $this->price_after_discount - (float)$this->discount_fixed;
            //Have to pay
            $this->have_to_pay = $this->price_after_discount - $this->advance_payment;
        }
    }

    public function save_invoice()
    {
        dd('Inv');
    }
}
