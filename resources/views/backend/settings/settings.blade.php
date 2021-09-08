@extends('layouts.backend.app')

@section('title') Dashboard @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Settings Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Settings Page</li>
                </ol>
                
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('profile.update') }}" class="form-horizontal form-material" method="POST" enctype="multipart/form-data">
                                     @csrf
                <h4 class="card-title">File Upload</h4>
                                <label for="input-file-now" class="form-label">Your Logo</label>
                                <input type="file" name="image" id="input-file-now" class="dropify" />
                                <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success text-white">Upload</button>
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
