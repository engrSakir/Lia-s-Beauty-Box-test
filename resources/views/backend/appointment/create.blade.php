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
                <a href="{{ route('backend.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i>Direct Invoice</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('widgets.appointment')
    <hr>
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
                    <h5 class="modal-title" id="schedule_title">Title</h5>
                    <hr>
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
                                            <input name="name" type="text" required=""
                                                class="form-control customer_information" placeholder="Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="phone" type="text" required=""
                                                class="form-control customer_information" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="email" type="email" class="form-control customer_information"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="address" class="form-control customer_information"
                                                placeholder="Address">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="transaction_id" type="text" class="form-control"
                                                placeholder="Transaction ID">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="advance_amount" type="number" class="form-control"
                                                placeholder="Advance amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-12 text-right">
                                    <button name="submit" type="button"
                                        class="btn waves-effect waves-light btn-outline-success"
                                        id="appointment_submit_btn">Submit <i class="fa fa-angle-double-right"></i></button>
                                    <button name="Resat" type="reset"
                                        class="btn waves-effect waves-light btn-outline-info">Reset <i
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

        .ui-front {
            z-index: 9999999 !important;
        }

    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@push('foot')
    <script src="{{ asset('assets/frontend/calender/calendar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

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
                        var strtime = (new Date("1/1/1900 " + schedule.starting_time).toLocaleString())
                            .split(',');
                        var starting_time = strtime[1];
                        var endtime = (new Date("1/1/1900 " + schedule.ending_time).toLocaleString())
                            .split(',');
                        var ending_time = endtime[1];
                        var title = schedule.title;
                        var html = `<a href="javascript:void(0)"  onclick="bookingModal(` + schedule
                            .id + `)">
                                <div class="user-img">
                                    <img src="/assets/frontend/images/booking.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5>` + title + `</h5>
                                    <span class="mail-desc"></span>
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
                    var strtime = (new Date("1/1/1900 " + response.schedule.starting_time).toLocaleString())
                        .split(',');
                    var starting_time = strtime[1];
                    var endtime = (new Date("1/1/1900 " + response.schedule.ending_time).toLocaleString())
                        .split(',');
                    var ending_time = endtime[1];
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
                    address: $("#appointment_form [name='address']").val(),
                    service: $("#appointment_form [name='service']").val(),
                    transaction_id: $("#appointment_form [name='transaction_id']").val(),
                    advance_amount: $("#appointment_form [name='advance_amount']").val(),

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

        //Auto Search
        $(".customer_information").autocomplete({
            source: function(request, response) {
                // console.log(request.term);
                request_for = this.element.attr('name');
                var query_data = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.ajax.customerInfo') }}",
                    data: {
                        'request_for': request_for,
                        'query_data': query_data
                    },
                    success: function(data) {
                        console.log(data)
                        var array = $.map(data, function(obj) {
                            if (request_for == 'name') {
                                pointed_value = obj.name;
                            }
                            if (request_for == 'email') {
                                pointed_value = obj.email;
                            }
                            if (request_for == 'phone') {
                                pointed_value = obj.phone;
                            }
                            if (request_for == 'address') {
                                pointed_value = obj.address;
                            }
                            return {
                                value: pointed_value, //Fillable in input field
                                label: 'Name:' + obj.name + ' Email:' + obj.email +
                                    ' Phone:' + obj
                                    .phone + 'Address:' + obj
                                    .address, //Show as label of input field
                                name: obj.name,
                                email: obj.email,
                                phone: obj.phone,
                                address: obj.address,
                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    },
                });
            },
            minLength: 1,
            select: function(event, ui) {
                $('[name=name]').val(ui.item.name);
                $('[name=email]').val(ui.item.email);
                $('[name=phone]').val(ui.item.phone);
                $('[name=address]').val(ui.item.address);

            }
        });
    </script>
@endpush
