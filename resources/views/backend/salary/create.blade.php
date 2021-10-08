@extends('layouts.backend.app')

@section('title') Salary Create @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Salary Create Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Salary Create Page</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Create Salary</h4>
                </div>
                <form action="{{ route('backend.employeeSalary.store') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">

                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="amount">Salary <b class="text-danger">*</b></label>
                                        <input type="number" id="amount" name="amount" class="form-control form-control-danger" placeholder="Amount" value="{{ old('amount') }}" required>
                                        @error('amount')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                @if($selected_employee)
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="employee"><b class="text-danger">
                                        Name: {{ $selected_employee->name }} <br> Email:  {{ $selected_employee->email }} <br> Phone: {{ $selected_employee->phone }}
                                        </b></label>
                                        <input type="hidden" id="employee" name="employee" class="form-control form-control-danger" placeholder="Employee" value="{{ $selected_employee->id }}" required>
                                        @error('employee')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Employee <b class="text-danger">*</b></label>
                                    <select name="employee" class="form-select col-12" id="employee" required>
                                    <option value="">--Select Employee--</option>
                                    @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                    </select>
                                    @error('employee')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label for="comment" class="col-4 col-form-label">Comment</label>
                                        <div class="col-10">
                                        <textarea class="form-control" id="comment" name="comment" rows="3"
                                                    placeholder="Salary Description">{{ old('comment') }}</textarea>
                                        @error('comment')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="salary_date">Salary Date <b class="text-danger">*</b></label>
                                        <input type="date" id="salary_date" name="salary_date" class="form-control form-control-danger" value="{{ old('salary_date') }}" required>
                                        @error('salary_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> Save</button>
                                <button type="reset" class="btn btn-danger">Reset form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
