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
<div class="row el-element-overlay">
@foreach($products as $product)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ asset($product->image ?? 'uploads/images/no_image.png') }}" alt="user">
                    <div class="el-overlay scrl-up">
                        <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="{{ asset($product->image ?? 'uploads/images/no_image.png') }}">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn default btn-outline" href="javascript:void(0);">
                                    <i class="icon-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                    <h4 class="box-title">{{ $product->name }}</h4>
                    <small>Quantity: {{ $product->quantity }}</small><br>
                    <small>Created At: {{ $product->created_at->format('d/m/Y') }}</small>
                    <br> 
                    <a  class="btn btn-warning btn-circle" href="{{ route('backend.product.edit', $product) }}">
                                        <i class="fa fa-pen" ></i>
                                    </a>
                                    
                                    <button class="btn btn-danger btn-circle delete-btn" type="button" onclick="deleteProduct({{ $product->id }})"><i class="fas fa-trash"></i></button>
                            <form id="delete-form-{{ $product->id }}" action="{{ route('backend.product.destroy', $product) }}" method="post" style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                    </div>
                    
            </div>
        </div>
    </div>
   @endforeach

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
                                        <input type="file" name="image" accept="image/*" class="form-control image-chose-btn" id="imgInp" required>
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
    $(function () {
      $("#datatable").DataTable();
    });

    function deleteProduct(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          event.preventDefault();
          $('#delete-form-'+id).submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }
  </script>
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
                    $('#product_form').trigger("reset");
                    
                    $(".el-element-overlay").load(" .el-element-overlay");
                },
                success: function(data) {
                    console.log(data)
                   

                },
                error: function(error) {
                    //validation_error(error);

                },
                
            });
        });

});

    </script>

<link href="{{ asset('assets/backend/dist/css/pages/user-card.css') }}" rel="stylesheet">
@endpush

@push('foot')

@endpush
