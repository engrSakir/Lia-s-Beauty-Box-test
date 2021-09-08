@extends('layouts.backend.app')

@section('title') Schedule @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Schedule Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Schedule Page</li>
                </ol>
                <a href="{{ route('backend.schedule.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
                    New</a>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Setting</h4>
                </div>
                <form action="{{ route('backend.schedule.store') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Person Info</h4>
                    </div>
                    <hr>
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                        <small class="form-control-feedback"> This field has error. </small>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control form-select">
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                        </select>
                                        <small class="form-control-feedback"> Select your gender </small>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-control form-select" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Membership</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio11" name="customRadio" class="form-check-input">
                                            <label class="form-check-label" for="customRadio11">Free</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio22" name="customRadio" class="form-check-input">
                                            <label class="form-check-label" for="customRadio22">Paid</label>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h4 class="card-title mt-5">Address</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="form-label">Street</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Post Code</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <select class="form-control form-select">
                                            <option>--Select your Country--</option>
                                            <option>India</option>
                                            <option>Sri Lanka</option>
                                            <option>USA</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-dark">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
