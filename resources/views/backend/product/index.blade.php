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
                <a href="{{ route('backend.product.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row el-element-overlay">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ asset('assets/backend/images/users/1.jpg') }}" alt="user">
                    <div class="el-overlay scrl-up">
                        <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg">
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
                    <h4 class="box-title">Genelia Deshmukh</h4>
                    <small>Managing Director</small>
                    <br> </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ asset('assets/backend/images/users/1.jpg') }}" alt="user">
                    <div class="el-overlay scrl-up">
                        <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg">
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
                    <h4 class="box-title">Genelia Deshmukh</h4>
                    <small>Managing Director</small>
                    <br> </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ asset('assets/backend/images/users/1.jpg') }}" alt="user">
                    <div class="el-overlay scrl-up">
                        <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg">
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
                    <h4 class="box-title">Genelia Deshmukh</h4>
                    <small>Managing Director</small>
                    <br> </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{ asset('assets/backend/images/users/1.jpg') }}" alt="user">
                    <div class="el-overlay scrl-up">
                        <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg">
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
                    <h4 class="box-title">Genelia Deshmukh</h4>
                    <small>Managing Director</small>
                    <br> </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('head')
<link href="{{ asset('assets/backend/dist/css/pages/user-card.css') }}" rel="stylesheet">
@endpush

@push('foot')

@endpush
