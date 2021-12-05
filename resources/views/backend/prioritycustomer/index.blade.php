@extends('layouts.backend.app')

@section('title') Customer @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Customer</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
                <a href="{{ route('backend.user.create', 'role=Customer') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Purchase Time</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>#{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->invoices_count }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')
 
@endpush
