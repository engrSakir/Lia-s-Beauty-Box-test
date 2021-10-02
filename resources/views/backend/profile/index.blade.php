@extends('layouts.backend.app')

@section('title') Profile @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Profile Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Profile Page</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"><img src="{{ asset($user->image ?? 'uploads/images/no_image.png') }}" class="img-circle" width="150"/>
                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        <h6 class="card-subtitle">{{ $user->email }}</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-md-6 col-lg-6">
                                <a href="javascript:void(0)" class="link">
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                    <font class="font-medium">Ref Code: &nbsp; {{ $user->referral_code }}</font>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <a href="javascript:void(0)" class="link">
                                    <i class="icon-people"></i>
                                    <font class="font-medium">Referance: &nbsp; {{ $user->referUsers->count() }}</font>
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted">Phone </small>
                    <h6>{{ $user->phone ?? 'Phone not found' }}</h6>
                    <br>
                    <small class="text-muted p-t-30 db">Role</small>
                    <h6>
                        {{ $user->roles()->first()->name ?? '*' }}
                    </h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Profile</h4>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="card-body">
                            <form action="{{ route('backend.profile') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12" for="name">Full Name <b class="text-danger">*</b></label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" required value="{{ $user->name }}" placeholder="Type your name" class="form-control form-control-line" id="name">
                                        @error('name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-12">Email <b class="text-danger">*</b></label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" required value="{{ $user->email }}" placeholder="Type your email" class="form-control form-control-line" id="email">
                                        @error('email')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="phone">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Type your phone number 11 digit" class="form-control form-control-line" id="phone">
                                        @error('phone')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="image">Profile Image</label>
                                    <div class="col-md-12">
                                        <input type="file" name="image" class="form-control image-chose-btn image-importer" id="image">
                                        <img id="image_display" width="150" src="{{ asset($user->image ?? 'uploads/images/no_image.png') }}" class="image-display" alt="User image"/>
                                        @error('image')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_pass" class="form-label">Password</label>
                                        <input type="password" name="user_pass" class="form-control" id="user_pass"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" autocomplete="new-password">
                                    </div>
                                    <span id='message'></span>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success text-white">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
