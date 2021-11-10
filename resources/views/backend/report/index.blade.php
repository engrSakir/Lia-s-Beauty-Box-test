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
                
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Report</h4>
                </div>
                <form action="{{ route('backend.report.store') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                    <label class="form-label" for="starting_date">Starting Date <b class="text-danger">*</b></label>
                                        <input type="date" id="starting_date" name="starting_date" class="form-control form-control-danger" value="{{ old('starting_date') }}" required>
                                        @error('starting_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="form-label" for="ending_date">Ending Date <b class="text-danger">*</b></label>
                                        <input type="date" id="ending_date" name="ending_date" class="form-control form-control-danger" value="{{ old('ending_date') }}" required>
                                        @error('ending_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                           <!-- <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Services</label>
                                    <select name="service_id" class="form-select col-12" id="service_id">
                                    <option value="">--Select Service--</option>
                                    @foreach($services as $serv)
                                    <option value="{{ $serv->id }}">{{ $serv->name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Expenses</label>
                                    <select name="expense_id" class="form-select col-12" id="expense_id">
                                    <option value="">--Select Expense--</option>
                                    @foreach($expenses as $exp)
                                    <option value="{{ $exp->id }}">{{ $exp->amount }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Customers</label>
                                    <select name="customer_id" class="form-select col-12" id="customer_id">
                                    <option value="">--Select Service--</option>
                                    @foreach($customers as $cus)
                                    <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Employee</label>
                                    <select name="employee_id" class="form-select col-12" id="employee_id">
                                    <option value="">--Select Employee--</option>
                                    @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                </div>



                            </div>-->

                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> View</button>
                            </div>
                            </div>
                        </div>
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
