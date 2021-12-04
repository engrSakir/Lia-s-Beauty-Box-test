@extends('layouts.backend.app')

@section('title') Customer @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Customer</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
                <a href="{{ route('backend.user.create', 'role=Customer') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row button-group">
                        <div class="col">
                            <button type="button" disabled
                                class="btn waves-effect waves-light btn-block btn-info counter_display">0</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn waves-effect waves-light btn-block btn-info select-all">All
                                Select</button>
                        </div>
                        <div class="col">
                            <button type="button"
                                class="btn waves-effect waves-light btn-block btn-success un-select-all">All
                                Unselect</button>
                        </div>

                        @foreach ($customer_categories as $customer_category)
                            <div class="col">
                                <button type="button"
                                    class="btn waves-effect waves-light btn-block btn-primary category_change_btn"
                                    value="{{ $customer_category->id }}">{{ $customer_category->name }}</button>
                            </div>
                        @endforeach
                    </div>
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CustomerName</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $app)
                                <tr>
                                    <td>
                                        <label class="btn btn-success">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" value="{{ $app->id }}" name="app"
                                                    class="custom-control-input" id="app-{{ $loop->iteration }}">
                                                <label class="custom-control-label font-weight-bold"
                                                    for="app-{{ $loop->iteration }}">#
                                                    {{ $loop->iteration }}</label>
                                            </div>
                                        </label>
                                    </td>
                                    <td>{{ $app->customer->name }}</td>
                                    <td>{{ $app->customer->email }}</td>
                                    <td>{{ $app->customer->phone }}</td>
                                    <td>{{ $app->customer->address }}</td>
                                    <td>
                                        
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            // Get current page and set current in nav
            $('input[type="checkbox"]').change(function() {
                $('.counter_display').html($("[name='app']:checked").length)
            });
            $('.select-all').click(function(event) {
                $('.counter_display').html($("[name='app']:checked").length)
            });

            $('.un-select-all').click(function(event) {
                $('.counter_display').html($("[name='app']:checked").length)
            });

            $('.category_change_btn').click(function() {
                category_id = $(this).val();
                var users = []
                $("[name='app']:checked").each(function() {
                    users.push($(this).val())
                });
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Category will be updated of selected app!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('backend.ajax.changeUserCategory') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                users: users,
                                category: category_id
                            },
                            dataType: 'JSON',
                            beforeSend: function() {

                            },
                            complete: function() {

                            },
                            success: function(data) {
                                Swal.fire(
                                    'Hey !',
                                    data.message,
                                    data.type
                                )
                                if(data.type){
                                    location.reload()
                                }
                            },
                            error: function(error) {
                                validation_error(error);
                            },
                        });

                    }
                })

            });
        });
    </script>
@endpush
