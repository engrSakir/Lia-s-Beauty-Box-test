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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Schedule List</h4>
                </div>
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Saturday</th>
                        <th scope="col">Sunday</th>
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($times as $time)
                        <tr>
                            <th scope="row" height="80px" valign="middle">{{ $time }}</th>
                            @foreach($schedule_days as $schedule)
                                <td>
                                    @foreach($schedule['data'] as $schedule_data)
                                        @if($time == date('h A', strtotime($schedule_data->starting_time)))
                                            {{ $schedule_data->title }} (Start) <br>
                                        @endif
                                        @if($time == date('h A', strtotime($schedule_data->ending_time)))
                                            {{ $schedule_data->title }} (End) <br>
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-lg-12">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header bg-info">--}}
    {{--                    <h4 class="mb-0 text-white">Setting</h4>--}}
    {{--                </div>--}}
    {{--                {!! $calendar->calendar() !!}--}}
    {{--                {!! $calendar->script() !!}--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection

@push('head')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>
@endpush

@push('foot')

@endpush
