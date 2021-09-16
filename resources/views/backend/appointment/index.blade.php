@extends('layouts.backend.app')

@section('title') Appointment @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Appointment Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Appointment Page</li>
                </ol>
                <a href="{{ route('backend.appointment.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Appointment List</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Phone Number</th>
                                    <th>Service</th>
                                    <th>Date Time</th>
                                    <th>Day And Time</th>
                                    <th>Status</th>
                                    <th>RRequest At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $appointment->customer->name ?? '#' }}</td>
                                        <td>{{ $appointment->customer->phone ?? '#' }}</td>
                                        <td>{{ $appointment->service->name ?? '#' }}</td>
                                        <td>{{ $appointment->appointment_data }}</td>
                                        <td>
                                            {{ date('h:i A', strtotime($appointment->schedule->starting_time)) ?? '#' }} to
                                            {{ date('h:i A', strtotime($appointment->schedule->ending_time)) ?? '#' }} of
                                            {{ $appointment->schedule->schedule_day ?? '#' }}
                                        </td>
                                        <th>
                                            <div class="btn-group mt-3" data-bs-toggle="buttons" role="group">
                                                <label class="btn btn-outline btn-info text-white">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="pending-{{  $appointment->id }}" name="status-{{  $appointment->id }}" value="pending" class="form-check-input">
                                                        <label class="form-check-label" for="pending-{{  $appointment->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> Pending </label>
                                                    </div>
                                                </label>
                                                <label class="btn btn-outline btn-info text-white">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="approved-{{  $appointment->id }}" name="status-{{  $appointment->id }}" value="approved" class="form-check-input">
                                                        <label class="form-check-label" for="approved-{{  $appointment->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> Approved </label>
                                                    </div>
                                                </label>
                                                <label class="btn btn-outline btn-danger active text-white">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="reject-{{  $appointment->id }}" name="status-{{  $appointment->id }}" value="reject" class="form-check-input">
                                                        <label class="form-check-label" for="reject-{{  $appointment->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> Reject </label>
                                                    </div>
                                                </label>
                                                <label class="btn btn-outline btn-success active text-white">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="done-{{  $appointment->id }}" name="status-{{  $appointment->id }}" value="done" class="form-check-input">
                                                        <label class="form-check-label" for="done-{{  $appointment->id }}"> <i class="ti-check text-active" aria-hidden="true"></i> Done </label>
                                                    </div>
                                                </label>
                                            </div>
                                        </th>
                                        <td>{{ $appointment->created_at->format('d/m/Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
