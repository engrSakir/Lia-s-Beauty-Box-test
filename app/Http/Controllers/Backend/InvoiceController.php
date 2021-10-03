<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\ReferralDiscountPercentage;
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
        $total_paid = Payment::all()->sum('amount');
        $total_due = InvoiceItem::sum(DB::raw('quantity * price')) - Payment::all()->sum('amount');
        $total_vat = 0;
        foreach (Invoice::all() as $invoice) {
            $total_vat += $invoice->items()->sum(DB::raw('quantity * price')) / 100 * $invoice->vat_percentage;
        }
        $invoices = Invoice::orderBy('id', 'desc')->paginate(20);
        return view('backend.invoice.index', compact('invoices', 'total_paid', 'total_due', 'total_vat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appointments = Appointment::where('status', 'Approved')->get();
        $serviceCategories = ServiceCategory::all();
        return view('backend.invoice.create', compact('appointments', 'serviceCategories'));
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
            'vat_percentage'    => 'nullable|numeric|min:0|max:100',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            // 'advance_payment_amount'=> 'nullable|numeric', // get from invoice
            'new_payment_amount' => 'nullable|numeric',
            'note'              => 'nullable|string',
        ]);
        //Change appointment status
        $appointment = Appointment::find($request->appointment_id);
        if ($appointment->status != 'Approved') {
            // return back();
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
            $invoice->vat_percentage = $request->vat_percentage ?? 0;
            $invoice->discount_percentage = $request->discount_percentage ?? 0;
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
                $payment = new Payment();
                $payment->invoice_id = $invoice->id;
                $payment->amount = $request->new_payment_amount + $appointment->advance_amount ?? 0;
                $payment->save();
                return [
                    'type' => 'success',
                    'message' => 'Successfully Created',
                    'invoice_url' => route('backend.invoice.show', $invoice),
                    'btn_url' => route('backend.invoice.payment', $invoice),
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
        // $pdf = PDF::loadView('backend.invoice.invoice-pdf', compact('invoice'));
        // return $pdf->stream('Invoice-'.config('app.name').'.pdf');

        //Thermal printer code
        // Set params
        $mid = '123123456';
        $store_name = 'YOURMART';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';
        $currency = 'Rp';

        // Set items
        $items = [
            [
                'name' => 'French Fries (tera)',
                'qty' => 2,
                'price' => 65000,
            ],
            [
                'name' => 'Roasted Milk Tea (large)',
                'qty' => 1,
                'price' => 24000,
            ],
            [
                'name' => 'Honey Lime (large)',
                'qty' => 3,
                'price' => 10000,
            ],
            [
                'name' => 'Jasmine Tea (grande)',
                'qty' => 3,
                'price' => 8000,
            ],
        ];

        // Init printer
        // $printer = new ReceiptPrinter;
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // Set currency
        $printer->setCurrency($currency);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        $printer->setQRcode([
            'tid' => $transaction_id,
        ]);

        // Print receipt
        $printer->printReceipt();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function payment(Invoice $invoice)
    {
        return view('backend.invoice.payment', compact('invoice'));
    }

    public function paymentStore(Request $request, Invoice $invoice)
    {
        $request->validate([
            'payment_amount'    => 'required|numeric|min:1',
        ]);

        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->amount = $request->payment_amount;
        $payment->save();

        toastr()->success('successfully payment done!');
        return back();
    }

    public function paymentReceipt(Payment $payment)
    {
        $pdf = PDF::loadView('backend.invoice.receipt-pdf', compact('payment'));
        return $pdf->stream('Payment Receipt-' . config('app.name') . '.pdf');
    }
}
