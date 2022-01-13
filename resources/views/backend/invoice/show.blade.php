@extends('layouts.backend.app')

@section('title') Invoice Create @endsection

@section('bread-crumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Invoice Details Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Invoice Create Page</li>
            </ol>
            <a href="{{ route('backend.invoice.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i>Invoice List</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="row m-2">
        <a href="{{ route('backend.invoice.show', $invoice) }}" target="_blank" class="btn btn-primary col-12 mb-3"> 
            <i class="fas fa-print"></i> </a>
        <div class="col-md-6">
            <div class="card-header bg-primary text-white">
                <b>Service list</b>
            </div>
            <div class="list-group">
                @foreach ($invoice->items as $item)
                <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{ $item->service->name }}</h5>
                      <small class="text-muted">Price: {{ $item->price }} * {{ $item->quantity }} = {{ $item->price * $item->quantity }}</small>
                    </div>
                    <small class="text-muted">{{ $item->staff->name ?? '#' }}</small>
                  </a>
                @endforeach
              </div>
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item active text-center">Customer information</li>
                <li class="list-group-item">Customer id: #{{ $invoice->appointment->customer->id ?? '#' }}</li>
                <li class="list-group-item">Customer name: {{ $invoice->appointment->customer->name ?? '#' }}</li>
                <li class="list-group-item">Customer email: {{ $invoice->appointment->customer->email ?? '#' }}</li>
                <li class="list-group-item">Customer phone: {{ $invoice->appointment->customer->phone ?? '#' }}</li>
                <li class="list-group-item">Customer address: {{ $invoice->appointment->customer->address ?? '#' }}</li>
                <li class="list-group-item active text-center">Price information</li>
                <li class="list-group-item">VAT Percentage: {{ $invoice->vat_percentage }}</li>
                <li class="list-group-item">Discount Percentage: {{ $invoice->discount_percentage }}</li>
                <li class="list-group-item">Discount Fixed: {{ $invoice->fixed_discount }}</li>
                <li class="list-group-item">Total without vat price: {{ $invoice->price() - $invoice->vat() }}</li>
                <li class="list-group-item">Total with vat price: {{ $invoice->price() }}</li>
                <li class="list-group-item">Total vat: {{ $invoice->vat() }}</li>
                <li class="list-group-item">Advance: {{ $invoice->appointment->advance_amount ?? 'Not Found' }}</li>
                <li class="list-group-item">Advance Date: {{ $invoice->appointment->created_at->format('h:i A d-m-Y') ?? 'Not Found' }}</li>
                <li class="list-group-item">Invoice Date: {{ $invoice->created_at->format('h:i A d-m-Y') ?? 'Not Found' }}</li>
              </ul>
        </div>
    </div>
</div>
</div>

@endsection

@push('head')

@endpush

@push('foot')

@endpush