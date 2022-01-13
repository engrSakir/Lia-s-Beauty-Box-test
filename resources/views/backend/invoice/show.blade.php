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
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column center">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Customer Name : {{ $invoice->appointment->customer->name ?? '#' }}</h3>
            </div>
        </header>
        <div class="col-md-12">
            <table class="table table-striped my-3">
                <thead class=" thead-dark">
                    <tr>
                        <th scope="col">Service</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $key => $item)
                    <tr>
                        <td>{{ $item->service->name ?? '#'}}</td>
                        <td>{{ $item->service->price ?? 0}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h3>Price : {{ $invoice->price() }} BDT</h3>
        <h3>Vat : {{ $invoice->vat() }}</h3>
        <h4 class="mb-5">Created Time : {{ $invoice->created_at->format('d/m/Y h:i A') }}</h4>
        <td>
            <a href="{{ route('backend.invoice.show', $invoice) }}" target="_blank"
                class="btn btn-primary waves-effect btn-rounded waves-light my-2"> Print Invoice </a>
            <a target="_blank" href="{{ route('backend.invoice.edit', $invoice) }}"
                class="btn btn-success waves-effect btn-rounded waves-light my-2">Edit Invoice</a>
            <button value="{{ route('backend.invoice.destroy', $invoice) }}"
                class="btn btn-danger waves-effect btn-rounded waves-light delete-btn my-2">
                Delete Invoice
            </button>
        </td>
    </div>
</div>
</div>

@endsection

@push('head')

@endpush

@push('foot')

@endpush