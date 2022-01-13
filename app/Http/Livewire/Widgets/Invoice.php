<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Appointment;
use App\Models\Invoice as ModelsInvoice;
use App\Models\InvoiceItem;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Livewire\Component;

class Invoice extends Component
{
    public $appointments, $selected_appointment, $services, $service_categories, $employees, $payment_methods;
    public $basket = array();
    public $total_price, $price_after_discount, $total_vat, $advance_payment, $have_to_pay, $total_include_vat, $discount_percentage, $discount_fixed, $payment_method, $note;

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

            $this->total_vat = round((15 / 100) * $this->total_price, 2);
            $this->total_include_vat = $this->total_vat + $this->price_after_discount;
            $this->have_to_pay =  $this->total_include_vat - $this->advance_payment;
        }
    }

    public function save_invoice()
    {
        if (count($this->basket) == 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Basket Is Empty']);
        } else {
            $this->validate([
                'payment_method' => 'required',
            ]);
            $appointment = Appointment::find($this->selected_appointment);
            $appointment->status = 'Done';
            $appointment->save();
            //Create invoice
            $invoice = new ModelsInvoice();
            $invoice->appointment_id = $appointment->id;
            $invoice->vat_percentage = 15; //Always 15% as discouse in meeting
            $invoice->discount_percentage = (float)$this->discount_percentage;
            $invoice->fixed_discount = (float)$this->discount_fixed;
            $invoice->payment_method_id = (int)$this->payment_method;
            $invoice->note = $this->note;
            $invoice->save();

            try {
                foreach ($this->basket as $array_key => $basket_item) {
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem->invoice_id   = $invoice->id;
                    $invoiceItem->service_id   = $basket_item['id'];
                    $invoiceItem->quantity  = $basket_item['qty'];
                    $invoiceItem->price     = $basket_item['price'];
                    $invoiceItem->staff_id     = $basket_item['staff_id'];
                    $invoiceItem->save();
                }
                $this->basket = array();
                $this->selected_appointment = $this->payment_method = $this->discount_percentage = $this->discount_fixed = null;
                $this->appointments = Appointment::where('status', 'Approved')->get();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
            } catch (\Exception $e) {
                // Appointment status back and invoice delete
                $invoice->delete();
                $appointment->status = 'Approved';
                $appointment->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $e->getMessage()]);
            }
        }
    }
}
