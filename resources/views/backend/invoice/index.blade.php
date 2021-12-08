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
    @if (auth()->user()->hasRole('Admin')) 
        <!-- Invoice -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">{{ $total_inv_of_this_month }}</h1>
                    <h6 class="text-white">Total Invoice of {{ date('F') }}</h6>
                </div>
            </div>
        </div>
        <!-- Paid -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $total_paid }}</h1>
                    <h6 class="text-white">Total Paid Amount of {{ date('F') }}</h6>
                </div>
            </div>
        </div>
       
        @can('Total vat amount visibility permission')
        <!-- VAT -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">{{ $total_vat }}</h1>
                    <h6 class="text-white">Total VAT Amount of {{ date('F') }}</h6>
                </div>
            </div>
        </div>
        @endcan
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Services</th>
                                    <th>Price</th>

                                    @can('Total vat amount visibility permission')
                                    <th>Vat</th>
                                    @endcan
                                    {{-- <th>Due</th> --}}
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->appointment->customer->name ?? '#' }}</td>
                                        <td>{{ $invoice->appointment->customer->phone ?? '#' }}</td>
                                        <td>
                                        @foreach($invoice->items as $item)
                                        {{ $item->service->name ?? '#' }},
                                        @endforeach
                                        </td>
                                        <td>
                                            {{ $invoice->price() }}
                                        </td>
                                        @can('Total vat amount visibility permission')
                                        <td>
                                            {{ $invoice->vat() }}
                                        </td>
                                        @endcan
                                        <td>{{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('backend.invoice.show', $invoice) }}" target="_blank"
                                                class="btn btn-primary waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-print"></i> </a>
                                            <a target="_blank" href="{{ route('backend.invoice.edit', $invoice) }}"
                                                class="btn btn-secondary waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-pen"></i> </a>
                                                    <button value="{{ route('backend.invoice.destroy', $invoice) }}"
                                                class="btn btn-danger btn-circle delete-btn"><i class="fa fa-trash"></i>
                                            </button>
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
