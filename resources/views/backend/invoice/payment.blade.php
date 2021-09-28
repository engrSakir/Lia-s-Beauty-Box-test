@extends('layouts.backend.app')

@section('title') Payment @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Payment Page</li>
                </ol>
                <a href="{{ route('backend.invoice.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Invoice List</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Price -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"> {{ inv_calculator($invoice)['price'] }}</h1>
                    <h6 class="text-white">Total Price</h6>
                </div>
            </div>
        </div>
        <!-- Paid -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">{{ $invoice->payments->sum('amount') }}</h1>
                    <h6 class="text-white">Total Paid Amount</h6>
                </div>
            </div>
        </div>
        {{-- <!-- Due -->
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <div class="card">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">
                        {{ inv_calculator($invoice)['due'] }}</h1>
                    <h6 class="text-white">Total Due Amount</h6>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Payment Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->payments as $payment)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->created_at->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('backend.paymentReceipt', $payment) }}" target="_blank"
                                                class="btn btn-primary waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-print"></i> </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Payment form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.invoice.payment', $invoice) }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="form-body">
                            <h3 class="card-title">Total Price: BDT
                                {{ inv_calculator($invoice)['price'] }} <a
                                href="{{ route('backend.invoice.show', $invoice) }}" target="_blank"
                                class="btn btn-primary waves-effect btn-rounded waves-light"> <i class="fas fa-print"></i>
                            </a></h3>
                            <hr>
                            @if ((inv_calculator($invoice)['due']) > 0)
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="form-label">Paid Amount</label>
                                        <input type="text" id="paid_amount" class="form-control form-control-success"
                                            value="{{ $invoice->payments->sum('amount') }}" disabled>
                                        <small class="form-control-feedback"> This amount already paid. </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label">Due Amount</label>
                                        <input type="text" id="lastName" class="form-control form-control-danger"
                                            value="{{ inv_calculator($invoice)['due'] }}"
                                            disabled>
                                        <small class="form-control-feedback"> Rest of due amount. </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">New Payment Amount</label>
                                        <input type="number" id="payment_amount" name="payment_amount"
                                            class="form-control"
                                            placeholder="{{ inv_calculator($invoice)['due'] }}">
                                        @error('payment_amount')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i>
                                    Add Payment</button>
                                <button type="reset" class="btn btn-inverse">Cancel</button>
                            </div>
                        @else
                            <h3 class="card-title text-success">Payment Full Clear</h3>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
