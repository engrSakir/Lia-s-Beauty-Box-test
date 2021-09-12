@extends('layouts.frontend.app')
@section('content')
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper" style="background-image:url(images/banner/product-banner.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">Booking</h1>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li>Product</li>
            </ul>
        </div>
    </div>
    <!-- BREADCRUMB ROW END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full p-t80 p-b50">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <!-- SIDE BAR START -->
                    <div class="col-md-3">

                        <aside  class="side-bar">

                            <!-- 13. SEARCH -->
                            <div class="widget bg-white ">
                                <h4 class="widget-title">Search</h4>
                                <div class="search-bx">
                                    <form role="search" method="post">
                                        <div class="input-group">
                                            <input name="news-letter" type="text" class="form-control" placeholder="Write your text">
                                            <span class="input-group-btn">
                                                            <button type="submit" class="site-button"><i class="fa fa-search"></i></button>
                                                        </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- 2. RECENT POSTS -->
                            <div class="widget bg-white  recent-posts-entry">
                                <h4 class="widget-title">Booking</h4>
                                <div class="section-content">
                                    <div class="wt-tabs tabs-default border">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#web-design-1">Calendar</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="web-design-1" class="tab-pane active ">
                                                <div class="widget-post-bx">
                                                    <div class="calendar-wrapper">{{--Calender show using jQuery--}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 4. OUR GALLERY  -->
                            <div class="widget widget_gallery mfp-gallery">
                                <h4 class="widget-title">Our Gallery</h4>
                                <ul>
                                    <li>
                                        <div class="wt-post-thum">
                                            <a href="images/gallery/pic1.jpg" class="mfp-link" ><img src="images/gallery/thumb/pic1.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic2.jpg" class="mfp-link"><img src="images/gallery/thumb/pic2.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum  ">
                                            <a href="images/gallery/pic3.jpg" class="mfp-link"><img src="images/gallery/thumb/pic3.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic4.jpg" class="mfp-link"><img src="images/gallery/thumb/pic4.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic5.jpg" class="mfp-link"><img src="images/gallery/thumb/pic5.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic6.jpg" class="mfp-link"><img src="images/gallery/thumb/pic6.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum">
                                            <a href="images/gallery/pic7.jpg" class="mfp-link" ><img src="images/gallery/thumb/pic7.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic8.jpg" class="mfp-link"><img src="images/gallery/thumb/pic8.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum  ">
                                            <a href="images/gallery/pic7.jpg" class="mfp-link"><img src="images/gallery/thumb/pic7.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic6.jpg" class="mfp-link"><img src="images/gallery/thumb/pic6.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic5.jpg" class="mfp-link"><img src="images/gallery/thumb/pic5.jpg" alt=""></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="wt-post-thum ">
                                            <a href="images/gallery/pic4.jpg" class="mfp-link"><img src="images/gallery/thumb/pic4.jpg" alt=""></a>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <!-- 7. OUR CLIENT -->
                            <div class="widget">
                                <h4 class="widget-title">Our Client</h4>
                                <div class="owl-carousel widget-client p-t10">

                                    <!-- COLUMNS 1 -->
                                    <div class="item">
                                        <div class="ow-client-logo">
                                            <div class="client-logo wt-img-effect on-color">
                                                <a href="#"><img src="images/client-logo/logo1.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COLUMNS 2 -->
                                    <div class="item">
                                        <div class="ow-client-logo">
                                            <div class="client-logo wt-img-effect on-color">
                                                <a href="#"><img src="images/client-logo/logo2.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COLUMNS 3 -->
                                    <div class="item">
                                        <div class="ow-client-logo">
                                            <div class="client-logo wt-img-effect on-color">
                                                <a href="#"><img src="images/client-logo/logo3.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </aside>

                    </div>
                    <!-- SIDE BAR END -->
                    <div class="col-md-9">
                        <!-- TITLE START -->
                        <div class="p-b10">
                            <h3 class="text-uppercase">Today Schedule</h3>
                            <div class="wt-separator-outer m-b30">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>
                            </div>
                        </div>
                        <!-- TITLE END -->

                        <div class="row" id="schedule">
                            {{--Schedules show using jQuery--}}
                            {{-- date value set by jQuery --}}
                            <input type="hidden" id="appointment_data" name="appointment_data">

                            <!-- COLUMNS 1 -->
                            <div class="col-md-3 col-sm-4 col-xs-6 col-xs-100pc m-b30">
                                <div class="wt-box wt-product-box">
                                    <div class="wt-thum-bx wt-img-overlay1 wt-img-effect zoom">
                                        <img src="images/products/pic-1.jpg" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <a href="javascript:void(0);">
                                                    <i class="fa fa-cart-plus wt-icon-box-xs"></i>
                                                </a>
                                                <a class="mfp-link" href="javascript:void(0);">
                                                    <i class="fa fa-heart wt-icon-box-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-info  text-center">
                                        <div class="p-a10 bg-white">
                                            <h4 class="wt-title">
                                                <a href="javascript:;">One Martines</a>
                                            </h4>
                                            <div class="p-t10">
                                                <button class="site-button  m-r15" type="button">Book Now  <i class="fa fa-angle-double-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ADD BLOCK -->
                        <div class="p-tb30">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="wt-box pro-banner">
                                        <img src="images/add/pic1.jpg" alt="">
                                        <div class="pro-banner-disc p-a20 text-white">
                                            <h2 class="text-uppercase m-a0 m-b10">Best time to buy</h2>
                                            <h4 class="m-a0 m-b10">Our Product</h4>
                                            <h3 class="text-uppercase m-a0 m-b10">UP TO</h3>
                                            <h5 class="text-uppercase m-a0 m-b10">10% Cashback</h5>
                                            <a href="#" class="site-button ">ADD TO CART <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="wt-box pro-banner">
                                        <img src="images/add/pic2.jpg" alt="">
                                        <div class="pro-banner-disc p-a20 text-white">
                                            <h2 class="text-uppercase m-a0 m-b10">Best time to buy</h2>
                                            <h4 class="m-a0 m-b10">Our Product</h4>
                                            <h3 class="text-uppercase m-a0 m-b10">UP TO</h3>
                                            <h5 class="text-uppercase m-a0 m-b10">10% Cashback</h5>
                                            <a href="#" class="site-button ">ADD TO CART <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ADD BLOCK -->

                        <!-- TITLE START -->
                        <div class="p-b10">
                            <h3 class="text-uppercase">Featured products</h3>
                            <div class="wt-separator-outer  m-b30">
                                <div class="wt-separator style-icon">
                                    <i class="fa fa-leaf text-black"></i>
                                    <span class="separator-left bg-primary"></span>
                                    <span class="separator-right bg-primary"></span>
                                </div>
                            </div>
                        </div>
                        <!-- TITLE END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION CONTENT END -->
@endsection

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/frontend/calender/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/calender/theme.css') }}">
    <style>
        .schedule-box:hover {
            cursor: pointer;
            border: 4px solid #06ec5c;
            padding: 10px;
            border-radius: 25px;
        }
    </style>
@endpush

@push('foot')
    <script src="{{ asset('assets/frontend/calender/calendar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script type="text/javascript">
        function selectDate(date) {
            $('.calendar-wrapper').updateCalendarOptions({
                date: date
            });

            // console.log(moment(new Date(date)).format("DD-MM-YYYY"));
            $('#appointment_data').val(moment(new Date(date)).format("DD-MM-YYYY"));

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: "{{ route('booking') }}",
                data: { appointment_data:  moment(new Date(date)).format("DD-MM-YYYY")},
                success: function (response) {
                    console.log(response);
                    $('#schedule').html('')
                    $.each(response.schedules, function(schedule_index, schedule) {
                        var schedule_counter = 0;
                        // $.each(response.appointments, function(appointment_index, appointment) {
                        //     if(appointment.schedule_id == schedule.id){
                        //         schedule_counter ++;
                        //     }
                        // });
                        //if (schedule.quantity > schedule_counter){
                            //console.log(schedule)
                            var html = `<div class="col-md-3 col-sm-4 col-xs-6 col-xs-100pc m-b30">
                                <div class="wt-box wt-product-box">
                                    <div class="wt-thum-bx wt-img-overlay1 wt-img-effect zoom">
                                        <img src="images/products/pic-1.jpg" alt="">
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <a href="javascript:void(0);">
                                                    <i class="fa fa-cart-plus wt-icon-box-xs"></i>
                                                </a>
                                                <a class="mfp-link" href="javascript:void(0);">
                                                    <i class="fa fa-heart wt-icon-box-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-info  text-center">
                                        <div class="p-a10 bg-white">
                                            <h4 class="wt-title">
                                                <a href="javascript:;">`+schedule.title+`</a>
                                            </h4>
                                            <div class="p-t10">
                                                <button class="site-button  m-r15" type="button">Book Now  <i class="fa fa-angle-double-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('#schedule').append(html);
                        //}
                    });

                },
                error: function() {
                    console.log(data);
                }
            });

            {{--$.ajax({--}}
            {{--    method: 'GET',--}}
            {{--    url: "{{ url('/booking') }}",--}}
            {{--    data: { appointment_data:  moment(new Date(date)).format("DD-MM-YYYY")},--}}
            {{--    dataType: 'JSON',--}}
            {{--    success: function (response) {--}}
            {{--        console.log(response)--}}
            {{--        $('#schedule').html('')--}}
            {{--        $.each(response.schedules, function(schedule_index, schedule) {--}}
            {{--            var schedule_counter = 0;--}}
            {{--            $.each(response.appointments, function(appointment_index, appointment) {--}}
            {{--                if(appointment.schedule_id == schedule.id){--}}
            {{--                    schedule_counter ++;--}}
            {{--                }--}}
            {{--            });--}}
            {{--            if (schedule.quantity > schedule_counter){--}}
            {{--                console.log(schedule)--}}
            {{--                var html = ` <div class="col-sm-6">--}}
            {{--                               <label class="card shadow-sm p-3 mb-5 bg-white rounded schedule-box" for="schedule-box-`+schedule.id+`">--}}
            {{--                                <div class="card-body">--}}
            {{--                                    <h5 class="card-title">`+schedule.duration+`</h5>--}}
            {{--                                    <p class="card-text">`+schedule.duration+`</p>--}}
            {{--                                    <p class="card-text text-success"><b>`+schedule.place+`</b></p>--}}
            {{--                                    <div class="form-check">--}}
            {{--                                      <input class="form-check-input" type="radio" name="schedule" id="schedule-box-`+schedule.id+`" value="`+schedule.id+`">--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                              </label>--}}
            {{--                             </div>`;--}}
            {{--                $('#schedule').append(html);--}}
            {{--            }--}}
            {{--        });--}}
            {{--    },--}}
            {{--    error: function (xhr) {--}}
            {{--        var errorMessage = '<div class="card bg-danger">\n' +--}}
            {{--            '                        <div class="card-body text-center p-5">\n' +--}}
            {{--            '                            <span class="text-white">';--}}
            {{--        $.each(xhr.responseJSON.errors, function(key,value) {--}}
            {{--            errorMessage +=(''+value+'<br>');--}}
            {{--        });--}}
            {{--        errorMessage +='</span>\n' +--}}
            {{--            '                        </div>\n' +--}}
            {{--            '                    </div>';--}}
            {{--        Swal.fire({--}}
            {{--            icon: 'error',--}}
            {{--            title: 'Oops...',--}}
            {{--            footer: errorMessage--}}
            {{--        })--}}
            {{--    },--}}
            {{--});--}}
        }

        var defaultConfig = {
            weekDayLength: 1,
            date: new Date(),
            onClickDate: selectDate,
            showYearDropdown: true,
            startOnMonday: true,
        };

        $('.calendar-wrapper').calendar(defaultConfig);

        $('#appointment-form #submit-btn').click(function(){
            $.ajax({
                method: 'PATCH',
                url: "{{ url('requestAppointment', '$doctor') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    name: $("#appointment-form [name='name']").val(),
                    email: $("#appointment-form [name='email']").val(),
                    phone: $("#appointment-form [name='phone']").val(),
                    appointment_data: $("#appointment-form [name='appointment_data']").val(),
                    schedule:  $("#appointment-form [name='schedule']:checked").val(),
                },
                dataType: 'JSON',
                beforeSend: function (){
                    $('#appointment-form #submit-btn').prop("disabled",true);
                },
                complete: function (){
                    $('#appointment-form #submit-btn').prop("disabled",false);
                },
                success: function (data) {
                    if (data.type == 'success'){
                        $('#appointment-form').trigger("reset");
                        Swal.fire({
                            icon: data.type,
                            title: data.message,
                        });
                        setTimeout(function() {
                            //location.reload();
                        }, 800);//
                    }else{
                        Swal.fire({
                            icon: data.type,
                            title: 'Oops...',
                            text: data.message,
                            footer: 'Something went wrong!'
                        });
                    }
                },
                error: function (xhr) {
                    var errorMessage = '<div class="card bg-danger">\n' +
                        '                        <div class="card-body text-center p-5">\n' +
                        '                            <span class="text-white">';
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        errorMessage +=(''+value+'<br>');
                    });
                    errorMessage +='</span>\n' +
                        '                        </div>\n' +
                        '                    </div>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        footer: errorMessage
                    });
                },
            });
        });
    </script>
@endpush
