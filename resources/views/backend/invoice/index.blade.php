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
                                    <th>INV</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ '#1010' }}</td>
                                        <td>{{ $invoice->appointment->customer->name ?? '#' }}</td>
                                        <td>
                                            {{ $invoice->items()->sum(\DB::raw('quantity * price')) ?? '#' }}
                                        </td>
                                        <td>{{ 'Paid' }}</td>
                                        <td>{{ 'Due' }}</td>
                                        <td>{{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('backend.invoice.show', $invoice->id) }}" target="_blank" class="btn btn-primary waves-effect btn-rounded waves-light"> <i class="fas fa-print"></i> </button>
                                        </td>
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
