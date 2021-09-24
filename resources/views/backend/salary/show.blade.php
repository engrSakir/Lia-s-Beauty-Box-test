@extends('layouts.backend.app')

@section('title') Salary Details @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Salary</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.employeeSalary.index') }}">Salary</a></li>
                    <li class="breadcrumb-item active">Salary Details</li>
                </ol>
                <a href="{{ route('backend.employeeSalary.edit', $employeeSalary) }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Edit Now</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-header bg-success">
                    <h4 class="m-b-0 text-white">Details</h4></div>
                <div class="card-body">
                    <h3 class="card-title">{{ $employeeSalary->employee->name }}</h3>
                    <p class="card-text">{!! $employeeSalary->comment !!}</p>
                    <dl>                        
                        <dt>Salary Amount</dt>
                        <dd>{{ $employeeSalary->amount }} Taka</dd>
                        <dt>Salary Date</dt>
                        <dd>{{ date('d/m/Y', strtotime($employeeSalary->salary_date)) }} </dd>
                        <dt>Created At</dt>
                        <dd>{{ $employeeSalary->created_at->format('d/m/Y h:i A') }} </dd>
                        <dt>Updated At</dt>
                        <dd>{{ $employeeSalary->updated_at->format('d/m/Y h:i A') }} </dd>
                    </dl>
                    <a href="{{ route('backend.employeeSalary.index') }}" class="btn btn-dark">Go back to list</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
