<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PaymentMethod;
use App\Models\ReferralDiscountPercentage;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_paid = total_sale_amount();
        $total_vat = total_vat();
        $invoices = Invoice::orderBy('id', 'desc')->paginate(500);
        return view('backend.invoice.index', compact('invoices', 'total_paid', 'total_vat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appointments = Appointment::where('status', 'Approved')->get();
        $itemCategories = ServiceCategory::all();
        $items = Service::all();
        $paymentmethods = PaymentMethod::all();
        return view('backend.invoice.create', compact('appointments', 'itemCategories', 'items', 'paymentmethods'));
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
            'appointment_id'    => 'required|exists:appointments,id',
            'service_data_set'  => 'required',
            // 'vat_percentage'    => 'nullable|numeric|min:0|max:100',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'fixed_discount' => 'nullable|numeric',
            // 'advance_payment_amount'=> 'nullable|numeric', // get from invoice
            'new_payment_amount' => 'nullable|numeric',
            'note'              => 'nullable|string',
            'payment_method'  => 'required',

        ]);
        //Change appointment status
        $appointment = Appointment::find($request->appointment_id);
        if ($appointment->status != 'Approved') {
            return [
                'type' => 'error',
                'message' => 'This appointment is not approved. (' . $appointment->id . ')',
            ];
        } else {
            $appointment->status = 'Done';
            $appointment->save();
            //Create invoice
            $invoice = new Invoice();
            $invoice->appointment_id = $appointment->id;
            $invoice->vat_percentage = 15; //Always 15% as discouse in meeting
            $invoice->discount_percentage = $request->discount_percentage ?? 0;
            $invoice->fixed_discount = $request->fixed_discount ?? 0;
            $invoice->payment_method_id = $request->payment_method;
            $invoice->note = $request->note;
            $invoice->save();
            //Invoice item save with this invoice ID
            try {
                foreach ($request->service_data_set as $service_data) {
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem->invoice_id   = $invoice->id;
                    $invoiceItem->service_id   = $service_data['service'];
                    $invoiceItem->quantity  = $service_data['quantity'];
                    $invoiceItem->price     = $service_data['price'];
                    $invoiceItem->save();
                }
                return [
                    'type' => 'success',
                    'message' => 'Successfully Created',
                    'invoice_url' => route('backend.invoice.show', $invoice),
                ];
            } catch (\Exception $e) {
                // Appointment status back and invoice delete
                $invoice->delete();
                $appointment->status = 'Approved';
                $appointment->save();
                return [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $pdf = PDF::loadView('backend.invoice.pos-pdf', compact('invoice'));
        return $pdf->stream('Invoice-' . config('app.name') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $appointments = Appointment::all();
        $itemCategories = ServiceCategory::all();
        $paymentmethods = PaymentMethod::all();
        $items = Service::all();
        return view('backend.invoice.edit', compact('appointments', 'itemCategories', 'paymentmethods', 'invoice', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'appointment_id'    => 'required|exists:appointments,id',
            'service_data_set'  => 'required',
            // 'vat_percentage'    => 'nullable|numeric|min:0|max:100',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'fixed_discount' => 'nullable|numeric',
            // 'advance_payment_amount'=> 'nullable|numeric', // get from invoice
            'new_payment_amount' => 'nullable|numeric',
            'note'              => 'nullable|string',
            'payment_method'  => 'required',

        ]);
        //Change appointment status
        $appointment = Appointment::find($request->appointment_id);
        if ($invoice->appointment_id != $request->appointment_id) {
            $appointment->status = 'Done';
            $appointment->save();
        }
        //Update invoice
        $invoice->appointment_id = $appointment->id;
        $invoice->vat_percentage = 15;
        $invoice->discount_percentage = $request->discount_percentage ?? 0;
        $invoice->fixed_discount = $request->fixed_discount ?? 0;
        $invoice->payment_method_id = $request->payment_method;
        $invoice->note = $request->note;
        $invoice->save();
        //Invoice item save with this invoice ID
        $invoice->items()->delete(); // First delete all items of this invoice
        try {
            foreach ($request->service_data_set as $service_data) {
                $invoiceItem = new InvoiceItem();
                $invoiceItem->invoice_id   = $invoice->id;
                $invoiceItem->service_id   = $service_data['service'];
                $invoiceItem->quantity  = $service_data['quantity'];
                $invoiceItem->price     = $service_data['price'];
                $invoiceItem->save();
            }
            return [
                'type' => 'success',
                'message' => 'Successfully Created',
                'invoice_url' => route('backend.invoice.show', $invoice),
            ];
        } catch (\Exception $e) {
            // Appointment status back and invoice delete
            $invoice->delete();
            $appointment->status = 'Approved';
            $appointment->save();
            return [
                'type' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }

    public function getItemsBycategory($category = null)
    {
        $items = Service::all();
        if ($category != 'All') {
            $items = Service::where('category_id', $category)->get();
        }
        return $items;
    }
}
