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
                                    <th>Request At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->customer->name ?? '#' }}</td>
                                        <td>{{ $appointment->customer->phone ?? '#' }}</td>
                                        <td>{{ $appointment->service->name ?? '#' }}</td>
                                        <td>{{ $appointment->appointment_data }}</td>
                                        <td>
                                            {{ date('h:i A', strtotime($appointment->schedule->starting_time)) ?? '#' }}
                                            to
                                            {{ date('h:i A', strtotime($appointment->schedule->ending_time)) ?? '#' }} of
                                            {{ $appointment->schedule->schedule_day ?? '#' }}
                                        </td>
                                        <td class="status_group">
                                            <input type="hidden" class="appointment_id" value="{{ $appointment->id }}">
                                            <div class="btn-group mt-3" data-bs-toggle="buttons" role="group">
                                                @if ($appointment->status != 'Done')
                                                    <label class="btn btn-outline btn-info text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pending-{{ $appointment->id }}"
                                                                name="status-{{ $appointment->id }}" value="Pending"
                                                                @if ($appointment->status == 'Pending') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="pending-{{ $appointment->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Pending </label>
                                                        </div>
                                                    </label>
                                                    <label class="btn btn-outline btn-info text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="approved-{{ $appointment->id }}"
                                                                name="status-{{ $appointment->id }}" value="Approved"
                                                                @if ($appointment->status == 'Approved') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="approved-{{ $appointment->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Approved </label>
                                                        </div>
                                                    </label>
                                                    <label class="btn btn-outline btn-danger text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="reject-{{ $appointment->id }}"
                                                                name="status-{{ $appointment->id }}" value="Reject"
                                                                @if ($appointment->status == 'Reject') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="reject-{{ $appointment->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Reject </label>
                                                        </div>
                                                    </label>
                                                @else
                                                <a href="{{ route('backend.invoice.show', $appointment->invoice) }}" target="_blank"
                                                class="btn btn-primary waves-effect btn-rounded waves-light"> <i
                                                    class="fas fa-print"></i> </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $appointment->created_at->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('backend.appointment.edit', $appointment) }}"
                                                class="btn btn-warning btn-circle"><i class="fa fa-pen"></i> </a>
                                            <button value="{{ route('backend.appointment.destroy', $appointment) }}"
                                                class="btn btn-danger btn-circle delete-btn"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')
    <script>
        $(document).ready(function() {
            $('.status_btn').click(function() {
                this_btn = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Status change to " + this_btn.val(),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "PATCH",
                            url: "backend/appointment/" + this_btn.closest('tr').find(
                                '.appointment_id').val(),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: this_btn.val(),
                                request_for: 'StatusChange',
                            },
                            dataType: 'JSON',
                            beforeSend: function() {

                            },
                            complete: function() {

                            },
                            success: function(response) {
                                console.log(response)
                                Swal.fire({
                                    position: 'top-end',
                                    icon: response.type,
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                if(response.type == 'success'){
                                    location.reload();
                                }
                            },
                            error: function(error) {
                                validation_error(error);
                            },
                        });
                    } else {
                        location.reload();
                    }
                })
            });
        });
    </script>
@endpush
