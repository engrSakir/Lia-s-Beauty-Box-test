@extends('layouts.backend.app')

@section('title') Appointment Edit @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Appointment Edit Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Appointment Edit Page</li>
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
                    <h4 class="mb-0 text-white">Schedules</h4>
                </div>
                <div class="card-body">
                    <form class="cons-contact-form" id="appointment_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="name" type="text" required="" class="form-control" placeholder="Neme"
                                            value="{{ $appointment->customer->name ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="phone" type="text" required="" class="form-control"
                                            placeholder="Phone" value="{{ $appointment->customer->phone ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="email" type="email" class="form-control" required=""
                                            placeholder="Email" value="{{ $appointment->customer->email ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="transaction_id" type="text" class="form-control" required=""
                                                    placeholder="Bkash Transaction ID" value="{{ $appointment->transaction_id ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="advance_amount" type="number" class="form-control" required=""
                                                    placeholder="Advance Amount" value="{{ $appointment->advance_amount ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="service" class="form-control" required="">
                                            <option value="" selected disabled>Please chose a service</option>
                                            @foreach ($serviceCategories as $serviceCategory)
                                                <optgroup label="{{ $serviceCategory->name }}">
                                                    @foreach ($serviceCategory->services as $service)
                                                        <option value="{{ $service->id }}" @if ($appointment->service_id == $service->id) selected @endif>
                                                            {{ $service->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="service" class="form-control" required="">
                                            <option value="" selected disabled>Please chose a schedule</option>
                                            @foreach ($schedule_days as $schedule)
                                                <optgroup label="{{ $schedule['day_name'] }}">
                                                    @foreach ($schedule['data'] as $schedule_data)
                                                        <option value="{{ $schedule_data->id }}"  @if ($appointment->schedule_id == $schedule_data->id) selected @endif>
                                                            {{ $schedule_data->title }}
                                                            ({{ date('h:i A', strtotime($schedule_data->starting_time)) }}
                                                            to
                                                            {{ date('h:i A', strtotime($schedule_data->ending_time)) }})
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon v-align-m"><i class="fa fa-pencil"></i></span>
                                        <textarea name="message" rows="4" class="form-control " required=""
                                            placeholder="Message">{!! $appointment->message !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button name="submit" type="button" class="btn waves-effect waves-light btn-outline-success"
                                    id="appointment_submit_btn">Submit <i class="fa fa-angle-double-right"></i></button>
                                <button name="Resat" type="reset"
                                    class="btn waves-effect waves-light btn-outline-info">Reset <i
                                        class="fa fa-angle-double-right"></i></button>
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
