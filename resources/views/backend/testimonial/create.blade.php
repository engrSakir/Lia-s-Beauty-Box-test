@extends('layouts.backend.app')

@section('title') Dashboard @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Testimonial</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Testimonial</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Create Testimonial</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('backend.testimonial.store') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                            <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">User Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="form-label">Designation</label>
                                    <input type="text" id="primary_text" name="primary_text" class="form-control" placeholder="Designation" value="{{ old('primary_text') }}">
                                        @error('primary_text')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror                                    
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="3"
                                                    placeholder="Write Short Message"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                    <label class="col-md-12" for="image">User Image <b class="text-danger">*</b></label>
                                    <div class="col-md-12">
                                        <input type="file" name="image" accept="image/*" class="form-control image-chose-btn image-importer" id="image" required>
                                        @error('image')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

                               

                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> Save</button>
                                <button type="reset" class="btn btn-danger">Reset form</button>
                            </div>
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
