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

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Schedules</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        {{-- Start Appointment section --}}
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="appointment" id="appointment" class="form-control" required="">
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
                        {{-- End Appointment section --}}
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
                                                                <option value="{{ $service->id }}">{{ $service->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" name='qty[]' placeholder='Enter Qty'
                                                    class="form-control qty" step="0" min="0" /></td>
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
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button id="add_row" class="btn btn-default pull-left">Add Row</button>
                                <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
                            </div>
                        </div>
                        {{-- End Add And Remove Item section --}}
                        {{-- Start Sumation section --}}
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Sub Total</th>
                                                <td class="text-center"><input type="number" name='sub_total'
                                                        placeholder='0.00' class="form-control" id="sub_total" readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax</th>
                                                <td class="text-center">
                                                    <div class="input-group mb-2 mb-sm-0">
                                                        <input type="number" class="form-control" id="tax"
                                                            placeholder="0">
                                                        <div class="input-group-addon">%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax Amount</th>
                                                <td class="text-center"><input type="number" name='tax_amount'
                                                        id="tax_amount" placeholder='0.00' class="form-control"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td class="text-center"><input type="number" name='total_amount'
                                                        id="total_amount" placeholder='0.00' class="form-control"
                                                        readonly />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End Sumation section --}}
                        {{-- Start Submit Btn section --}}
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-success pull-left" id="invoice_save_btn" onclick="invoiceSaveFunction()">Save Invoice</button>

                                <button id="" class="btn btn-default pull-right" onClick="window.location.reload();">Refresh Page</button>
                            </div>
                        </div>
                        {{-- End Submit Btn section --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
@endpush

@push('foot')
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
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
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }

        function service_selector(objButton) {
            $.ajax({
                type: 'GET',
                url: "/backend/service/" + objButton.value,
                success: function(response) {
                    // console.log(response);
                    objButton.parentNode.parentNode.querySelector('.price').value = response.price;
                    // console.log(objButton.parentNode.parentNode.querySelector('.price').value);
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
                $.ajax({
                    method: "POST",
                    url: "{{ route('backend.invoice.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        service_data_set: service_data_set,
                        vat_percentage: document.getElementById('tax').value,
                        appointment_id: document.getElementById('appointment').value,
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
            });

        }
    </script>
@endpush
