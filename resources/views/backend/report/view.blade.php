@extends('layouts.backend.app')

@section('title') Report @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Report</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="card-header bg-default" style="margin-bottom:15px;">
                            <h4 class="mb-0">Report of {{ $start->format('d/m/Y') }} -
                                {{ $end->format('d/m/Y') }}</h4>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-success text-center">
                                    <h1 class="font-light text-white">Income</h1>
                                    <h6 class="text-white">{{ $income }}</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-info text-center">
                                    <h1 class="font-light text-white">Expense</h1>
                                    <h6 class="text-white">{{ $expense }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-success text-center">
                                    <h1 class="font-light text-white">User</h1>
                                    <h6 class="text-white">{{ $user }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-info text-center">
                                    <h1 class="font-light text-white">Appointment</h1>
                                    <h6 class="text-white">{{ $appointment }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-success text-center">
                                    <h1 class="font-light text-white">Salary</h1>
                                    <h6 class="text-white">{{ $salary }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xlg-2">
                            <div class="card">
                                <div class="box  bg-info text-center">
                                    <h1 class="font-light text-white">Invoice</h1>
                                    <h6 class="text-white">{{ $invoice }}</h6>
                                </div>
                            </div>
                        </div>





                    </div>




                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
