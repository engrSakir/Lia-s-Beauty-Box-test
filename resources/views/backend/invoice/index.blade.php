@extends('layouts.backend.app')

@section('title') Invoice @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Invoice Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Invoice Page</li>
                </ol>
                <a href="{{ route('backend.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
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
                    <h4 class="card-title">Invoice List</h4>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $invoice->customer->name ?? '#' }}</td>
                                        <td>{{ $invoice->customer->phone ?? '#' }}</td>
                                        <td>{{ $invoice->service->name ?? '#' }}</td>
                                        <td>{{ $invoice->appointment_data }}</td>
                                        <td>
                                            {{ date('h:i A', strtotime($invoice->schedule->starting_time)) ?? '#' }}
                                            to
                                            {{ date('h:i A', strtotime($invoice->schedule->ending_time)) ?? '#' }} of
                                            {{ $invoice->schedule->schedule_day ?? '#' }}
                                        </td>
                                        <th class="status_group">
                                            <input type="hidden" class="appointment_id" value="{{ $invoice->id }}">
                                            <div class="btn-group mt-3" data-bs-toggle="buttons" role="group">
                                                @if ($invoice->status != 'Done')
                                                    <label class="btn btn-outline btn-info text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pending-{{ $invoice->id }}"
                                                                name="status-{{ $invoice->id }}" value="Pending"
                                                                @if ($invoice->status == 'Pending') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="pending-{{ $invoice->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Pending </label>
                                                        </div>
                                                    </label>
                                                    <label class="btn btn-outline btn-info text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="approved-{{ $invoice->id }}"
                                                                name="status-{{ $invoice->id }}" value="Approved"
                                                                @if ($invoice->status == 'Approved') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="approved-{{ $invoice->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Approved </label>
                                                        </div>
                                                    </label>
                                                    <label class="btn btn-outline btn-danger text-white">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="reject-{{ $invoice->id }}"
                                                                name="status-{{ $invoice->id }}" value="Reject"
                                                                @if ($invoice->status == 'Reject') checked disabled @endif
                                                                class="form-check-input status_btn">
                                                            <label class="form-check-label"
                                                                for="reject-{{ $invoice->id }}"> <i
                                                                    class="ti-check text-active" aria-hidden="true"></i>
                                                                Reject </label>
                                                        </div>
                                                    </label>
                                                @else
                                                    Invoice
                                                @endif
                                            </div>
                                        </th>
                                        <td>{{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $invoices->links() }}
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
                            url: "backend/invoice/" + this_btn.closest('tr').find(
                                '.appointment_id').val(),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                status: this_btn.val(),
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
