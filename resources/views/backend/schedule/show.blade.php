@extends('layouts.backend.app')

@section('title') Schedule Details @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Schedule</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.schedule.index') }}">Schedule</a></li>
                    <li class="breadcrumb-item active">Schedule Details</li>
                </ol>
                <a href="{{ route('backend.schedule.edit', $schedule) }}" class="btn btn-info d-none d-lg-block m-l-15"><i
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
                    <h3 class="card-title">{{ $schedule->title }}</h3>
                    <dl>
                        <dt>Maximum Participant</dt>
                        <dd>{{ $schedule->maximum_participant }} </dd>
                        <dt>Starting Time</dt>
                        <dd>{{ date('h:i A', strtotime($schedule->starting_time)) }} </dd>
                        <dt>Ending Time</dt>
                        <dd>{{ date('h:i A', strtotime($schedule->ending_time)) }} </dd>
                        <dt>Schedule Day</dt>
                        <dd>{{ $schedule->schedule_day }}</dd>                        
                        <dt>Created At</dt>
                        <dd>{{ $schedule->created_at->format('d/m/Y h:i A') }} </dd>
                        <dt>Updated At</dt>
                        <dd>{{ $schedule->updated_at->format('d/m/Y h:i A') }} </dd>
                    </dl>
                    <a href="{{ route('backend.schedule.index') }}" class="btn btn-dark">Go back to list</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
