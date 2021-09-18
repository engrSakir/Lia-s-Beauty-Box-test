@extends('layouts.backend.app')

@section('title') Invoice @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Invoice Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Invoice Page</li>
                </ol>
                <a href="{{ route('backend.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Invoice -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">{{ $invoices->count() }}</h1>
                    <h6 class="text-white">Total Invoice</h6>
                </div>
            </div>
        </div>
        <!-- Paid -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $total_paid }}</h1>
                    <h6 class="text-white">Total Paid Amount</h6>
                </div>
            </div>
        </div>
        <!-- Due -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">{{ $total_due }}</h1>
                    <h6 class="text-white">Total Due Amount</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>INV</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ '#1010' }}</td>
                                        <td>{{ $invoice->appointment->customer->name ?? '#' }}</td>
                                        <td>
                                            {{ $invoice->items()->sum(\DB::raw('quantity * price')) ?? '#' }}
                                        </td>
                                        <td>{{ $invoice->payments->sum('amount') }}</td>
                                        <td>{{ $invoice->items()->sum(DB::raw('quantity * price')) - $invoice->payments->sum('amount') }}</td>
                                        <td>{{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('backend.invoice.show', $invoice) }}" target="_blank"
                                                class="btn btn-primary waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-print"></i> </a>
                                            <a href="{{ route('backend.invoice.payment', $invoice) }}"
                                                class="btn btn-info waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-credit-card"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush