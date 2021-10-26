@extends('layouts.backend.app')

@section('title') Advance Payment @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Advance Payment Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Advance Payment Page</li>
                </ol>
                <a href="{{ route('backend.appointment.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create New Appointment</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Advance Payment List</h4>
                    <div class="table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Phone Number</th>
                                    <th>Transaction ID</th>
                                    <th>Advance Amount</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->customer->name ?? '#' }}</td>
                                        <td>{{ $appointment->customer->phone ?? '#' }}</td>
                                        <td>{{ $appointment->transaction_id ?? '#' }}</td>
                                        <td>{{ $appointment->advance_amount ?? '#' }}</td>
                                        <td>
                                        <a href="{{ route('backend.advancePayment.show', $appointment) }}"
                                                        target="_blank"
                                                        class="btn btn-primary waves-effect btn-rounded waves-light"> <i
                                                            class="fas fa-print"></i> </a>
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
            $('#wrapper').on('click', '.status_btn', function() {
                // $('.status_btn').click(function() {
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
                                if (response.type == 'success') {
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
