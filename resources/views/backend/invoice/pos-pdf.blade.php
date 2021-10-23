<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
            sheet-size: 70mm 180mm;
            /* size: auto; */
            /* background-color: azure; */
            vertical-align: top;
            margin-top: 0;
            /* <any of the usual CSS values for margins> */
            margin-left: 1mm;
            /* <any of the usual CSS values for margins> */
            margin-right: 1mm;
            /* <any of the usual CSS values for margins> */
            margin-bottom: 0;
            /* <any of the usual CSS values for margins> */
            margin-header: 0;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0;
            /* <any of the usual CSS values for margins> */
            marks: cross;
            /*crop | cross | none*/

            /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
            /*https://mpdf.github.io/paging/different-page-sizes.html*/
        }

        #invoice-POS {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.5);
            padding: 0;
            margin: 0 auto;
            width: 0;
            background: #fff;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS h1 {
            font-size: 1em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 1em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.7em;
            color: #666;
            line-height: 1em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 0px solid #eee;
        }

        #invoice-POS #top {
            min-height: 0px;
        }

        #invoice-POS #mid {
            min-height: 0px;
        }

        #invoice-POS #bot {
            min-height: 0px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #eee;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #eee;
        }

        #invoice-POS .item {
            width: 2in;
        }

        #invoice-POS .itemtext {
            font-size: 0.5em;
        }

        h3 {
            font-size: 10px;
        }
        h2 {
            font-size: 16px;
        }

    </style>
</head>

</html>
<br>
<div style="width: 100%; text-align:center;">
    <img src="{{ asset(get_static_option('logo') ?? 'assets/frontend/images/logo.png') }}" width="216" height="37" alt=""> <br>
    <p style="font-size: 18px; margin:20px 0px 5px 0px;">
       <b> Lia's Beauty Box</b>
    </p>
    <p style="font-size: 12px; margin:0px 5px 5px 5px;;  text-align: center; text-justify: inter-word;">
        House 116 (Level 11), Road 11, Block E, Banani(same building of coopers and Gelatissimo) 1213 Dhaka, Dhaka Division, Bangladesh
    </p>
    <p style="font-size: 12px; margin:0px 5px 5px 5px;;  text-align: center;">
        Phone: 01534304782
    </p>
    <h2 style="margin-top: 5px;">
        Sales Receipt:  {{ $invoice->id }}
    </h2>
</div>
<table style="font-size: 10px;">
    <tr>
        <td>
            Date: {{  $invoice->created_at->format('d.m.y') }}
        </td>
        <td>
            Time: {{  $invoice->created_at->format('h:i:s A') }}
        </td>
    </tr>
    <tr>
        <td>
            Customer ID: {{ $invoice->appointment->customer->id ?? '#' }} <br />
            Customer Name: {{ $invoice->appointment->customer->name ?? '#' }} <br />
        </td>
    </tr>
</table>
<div id="invoice-POS">
    <div id="bot">
        <div id="table">
            <table style="width: 100%; font-size: 10px;">
                <tr class="tabletitle" style="width: 100%;">
                    <td class="item" style="width: 2%">
                        <h3>SL</h3>
                    </td>
                    <td class="Rate" style="width: 40%; text-align:left;">
                        <h3>Service</h3>
                    </td>
                    <td class="Rate" style="width: 15%; text-align:center;">
                        <h3>Price</h3>
                    </td>
                    <td class="Rate" style="width: 15%; text-align:center;">
                        <h3>VAT</h3>
                    </td>
                    <td class="Rate" style="width: 18%; text-align:center;">
                        <h3>Total</h3>
                    </td>
                    <td class="Rate" style="width: 10%; text-align:right;">
                        <h3>QTY</h3>
                    </td>
                </tr>
                @php $total_vat = 0; $total_price = 0; $total_price_include_vat = 0;  @endphp
                @foreach ($invoice->items as $item)
                @php
                $total_price += $item->price * $item->quantity;
                $total_vat += round( ($invoice->vat_percentage / 100) * $item->price, 2) * $item->quantity;
                $total_price_include_vat += round(($item->price + (($invoice->vat_percentage / 100) * $item->price)) * $item->quantity, 2);
                // $total_dicount_percentage +=
                // $total_dicount
                @endphp
                    <tr class="item @if ($loop->last) last @endif">
                        <td style="text-align:left;">{{$loop->iteration }}</td>
                        <td style="text-align:left;">{{ $item->service->name }}</td>
                        <td style="text-align:center;"> {{ $item->price }} </td>
                        <td style="text-align:center;"> {{ round(($invoice->vat_percentage / 100) * $item->price, 2) }} </td>
                        <td style="text-align:center;"> {{ $item->price + round(($invoice->vat_percentage / 100) * $item->price, 2) }}</td>
                        <td style="text-align:right;">{{ $item->quantity }}</td>
                    </tr>
                @endforeach
                <tr class="item last tabletitle">
                    <td style="text-align:left;"></td>
                    <td style="text-align:left;">Total</td>
                    <td style="text-align:center;"> {{ $total_price }} </td>
                    <td style="text-align:center;"> {{ $total_vat }} </td>
                    <td style="text-align:center;"> {{ $total_price_include_vat }}</td>
                    <td style="text-align:right;"></td>
                </tr>
            </table>
            <table>
                <tr class="">
                    <td class="Rate" style="width: 50%; text-align:left;">
                        <h3>Total price</h3>
                    </td>
                    <td class="payment" style="width: 50%; text-align:right;">
                        {{ $total_price }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3>Discount ({{ $invoice->discount_percentage }}%)</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                       {{  round(($invoice->discount_percentage / 100) * $total_price, 2) }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3> Fixed Discount:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $invoice->fixed_discount }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3> Price after discount:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $total_price - $invoice->fixed_discount - round(($invoice->discount_percentage / 100) * $total_price, 2) }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3> Total vat:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $total_vat }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3> Payble amount:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $total_price + $total_vat - $invoice->fixed_discount - round(($invoice->discount_percentage / 100) * $total_price, 2) }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3>Advance Paid:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $invoice->appointment->advance_amount ?? 0 }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3>Recent pay:</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $total_price - $invoice->fixed_discount - round(($invoice->discount_percentage / 100) * $total_price, 2) + $total_vat - $invoice->appointment->advance_amount ?? 0 }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3> Payment method</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{$invoice->paymentMethod->name ?? '' }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="margin-top: 60px;">
                <tr>
                    <th>
                        Developed By <br> <a href="https://www.iciclecorporation.com/" target="_blank">iciclecorporation.com</a>
                    </th>
                </tr>
            </table>
        </div>
        <!--End Table-->

    </div>
    <!--End InvoiceBot-->
</div>
<!--End Invoice-->
