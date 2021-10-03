@extends('layouts.frontend.app')
@push('title') Referral Register @endpush
@section('content')
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper" style="background-image:url(assets/frontend/images/banner/product-banner.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">Referral Register</h1>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li>Referral Register</li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full p-t80 p-b50">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-content bg-gray">
                            <div class="contact Register-home-right p-a30">
                                @if ($invalid_ref_alert)
                                    <div class="alert alert-danger text-center rounded" role="alert">
                                        <h3><b>{{ $invalid_ref_alert }}</b></h3>
                                    </div>
                                @else
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <h5 class="text-uppercase font-26 p-b20 font-weight-400">GET IN TOUCH</h5>
                                    <form class="cons-contact Register-form2" method="post"
                                        action="{{ route('refRegister', $ref_code) }}">
                                        @csrf

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input name="name" type="text" required class="form-control"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input name="email" type="email" class="form-control" required
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                <input name="phone" type="text" class="form-control" required
                                                    placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                <input name="password" type="password" class="form-control" required
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    required placeholder="Password confirmation">
                                            </div>
                                        </div>

                                        <button type="submit" class="site-button skew-icon-btn radius-sm">
                                            <span class="font-weight-700 inline-block text-uppercase p-lr15">Submit</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION CONTENT END -->

@endsection

@push('head')

@endpush

@push('foot')
    <script>
        < script >
            var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
    </script>
@endpush
