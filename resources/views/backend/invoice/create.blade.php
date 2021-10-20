@extends('layouts.backend.app')

@section('title') Invoice Create @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Invoice Create Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Invoice Create Page</li>
                </ol>
                <a href="{{ route('backend.appointment.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create New Appointment</a>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <!--<div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Invice Create</h4>
                </div>-->
                <div class="card-body">
                    <div class="container">
                        {{-- Start Appointment section --}}
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="appointment" id="appointment" class="form-control style-select"
                                            required="" onchange="changeAppointment(this)">
                                            <option value="" selected disabled>Please chose a approved appointment</option>
                                            @foreach ($appointments as $appointment)
                                                <option value="{{ $appointment->id }}">
                                                    {{ $loop->iteration }})
                                                    Name: {{ $appointment->customer->name ?? '#' }}
                                                    {{ date('h:i A', strtotime($appointment->schedule->starting_time)) ?? '#' }}
                                                    to
                                                    {{ date('h:i A', strtotime($appointment->schedule->ending_time)) ?? '#' }}
                                                    of
                                                    {{ $appointment->schedule->schedule_day ?? '#' }}
                                                    ({{ date('d M Y', strtotime($appointment->appointment_data)) ?? '#' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- Start Dynamic Service section --}}
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Service </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price </th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td>
                                                <select name='services[]' class="form-control service"
                                                    onchange="service_selector(this)" required="">
                                                    <option value="" selected disabled>Please chose a service</option>
                                                    @foreach ($serviceCategories as $serviceCategory)
                                                        <optgroup label="{{ $serviceCategory->name }}">
                                                            @foreach ($serviceCategory->services as $service)
                                                                <option value="{{ $service->id }}">
                                                                    {{ $service->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" id="qty0" name='qty[]' placeholder='Enter Qty'
                                                    class="form-control qty" step="0" min="0" value="" /></td>
                                            <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                                                    class="form-control price" step="0.00" min="0" /></td>
                                            <td><input type="number" name='total[]' placeholder='0.00'
                                                    class="form-control total" readonly /></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Dynamic Service section --}}
                        {{-- Start Add And Remove Item section --}}
                        <div class="row clearfix m-1">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button id="add_row" class="btn btn-lg btn-success btn-default pull-left">Add Row</button>
                                <button id='delete_row' class="btn btn-lg btn-danger pull-right btn btn-default">Delete
                                    Row</button>
                            </div>
                        </div>
                        {{-- End Add And Remove Item section --}}
                        {{-- Start Sumation section --}}
                        <div class="row clearfix" style="margin-top:20px;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tab_logic_total">
                                    <tbody>
                                        <tr>
                                            <th class="text-center">Sub Total</th>
                                            <td></td>
                                            <td class="text-center"><input type="number" name='sub_total'
                                                    placeholder='0.00' class="form-control" id="sub_total" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Discount (%)</th>
                                            <td class="text-center">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" id="discount"
                                                        name="discount" placeholder="0">
                                                </div>
                                            </td>
                                            <td class="text-center"><input type="number" name='discount_amount'
                                                    id="discount_amount" placeholder='0.00' class="form-control"
                                                    readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Discount (Fixed)</th>
                                            <td class="text-center">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" id="fixed_discount"
                                                        name="fixed_discount" placeholder="0">
                                                </div>
                                            </td>
                                            <td class="text-center"><input type="number" name='fixed_discount_amount'
                                                    id="fixed_discount_amount" placeholder='0.00' class="form-control"
                                                    readonly />
                                            </td>
                                        </tr>


                                        <tr style="display:none" @if (auth()->user()->hasPermissionTo('Invoice create with vat permission')) @else style="display:none"  @endif>
                                            <th class="text-center">VAT (%)</th>
                                            <td class="text-center">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" id="tax" value="0" placeholder="0">
                                                </div>
                                            </td>
                                            <td class="text-center"><input type="number" name='tax_amount'
                                                    id="tax_amount" placeholder='0.00' class="form-control" readonly />
                                            </td>
                                        </tr>

                                        <tr style="display:none">
                                            <th class="text-center">Grand Total</th>
                                            <td></td>
                                            <td class="text-center"><input type="number" name='total_amount'
                                                    id="total_amount" placeholder='0.00'
                                                    class="form-control bg-success fs-6 fw-bold" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Advance Payment</th>
                                            <td class="text-center"><input type="number" name='advance_payment_amount'
                                                    id="advance_payment_amount" placeholder='0.00' class="form-control"
                                                    readonly />
                                            </td>
                                            <td class="text-center"><input type="number" name='due_after_advance_amount'
                                                    id="due_after_advance_amount" placeholder='Due Amount'
                                                    class="form-control bg-warning fs-6 fw-bold" readonly />
                                            </td>
                                        </tr>
                                        <tr style="display: none">
                                            <th class="text-center">Payment</th>
                                            <td class="text-center"><input type="number" name='new_payment_amount'
                                                    id="new_payment_amount" placeholder='0.00' class="form-control" />
                                            </td>
                                            <td class="text-center"><input type="number" name='due_payment_amount'
                                                    id="due_payment_amount" placeholder='Due Amount'
                                                    class="form-control bg-primary fs-6 fw-bold" readonly />
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Sumation section --}}
                        {{-- End Appointment section --}}
                        {{-- Start Payment Mthod  section --}}
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="payment_method" id="payment_method" class="form-control"
                                            required="">
                                            <option value="" selected disabled>Please choose a Payment Method</option>
                                            @foreach ($paymentmethods as $paymentMethod)
                                                <option value="{{ $paymentMethod->id }}">
                                                    {{ $paymentMethod->name ?? '#' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Payment Mthod section --}}
                        {{-- Start Submit Btn section --}}
                        <div class="row clearfix">
                            <div class="col-md-12 d-flex justify-content-between">
                                <button id="" class="btn btn-lg btn-danger btn-default"
                                    onClick="window.location.reload();">Refresh Page</button>
                                    <button type="button" class="btn btn-lg btn-success waves-effect waves-light pull-right"
                                    id="invoice_save_btn" onclick="invoiceSaveFunction(this)">Save Invoice</button>
                            </div>
                        </div>
                        {{-- End Submit Btn section --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Invoice</h5>
                </div>
                <div class="modal-body" id="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="btn btn-primary mdal_close_a" id="modal_close_btn">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!------ Include the above in your HEAD tag ---------->
    <style>
        .style-select {
            background: linear-gradient(to top, #ffffff 0%, #99ff66 100%);
            margin: 10px;
            width: 100%;
            height: 60px;
            border: 5px solid #99ff66;
            border-radius: 14px;
            font-size: 25px;
            overflow: hidden;
        }

    </style>
@endpush

@push('foot')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
          /*  $('.service').select2({
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });*/

            $('#modal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#modal_close_btn').click(function() {
                $('#modal').modal('hide');
                location.reload();
            });

            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#addr' + i).find($('.qty')).val('1');
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });
            $('#discount').on('keyup change', function() {
                // $('#fixed_discount').prop('disabled',true);
                calc_total();
            });
            $('#fixed_discount').on('keyup change', function() {
                // $('#discount').prop('disabled',true);
                calc_total();
            });
            $('#new_payment_amount').on('keyup change', function() {
                calc_total();
            });
        });

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);
                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });

            $('#sub_total').val(total.toFixed(2));

            discount_sum = total / 100 * $('#discount').val();
            fixed_discount = $('#fixed_discount').val();
            $('#discount_amount').val(discount_sum.toFixed(2));
            $('#fixed_discount_amount').val(fixed_discount);
            $('#total_amount').val((total - discount_sum - fixed_discount).toFixed(2));

            total_after_discount = $('#total_amount').val();
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));

            $('#total_amount').val((parseFloat(tax_sum) + parseFloat(total_after_discount)).toFixed(2));
            $('#due_after_advance_amount').val((parseFloat(tax_sum) + parseFloat(total_after_discount) - $(
                '#advance_payment_amount').val()).toFixed(2));
            $('#due_payment_amount').val((parseFloat(tax_sum) + parseFloat(total_after_discount) - $(
                '#advance_payment_amount').val() - $('#new_payment_amount').val()).toFixed(2));
        }

        function service_selector(objButton) {
            $.ajax({
                type: 'GET',
                url: "/backend/service/" + objButton.value, //show
                success: function(response) {
                    // console.log(response);
                    objButton.parentNode.parentNode.querySelector('.price').value = response.price;
                    // console.log(objButton.parentNode.parentNode.querySelector('.price').value);
                    calc();
                    calc_total();
                }
            });
        }

        function changeAppointment(objButton) {
            console.log(objButton.value);
            $.ajax({
                type: 'GET',
                url: "/backend/appointment/" + objButton.value, //show
                success: function(response) {
                    // console.log(response);
                    $('#addr0').find('.service').val(response.appointment.service_id)
                    $('#addr0').find('.price').val(response.service.price)
                    $('#addr0').find('.qty').val(1)
                    // $('#tax').val(response.vat_percentage)
                    $('#tax').val(0)
                    $('#discount').val(response.discount_percentage)
                    $('#fixed_discount').val(0)
                    $('#advance_payment_amount').val(response.appointment.advance_amount)
                    calc();
                    calc_total();
                }
            });
        }

        function invoiceSaveFunction() {
            var services = document.getElementsByName('services[]');
            // console.log(services.length);
            const service_data_set = [];
            $.each(services, function(index, element) {
                service = element.value;
                quantity = element.parentNode.parentNode.querySelector('.qty').value;
                price = element.parentNode.parentNode.querySelector('.price').value;
                if (service && quantity > 0 && price) {
                    service_data_set.push({
                        'service': service,
                        'quantity': quantity,
                        'price': price,
                    });
                }
            });
            // console.log(service_data_set)
            $.ajax({
                method: "POST",
                url: "{{ route('backend.invoice.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    service_data_set: service_data_set,
                    appointment_id: document.getElementById('appointment').value,
                    payment_method: document.getElementById('payment_method').value,
                    vat_percentage: document.getElementById('tax').value,
                    discount_percentage: document.getElementById('discount').value,
                    fixed_discount: document.getElementById('fixed_discount').value,
                    advance_payment_amount: document.getElementById('advance_payment_amount').value,
                    // new_payment_amount: document.getElementById('new_payment_amount').value,
                    new_payment_amount: document.getElementById('total_amount').value,
                },
                dataType: 'JSON',
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(data) {
                    console.log(data)
                    if (data.type == 'success') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your invoice has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#modal').modal('show');
                        $('#modal-body').html(`<iframe src="` + data.invoice_url +
                            `" width="100%" height="400"></iframe>`);

                        $(".mdal_close_a").attr("href", data.btn_url)
                    } else {
                        Swal.fire({
                            icon: data.type,
                            title: 'Oops...',
                            text: data.message,
                            footer: 'We are sorry for unable.'
                        })
                    }
                },
                error: function(error) {
                    validation_error(error);
                },
            });

        }
    </script>
@endpush
