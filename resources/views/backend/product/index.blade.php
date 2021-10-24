@extends('layouts.backend.app')

@section('title') Product @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Product</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
               
                    <button type="button" id="product_btn" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#booking_modal">
                    <i class="fa fa-plus-circle"></i> Create New
</button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Image</th>
\                                <th scope="col">Quantity</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><img id="image_display" width="150" src="{{ asset($product->image ?? 'uploads/images/no_image.png') }}" class="image-display" alt="User image"/>
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.product.show', $product) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i> </a>
                                    <a  class="btn btn-warning btn-circle" href="{{ route('backend.product.edit', $product) }}">
                                        <i class="fa fa-pen" ></i>
                                    </a>
                                    <button  class="btn btn-danger btn-circle delete-btn" value="{{ route('backend.product.show', $product) }}">
                                        <i class="fa fa-trash" ></i>
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="booking_modal" aria-hidden="true" aria-labelledby="booking_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  bg-info text-white">
                    <h5 class="modal-title" id="schedule_title">Create Product</h5>
                    <hr>
                    
                </div>
                <div class="modal-body">
                    <div class="m-a30 wt-box border-2">
                     
                        <form class="cons-contact-form" id="product_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="name" type="text" required=""
                                                class="form-control" placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <input type="file" name="image" accept="image/*" class="form-control image-chose-btn image-importer" id="imgInp" required>
                                        @error('image')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="quantity" type="number" class="form-control"
                                                 placeholder="Quantity" required>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-12 text-right">
                                    <button name="submit" type="button"
                                        class="btn waves-effect waves-light btn-outline-success"
                                        id="product_submit_btn">Save <i class="fa fa-angle-double-right"></i></button>
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
    </div>
    
@endsection

@push('head')
<script>
    $(document).ready(function(){
        $('#product_btn').click(function() {
            $('#booking_modal').modal('show');

        });
        $('#product_submit_btn').click(function() {
            var mydata = new FormData($("#product_form")[0]);
            $.ajax({
                method: "POST",
                url: "{{ route('backend.product.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: mydata,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(data) {
                    console.log(data)
                    $('#product_form').trigger("reset");
                    Swal.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    $('#booking_modal').modal('hide');
                },
                error: function(error) {
                    validation_error(error);
                },
            });
        });

});

    </script>
@endpush

@push('foot')

@endpush
