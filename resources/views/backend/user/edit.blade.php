@extends('layouts.backend.app')

@section('title') User Edit @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">User Edit Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">User Edit Page</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Update User</h4>
                </div>
                <form action="{{ route('backend.user.update', $user) }}" method="POST"
                    class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="user_name">User Name <b class="text-danger">*</b>
                                        </label>
                                        <input type="text" id="user_name" name="user_name" class="form-control"
                                            placeholder="Your Name" value="{{ $user->name }}" required>
                                        @error('user_name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="user_email">Email <b class="text-danger">*</b></label>
                                        <input type="email" id="user_email" name="user_email"
                                            class="form-control form-control-danger" placeholder="Your Email"
                                            value="{{ $user->email }}" required>
                                        @error('user_email')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="user_phone">Phone <b class="text-danger">*</b></label>
                                        <input type="number" id="user_phone" name="user_phone"
                                            class="form-control form-control-danger" placeholder="Your Mobile Number"
                                            value="{{ $user->phone }}" required>
                                        @error('user_phone')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="col-md-12" for="image">User Image</label>
                                        <div class="col-md-12">
                                            <input type="file" name="image" accept="image/*"
                                                class="form-control image-chose-btn image-importer" id="image">
                                            @error('image')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12" for="user_category">User category</label>
                                        <div class="input-group">
                                            <select name="user_category" id="user_category" class="form-control">
                                                <option value="" selected disabled>Select user category
                                                </option>
                                                @foreach ($userCategories as $userCategory)
                                                    <option value="{{ $userCategory->id }}" @if($userCategory->id == $user->category_id) selected @endif>
                                                        {{ $userCategory->name ?? '#' }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_category')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_pass" class="form-label">Password <b class="text-danger">*</b></label>
                                        <input type="password" name="user_pass" class="form-control" id="user_pass"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password" class="form-label">Confirm Password <b class="text-danger">*</b></label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password"  autocomplete="new-password">
                                    </div>
                                    <span id='message'></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i>
                                    Save</button>
                                <button type="reset" class="btn btn-danger">Reset form</button>
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
