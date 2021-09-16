@extends('layouts.frontend.app')
@section('content')
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper"
        style="background-image:url({{ asset('assets/frontend/images/banner/product-banner.jpg') }});">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">{{ $service->name }}</h1>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{ route('service') }}"> Service</a></li>
                <li>{{ $service->name }}</li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full p-tb100">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-6 col-xs-100pc">
                    <div class="about-com-pic">
                        <img src="{{ asset($service->image ?? 'uploads/images/no_image.png') }}" alt=""
                            class="img-responsive">
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-6 col-xs-100pc">
                    <div class="section-head text-left">
                        <h3 class="text-uppercase">{{ $service->name }} </h3>
                        <div class="wt-separator-outer">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>
                        </div>
                        <p>{!! $service->description !!}</p>

                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12">
                    <div class="about-types row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-xs-100pc p-tb20 ">
                            <div class="wt-icon-box-wraper left">
                                <div class="icon-md text-primary">
                                    <a href="#" class="icon-cell p-t5 center-block"><i class="flaticon-spray-bottle"
                                            aria-hidden="true"></i></a>
                                </div>
                                <div class="icon-content">
                                    <h5 class="wt-tilte text-uppercase m-b0">Book Now</h5>
                                    <form class="cons-contact-form" method="POST" action="{{ route('booking') }}">
                                        @csrf
                                        <div class="row">
                                            @guest
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-user"></i></span>
                                                            <input name="name" type="text" required="" class="form-control"
                                                                placeholder="Neme" value="{{ old('name') }}">
                                                        </div>
                                                        @error('name')
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-phone"></i></span>
                                                            <input name="phone" type="text" required="" class="form-control"
                                                                placeholder="Phone" value="{{ old('phone') }}">
                                                        </div>
                                                        @error('phone')
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-envelope"></i></span>
                                                            <input name="email" type="email" class="form-control" required=""
                                                                placeholder="Email" value="{{ old('email') }}">
                                                        </div>
                                                        @error('email')
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endguest

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-asterisk"></i></span>
                                                        <select name="schedule" class="form-control" required="">
                                                            <option value="" selected disabled>Please chose a schedule
                                                            </option>
                                                            @foreach ($schedule_days as $schedule)
                                                                <optgroup label="{{ $schedule['day_name'] }}">
                                                                    @foreach ($schedule['data'] as $schedule_data)
                                                                        <option value="{{ $schedule_data->id }}" @if(old('schedule') == $schedule_data->id) selected @endif>
                                                                            {{ $schedule_data->title }}
                                                                            ({{ date('h:i A', strtotime($schedule_data->starting_time)) }}
                                                                            to
                                                                            {{ date('h:i A', strtotime($schedule_data->ending_time)) }})
                                                                        </option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('schedule')
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input name="appointment_data" type="date" class="form-control" required="" placeholder="Date" value="{{ old('appointment_data') }}">
                                                    </div>
                                                    @error('appointment_data')
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon v-align-m"><i
                                                                class="fa fa-pencil"></i></span>
                                                        <textarea name="message" rows="4" class="form-control " required=""
                                                            placeholder="Message">{{ old('message') }}</textarea>
                                                    </div>
                                                    @error('message')
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="service" value="{{ $service->id }}">
                                            <div class="col-md-12 text-right">
                                                <button name="submit" type="submit" class="site-button  m-r15" id="">
                                                    Submit <i class="fa fa-angle-double-right"></i></button>
                                                <button name="Resat" type="reset" class="site-button ">Reset
                                                    <i class="fa fa-angle-double-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

@endpush
