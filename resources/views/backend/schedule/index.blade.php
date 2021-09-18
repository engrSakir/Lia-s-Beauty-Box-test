@extends('layouts.backend.app')

@section('title') Schedule @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Schedule Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Schedule Page</li>
                </ol>
                <a href="{{ route('backend.schedule.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @foreach ($schedule_days as $schedule)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header @if ($loop->odd) bg-success @else bg-info @endif">
                        <h4 class="mb-0 text-white "> {{ $loop->iteration }}) Schedule List
                            ({{ $schedule['day_name'] }})</h4>
                    </div>
                    <table class="table color-table primary-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule['data'] as $schedule_data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('h:i A', strtotime($schedule_data->starting_time)) }}</td>
                                    <td>{{ date('h:i A', strtotime($schedule_data->ending_time)) }}</td>
                                    <td>{{ $schedule_data->title }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('head')

@endpush

@push('foot')

@endpush
