<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ url('/') }}">
    <meta charset="utf-8" />
    <title>POS</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
    <!--end::Fonts-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="pos-assets/css/stylec619.css?v=1.0" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <link href="pos-assets/api/pace/pace-theme-flat-top.css" rel="stylesheet" type="text/css" />
    <link href="pos-assets/api/mcustomscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
    <style>
        .productCard {
            padding: 5px;
            margin: 2px;
            text-align: center;
            background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
            border-radius: 15px;
            cursor: pointer;

        }

        .productCard:hover {
            background: linear-gradient(to top, #33ccff 0%, #ff99cc 100%);
        }

        .productContent a {
            color: white;
        }

        .style-select {
            background: linear-gradient(to top, #ffffff 0%, #99ff66 100%);
            margin: 5px;
            width: 100%;
            height: 40px;
            border: 5px solid #99ff66;
            border-radius: 14px;
            font-size: 16px;
            overflow: hidden;
        }

    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed">
    <!-- Paste this code after body tag -->
    {{-- <div class="se-pre-con">
        <div class="pre-loader">
            <img class="img-fluid" src="pos-assets/images/loadergif.gif" alt="loading">
        </div>
    </div> --}}
    <!-- pos header -->

    <header class="pos-header bg-white">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="greeting-text">
                        <h3 class="card-label mb-0 font-weight-bold text-primary">POS
                        </h3>
                        <h3 class="card-label mb-0 ">
                            {{ config('app.name') }}
                        </h3>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-5 col-md-6  clock-main">
                    <div class="clock">
                        <div class="datetime-content">
                            <ul>
                                <li id="hours"></li>
                                <li id="point1">:</li>
                                <li id="min"></li>
                                <li id="point">:</li>
                                <li id="sec"></li>
                            </ul>
                        </div>
                        <div class="datetime-content">
                            <div id="Date" class=""></div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-4 col-lg-3 col-md-12 order-lg-last order-second">
                    <div class="topbar justify-content-end">
                        <div class="dropdown mega-dropdown">
                            <div id="id2" class="topbar-item " data-toggle="dropdown" data-display="static">
                                <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3">
                                    <span class="symbol symbol-35 symbol-light-success">
                                        <span class="symbol-label bg-primary  font-size-h5 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                                fill="#fff" class="bi bi-calculator-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z" />
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="dropdown-menu dropdown-menu-right calu" style="min-width: 248px;">
                                <div class="calculator">
                                    <div class="input" id="input"></div>
                                    <div class="buttons">
                                        <div class="operators">
                                            <div>+</div>
                                            <div>-</div>
                                            <div>&times;</div>
                                            <div>&divide;</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="leftPanel">
                                                <div class="numbers">
                                                    <div>7</div>
                                                    <div>8</div>
                                                    <div>9</div>
                                                </div>
                                                <div class="numbers">
                                                    <div>4</div>
                                                    <div>5</div>
                                                    <div>6</div>
                                                </div>
                                                <div class="numbers">
                                                    <div>1</div>
                                                    <div>2</div>
                                                    <div>3</div>
                                                </div>
                                                <div class="numbers">
                                                    <div>0</div>
                                                    <div>.</div>
                                                    <div id="clear">C</div>
                                                </div>
                                            </div>
                                            <div class="equal" id="result">=</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="topbar-item folder-data">
                            <div class="btn btn-icon  w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3"
                                data-toggle="modal" data-target="#folderpop">
                                <span class="badge badge-pill badge-primary">5</span>
                                <span class="symbol symbol-35  symbol-light-success">
                                    <span class="symbol-label bg-warning font-size-h5 ">
                                        <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#ffff"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z">
                                            </path>
                                        </svg>
                                    </span>
                                </span>
                            </div>

                        </div>

                        <div class="dropdown">
                            <div class="topbar-item" data-toggle="dropdown" data-display="static">
                                <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0">

                                    <span class="symbol symbol-35 symbol-light-success">
                                        <span class="symbol-label font-size-h5 ">
                                            <svg width="20px" height="20px" viewBox="0 0 16 16"
                                                class="bi bi-person-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="dropdown-menu dropdown-menu-right" style="min-width: 150px;">


                                <a href="#" class="dropdown-item">
                                    <span class="svg-icon svg-icon-xl svg-icon-primary mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-power">
                                            <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                            <line x1="12" y1="2" x2="12" y2="12"></line>
                                        </svg>
                                    </span>
                                    Logout
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="contentPOS">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 order-xl-first order-last">
                    <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between colorfull-select">
                                <div class="selectmain col-12">
                                    <select class="style-select" id="item_category">
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="All">All Category</option>
                                        @foreach ($itemCategories as $itemCategory)
                                            <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="product-items">
                            <div class="row" id="item_area">
                                @foreach ($items as $item)
                                    <div class="col-xl-4 col-lg-2 col-md-3 col-sm-4 col-6 item_card"
                                        id="item_id_{{ $item->id }}">
                                        <input type="hidden" class="item_id" value="{{ $item->id }}">
                                        <input type="hidden" class="item_name" value="{{ $item->name }}">
                                        <input type="hidden" class="item_price" value="{{ $item->price }}">
                                        <div class="productCard">
                                            <div class="productContent">
                                                <a href="javascript:void(0)">
                                                    {{ $item->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-8 col-md-8">

                    <div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <fieldset class="form-group mb-0 d-flex barcodeselection">
                                        <select name="appointment" id="appointment" class="style-select">
                                            <option value="" selected disabled>Please chose a approved appointment
                                            </option>
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
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="table-datapos">
                            <div class="table-responsive" id="printableTable">
                                <table id="orderTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Vat/1</th>
                                            <th>Price/1</th>
                                            <th>Subtotal</th>
                                            <th class=" text-right no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <div class="col-md-12 btn-submit d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger mr-2 confirm-delete" title="Delete">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Suspand/Cancel
                                    </button>
                                    <button type="submit" class="btn btn-secondary white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
                                            <path
                                                d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z" />
                                        </svg>
                                        Draft Order
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body">
                            <div class="shop-profile">
                                <div class="media">
                                    <div
                                        class="bg-primary w-100px h-100px d-flex justify-content-center align-items-center">
                                        <h2 class="mb-0 white">K</h2>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h3 class="title font-weight-bold">The Kundol Shop</h3>
                                        <p class="phoonenumber">
                                            02199+(070)234-4569
                                        </p>
                                        <p class="adddress">
                                            Russel st 50,Bostron,MA
                                        </p>
                                        <p class="countryname">USA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="resulttable-pos">
                                <table class="table right-table" id="counter_table">

                                    <tbody>
                                        <tr class="d-flex align-items-center justify-content-between">
                                            <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                Total Price
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-dark font-size-base"
                                                id="total_price">00</td>
                                        </tr>
                                        <tr class="d-flex align-items-center justify-content-between">
                                            <th class="border-0 ">
                                                <div
                                                    class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
                                                    Dis. % &nbsp;
                                                </div>
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-dark font-size-base"
                                                id="">
                                                <input type="number" value="0"
                                                    class="form-control border-dark w-100px discount discount_percentage"
                                                    id="discount_percentage" title="Discount percentage" placeholder="">

                                            </td>
                                        </tr>
                                        <tr class="d-flex align-items-center justify-content-between">
                                            <th class="border-0 ">
                                                <div
                                                    class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
                                                    Dis. fixed &nbsp;
                                                </div>
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-dark font-size-base"
                                                id="">
                                                <input type="number" value="0"
                                                    class="form-control border-dark w-100px discount discount_fixed_amount"
                                                    id="discount_fixed_amount" title="Discount fixed amount"
                                                    placeholder="">
                                            </td>
                                        </tr>
                                        <tr class="d-flex align-items-center justify-content-between">
                                            <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                Price after discount
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-dark font-size-base"
                                                id="price_after_discount">00
                                            </td>
                                        </tr>
                                        <tr class="d-flex align-items-center justify-content-between">
                                            <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                Total Vat
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-dark font-size-base"
                                                id="total_vat">00</td>
                                        </tr>
                                        <tr class="d-flex align-items-center justify-content-between item-price">
                                            <th class="border-0 font-size-h5 mb-0 font-size-bold text-primary">
                                                TOTAL INCLUDE VAT
                                            </th>
                                            <td class="border-0 justify-content-end d-flex text-primary font-size-base"
                                                id="total_price_include_vat">00</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end align-items-center flex-column buttons-cash">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-primary white mb-2" id="save_invoice">
                                        <i class="fas fa-money-bill-wave mr-2"></i>
                                        SAVE INVOICE
                                    </a>

                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-secondary ">
                                        <i class="fas fa-credit-card mr-2"></i>
                                        Pay With Card
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade text-left" id="choosecustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel13">Add Customer</h3>
                    <button type="button"
                        class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0"
                        data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Customer Group</label>
                                <fieldset class="form-group mb-3">
                                    <select
                                        class="js-example-basic-single js-states form-control bg-transparent p-0 border-0"
                                        name="state">
                                        <option value="AL">General</option>

                                        <option value="WY">Partial</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Customer Name</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control"
                                        placeholder="Enter Customer Name">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Company Name</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control"
                                        placeholder="Enter Company Name">
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Tax Number</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control" placeholder="Enter Tax">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Email</label>
                                <fieldset class="form-group mb-3">
                                    <input type="email" name="text" class="form-control" placeholder="Enter Mail">
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Phone Number</label>
                                <fieldset class="form-group mb-3">
                                    <input type="email" name="text" class="form-control"
                                        placeholder="Enter Phone Number">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Country</label>
                                <fieldset class="form-group mb-3">
                                    <select
                                        class="js-example-basic-single js-states form-control bg-transparent p-0 border-0"
                                        name="state">
                                        <option value="AL">USA</option>

                                        <option value="WY">UK</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">State</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control" placeholder="Enter State">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">City</label>
                                <fieldset class="form-group mb-3">
                                    <select
                                        class="js-example-basic-single js-states form-control bg-transparent p-0 border-0"
                                        name="state">
                                        <option value="AL">Dubai</option>

                                        <option value="WY">Bahreen</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Postal Code</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control"
                                        placeholder="Enter Postal Code">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-6">
                                <label class="text-body">Address</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="text" class="form-control " placeholder="Enter Address">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
                            <div class="col-md-6  text-right">
                                <a href="#" class="btn btn-primary">Add Customer</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel14">Draft Orders</h3>
                    <button type="button"
                        class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0"
                        data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body pos-ordermain">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h3 class="pos-order-title">Order 1</h3>
                                <div class="orderdetail-pos">
                                    <p>
                                        <strong>Customer Name</strong>
                                        Sophia Hale
                                    </p>
                                    <p>
                                        <strong>Address</strong>
                                        9825 Johnsaon Dr.Columbo,MD21044
                                    </p>
                                    <p>
                                        <strong>Payment Status</strong>
                                        Pending
                                    </p>
                                    <p>
                                        <strong>Total Items</strong>
                                        10
                                    </p>
                                    <p>
                                        <strong>Amount to Pay</strong>
                                        $722
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="confirm-delete ml-3" title="Delete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_color_panel" class="offcanvas offcanvas-right kt-color-panel p-5">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
            <h4 class="font-size-h4 font-weight-bold m-0">Theme Config
            </h4>
            <a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary" id="kt_color_panel_close">
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </a>
        </div>
        <hr>
        <div class="offcanvas-content">
            <!-- Theme options starts -->
            <div id="customizer-theme-layout" class="customizer-theme-layout">

                <h5 class="mt-1">Theme Layout</h5>
                <div class="theme-layout">
                    <div class="d-flex justify-content-start">
                        <div class="my-3">
                            <div class="btn-group btn-group-toggle">
                                <label class="btn btn-primary p-2 active">
                                    <input type="radio" name="layoutOptions" value="false" id="radio-light" checked="">
                                    Light
                                </label>
                                <label class="btn btn-primary p-2">
                                    <input type="radio" name="layoutOptions" value="false" id="radio-dark"> Dark
                                </label>

                            </div>

                        </div>

                    </div>
                </div>
                <hr>
                <h5 class="mt-1">RTL Layout</h5>
                <div class="rtl-layout">
                    <div class="d-flex justify-content-start">
                        <div class="my-3 btn-rtl">
                            <div class="toggle">
                                <span class="circle"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="pos-assets/js/plugin.bundle.min.js"></script>
    <script src="pos-assets/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="pos-assets/js/script.bundle.js"></script> --}}
    <script>
        $("#item_category").change(function() {
            var category = this.value;
            // alert(category);
            $('#item_area').html('');
            var new_html = '';
            $.ajax({
                method: "get",
                url: "/backend/ajax/get-items-by-category/" + category,
                success: function(data) {
                    // console.log(data);
                    $.each(data, function(key, value) {
                        console.log(value)
                        new_html +=
                            `<div class="col-xl-4 col-lg-2 col-md-3 col-sm-4 col-6 item_card" id="item_id_` +
                            value.id + `">
                        <input type="hidden" class="item_id" value="` + value.id +
                            `"><input type="hidden" class="item_name" value="` + value.name +
                            `"><input type="hidden" class="item_price" value="` + value.price + `">
                        <div class="productCard"><div class="productContent">
                        <a href="javascript:void(0)">` + value.name + `</a></div></div></div>`;
                    });
                    $('#item_area').html(new_html);
                }
            });
        });

        $('#item_area').on('click', '.item_card', function() {
            var item_id = $(this).find('.item_id').val();
            var item_name = $(this).find('.item_name').val();
            var item_price = ((100 * $(this).find('.item_price').val()) / 115).toFixed(2);
            var item_vat = ($(this).find('.item_price').val() - (100 * $(this).find('.item_price').val()) / 115)
                .toFixed(2);
            // alert(item_name);
            if ($("#selected_item_for_" + item_id).length > 0) {
                // update price with incease quantity
                $("#selected_item_qty_for_" + item_id).val(parseInt($("#selected_item_qty_for_" + item_id).val()) +
                    1);
                inner_calculation();
            } else {
                //jQuery append row in table
                table_tr = `<tr id="selected_item_for_` + item_id + `">
                            <input type="hidden" class="selected_item" name="selected_items[]" value="` + item_id + `">
                            <td id="selected_item_name_for_` + item_id + `">` + item_name +
                    `</td>
                            <td> <input type="number" value="1" class="form-control border-dark w-100px selected_item_qty" id="selected_item_qty_for_` +
                    item_id + `" placeholder=""> </td>
                            <td id="selected_item_vat_for_` + item_id + `" class="selected_item_vat">` +
                    item_vat + `</td>
                            <td id="selected_item_price_for_` + item_id + `" class="selected_item_price">` +
                    item_price + `</td>
                            <td class="selected_item_total_price">000</td>
                            <td>
                            <div class="card-toolbar text-right">
                            <a href="javascript:void(0)" class="item_remover" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            </td>
                            </tr>`;
                $('#orderTable  > tbody').append(table_tr);
                inner_calculation();
            }
        });

        $('#orderTable').on('click', '.item_remover', function() {
            $(this).closest("tr").remove();
            inner_calculation();
        });

        $('#orderTable').on('keyup change', function() {
            inner_calculation();
        });

        $('#counter_table').on('keyup change', function() {
            discount_calculate();
            console.log('%'+$('#discount_percentage').val());
            console.log('F'+$('#discount_fixed_amount').val());
        });

        function inner_calculation() {
            let total_price = 0;
            let total_vat = 0;
            $('#orderTable tbody tr').each(function(i, element) {
                var qty = parseInt($(this).find('.selected_item_qty').val());
                var price = parseFloat($(this).find('.selected_item_price').text());
                var vat = parseFloat($(this).find('.selected_item_vat').text());
                $(this).find('.selected_item_total_price').text((qty * (price + vat)).toFixed(2));
                total_price += qty * price;
                total_vat += qty * vat;
            });
            $('#total_price').text((total_price).toFixed(2));
            $('#total_vat').text((total_vat).toFixed(2));
            discount_calculate();
        }

        function discount_calculate() {
            let price = $('#total_price').text();
            let discount_percentage = $('#discount_percentage').val();
            let discount_fixed_amount = $('#discount_fixed_amount').val();
            discount_amount = ((price / 100) * discount_percentage) + discount_fixed_amount;
            price_after_discount = price - discount_amount;
            $('#price_after_discount').text((price_after_discount).toFixed(2));
            let vat = parseFloat($('#total_vat').text());
            $('#total_price_include_vat').text((price_after_discount + vat).toFixed(2));
        }



        $("#appointment").change(function() {
            let appointment_id = this.value;
            if ($('.item_card').length < 1) {
                alert('Service not found. Please select all category.');
                $('#appointment').prop('selectedIndex', 0);
            } else {
                $.ajax({
                    type: 'GET',
                    url: "/backend/appointment/" + appointment_id, //show
                    success: function(response) {
                        console.log(response);
                        $('#item_id_' + response.appointment.service_id).trigger('click');
                        $('#discount_percentage').val(response.discount_percentage);
                        discount_calculate();
                        // $('#addr0').find('.service').val(response.appointment.service_id)
                        // $('#addr0').find('.price').val(response.service.price)
                        // $('#addr0').find('.qty').val(1)
                        // // $('#tax').val(response.vat_percentage)
                        // $('#tax').val(0)
                        // $('#discount').val(response.discount_percentage)
                        // $('#fixed_discount').val(0)
                        // $('#advance_payment_amount').val(response.appointment.advance_amount)
                        // calc();
                        // calc_total();
                    }
                });
            }
        });

        $('#save_invoice').click(function() {
            var services = document.getElementsByName('services[]');
            const service_data_set = [];
            $('#orderTable tbody tr').each(function(i, element) {
                service_data_set.push({
                    'service': parseInt($(this).find('.selected_item').val()),
                    'quantity': parseInt($(this).find('.selected_item_qty').val()),
                    'price': parseFloat($(this).find('.selected_item_price').text()),
                });
            });
            // console.log(service_data_set)
            if (service_data_set.length > 0) {
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
            } else {
                alert('Select a service.');
            }
        });
    </script>

</body>
<!--end::Body-->

</html>
