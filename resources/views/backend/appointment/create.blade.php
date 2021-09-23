@extends('layouts.backend.app')

@section('title') Appointment Create @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Appointment Create Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Appointment Create Page</li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Calendar</h4>
                </div>
                <div class="calendar-wrapper">{{-- Calender show using jQuery --}}</div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Schedules</h4>
                </div>
                <div class="card-body">
                    <div class="message-box">
                        <div class="message-widget message-scroll" id="schedule">
                            {{-- Schedules show using jQuery --}}
                            <div class="alert alert-success text-center m-3"
                                style="border: 2px solid red; padding: 10px; border-radius: 50px 20px;" role="alert">
                                <h3>Please pick a date from calendar</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="booking_modal" aria-hidden="true" aria-labelledby="booking_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  bg-success text-white">
                    <h5 class="modal-title" id="schedule_title">Title</h5> <hr>
                    <b class="modal-title" id="schedule_date">Date</b> &nbsp; <b class="modal-title"
                        id="schedule_time">Sub Title</b>
                </div>
                <div class="modal-body">
                    <div class="m-a30 wt-box border-2">
                        {{-- date value set by jQuery --}}
                        <input type="hidden" id="appointment_data" name="appointment_data">
                        <input type="hidden" id="schedule_id" name="schedule">
                        <form class="cons-contact-form" id="appointment_form">
                            <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" required="" class="form-control"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="phone" type="text" required="" class="form-control"
                                                    placeholder="Phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control" required=""
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="transaction_id" type="text" class="form-control" required=""
                                                    placeholder="Bkash Transaction ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="advance_amount" type="number" class="form-control" required=""
                                                    placeholder="Advance Amount">
                                            </div>
                                        </div>
                                    </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select name="service" class="form-control" required="">
                                                <option value="" selected disabled>Please chose a service</option>
                                                @foreach ($serviceCategories as $serviceCategory)
                                                    <optgroup label="{{ $serviceCategory->name }}">
                                                        @foreach ($serviceCategory->services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon v-align-m"><i class="fa fa-pencil"></i></span>
                                            <textarea name="message" rows="4" class="form-control " required=""
                                                placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-right">
                                    <button name="submit" type="button" class="btn waves-effect waves-light btn-outline-success"
                                        id="appointment_submit_btn">Submit <i class="fa fa-angle-double-right"></i></button>
                                    <button name="Resat" type="reset" class="btn waves-effect waves-light btn-outline-info">Reset <i
                                            class="fa fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </form>
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
                        var html = `<a href="javascript:void(0)"  onclick="bookingModal(` + schedule.id + `)">
                                <div class="user-img">
                                    <img src="/assets/frontend/images/booking.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>` + title + `</h5>
                                    <span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type
                                        setting industry. Lorem
                                        Ipsum has been.</span>
                                    <span class="time">` + starting_time + ` to ` +
                            ending_time + `</span>
                                </div>
                                </a>`;
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
                    var starting_time = moment(Date("1/1/1900 " + response.schedule.starting_time)).format('hh:mm:ss a');
                    var ending_time = moment(Date("1/1/1900 " + response.schedule.ending_time)).format('hh:mm:ss a');
                    $('#schedule_title').text(response.schedule.title);
                    $('#schedule_date').text($("#appointment_data").val());
                    $('#schedule_time').text(starting_time + ' To ' + ending_time);
                    $('#schedule_id').val(response.schedule.id);
                    $('#booking_modal').modal('show');
                }
            });
        }

        $('#appointment_submit_btn').click(function() {
            $.ajax({
                method: "POST",
                url: "{{ route('backend.appointment.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    appointment_data: $("#appointment_data").val(),
                    schedule: $('#schedule_id').val(),
                    name: $("#appointment_form [name='name']").val(),
                    email: $("#appointment_form [name='email']").val(),
                    phone: $("#appointment_form [name='phone']").val(),
                    transaction_id: $("#appointment_form [name='transaction_id']").val(),
                    advance_amount: $("#appointment_form [name='advance_amount']").val(),
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
