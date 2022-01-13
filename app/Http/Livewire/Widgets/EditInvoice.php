<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Invoice as ModelsInvoice;
use App\Models\InvoiceItem;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

class EditInvoice extends Component
{
    public $invoice;

    public $services, $service_categories, $employees, $payment_methods;
    public $basket = array();
    public $total_price, $price_after_discount, $total_vat, $advance_payment, $have_to_pay, $total_include_vat, $discount_percentage, $discount_fixed, $payment_method, $note;

    public function mount()
    {
        $this->service_categories = ServiceCategory::all();
        $this->services = Service::all();
        $this->employees = User::role('Employee')->get();
        $this->payment_methods = PaymentMethod::all();
        $this->payment_method = $this->invoice->payment_method_id;

        $this->basket = array();
        foreach ($this->invoice->items as $item) {
            array_push($this->basket, [
                'id' => $item->service_id,
                'qty' => $item->quantity,
                'name' => Service::find($item->service_id)->name,
                'price' => $item->price,
                'sub_total_price' => $item->price * $item->quantity,
                'staff_id' => $item->staff_id,
            ]);
        }
    }

    public function render()
    {
        $this->calculation();
        return view('livewire.widgets.edit-invoice');
    }

    public function chnage_price($price, $basket_key)
    {
        $this->basket[$basket_key]['price'] = (float)$price;
        $this->basket[$basket_key]['sub_total_price'] = (float)$price * $this->basket[$basket_key]['qty'];
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


    public function calculation()
    {
        $this->total_price =  $this->price_after_discount = $this->total_vat = $this->advance_payment
            = $this->have_to_pay = $this->total_include_vat = 0;
        //Total Price
        $this->advance_payment = $this->invoice->appointment->advance_amount;
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

    public function save_invoice()
    {
        if (count($this->basket) == 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Your Basket Is Empty']);
        } else {
            $this->validate([
                'payment_method' => 'required',
            ]);
            //Update invoice
            $invoice = $this->invoice;
            // $invoice->appointment_id = $appointment->id;
            // $invoice->vat_percentage = 15; //Always 15% as discouse in meeting
            $invoice->discount_percentage = (float)$this->discount_percentage;
            $invoice->fixed_discount = (float)$this->discount_fixed;
            $invoice->payment_method_id = (int)$this->payment_method;
            $invoice->note = $this->note;
            $invoice->save();
            //Delete First All Item of This Invoice
            $invoice->items()->delete();
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
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
            } catch (\Exception $e) {
                // Appointment status back and invoice delete
                $invoice->delete();
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $e->getMessage()]);
            }
        }
    }
}
