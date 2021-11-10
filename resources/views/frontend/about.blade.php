@extends('layouts.frontend.app')
@push('title') About @endpush
@section('content')
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper" style="background-image:url(assets/frontend/images/banner/product-banner.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <h1 class="text-white">About</h1>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- BREADCRUMB ROW -->
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li>About</li>
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
                        <h2 class="text-uppercase">About</h2>
                        <div class="wt-separator-outer m-b50">
                            <div class="wt-separator style-icon">
                                <i class="fa fa-leaf text-black"></i>
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>
                        </div>
                        <!-- TABS DEFAULT NAV LEFT -->
                        <p>
                        {!! html_entity_decode(get_static_option('about')) !!}
                       </p>




                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/frontend/calender/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/calender/theme.css') }}">
    <style>
        .schedule-box:hover {
            cursor: pointer;
            border: 2px solid #06ec5c;
            padding: 1px;
            border-radius: 12px;
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
                data: {
                    request_for: 'Schedules by Date',
                    appointment_data: moment(new Date(date)).format("DD-MM-YYYY")
                },
                success: function(response) {
                    // console.log(response);
                    $('#schedule').html('')
                    $.each(response.schedules, function(schedule_index, schedule) {
                        var schedule_counter = 0;
                        var starting_time = moment(Date("1/1/1900 " + schedule.starting_time)).format(
                            'hh:mm:ss a');
                        var ending_time = moment(Date("1/1/1900 " + schedule.ending_time)).format(
                            'hh:mm:ss a');
                        var title = schedule.title;
                        var html = `<div class="widget bg-white recent-posts-entry schedule-box btn waves-effect waves-light btn-outline-primary"
                        onclick="bookingModal(` + schedule.id + `)">
                                    <div class="widget-post-bx">
                                        <div class="widget-post clearfix">
                                            <div class="wt-post-media">
                                                <img src="/assets/frontend/images/booking.png" width="200" height="143" alt="">
                                            </div>
                                            <div class="wt-post-info">
                                                <div class="wt-post-header">
                                                    <h6 class="post-title">` + title + `</h6>
                                                </div>
                                                <div class="wt-post-meta">
                                                    <ul>
                                                        <li class="post-author">` + starting_time + ` to ` +
                            ending_time + `</li>
                                                        <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        $('#schedule').append(html);
                    });
                }
            });
        }

        var defaultConfig = {
            weekDayLength: 1,
            date: new Date(),
            onClickDate: selectDate,
            showYearDropdown: true,
            startOnMonday: true,
        };

        $('.calendar-wrapper').calendar(defaultConfig);

        function bookingModal(schedule_id) {
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: "{{ route('booking') }}",
                data: {
                    request_for: 'Schedule Details',
                    schedule_id: schedule_id,
                },
                success: function(response) {
                    //console.log(response);
                    var starting_time = moment(Date("1/1/1900 " + response.starting_time)).format('hh:mm:ss a');
                    var ending_time = moment(Date("1/1/1900 " + response.ending_time)).format('hh:mm:ss a');
                    $('#schedule_title').text(response.title);
                    $('#schedule_date').text($("#appointment_data").val());
                    $('#schedule_time').text(starting_time + ' To ' + ending_time);
                    $('#schedule_id').val(response.id);
                    $('#booking_modal').modal('show');
                }
            });
        }

        $('#appointment_submit_btn').click(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('booking') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    appointment_data: $("#appointment_data").val(),
                    schedule: $('#schedule_id').val(),
                    name: $("#appointment_form [name='name']").val(),
                    email: $("#appointment_form [name='email']").val(),
                    phone: $("#appointment_form [name='phone']").val(),
                    service: $("#appointment_form [name='service']").val(),
                    message: $("#appointment_form [name='message']").val(),
                },
                dataType: 'JSON',
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(data) {
                    console.log(data)
                    $('#appointment_form').trigger("reset");
                    Swal.fire({
                        icon: data.type,
                        title: data.message,
                    });
                    $('#booking_modal').modal('hide');
                },
                error: function(error) {
                    validation_error(error);
                },
            });
        });
    </script>
@endpush
