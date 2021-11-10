<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
            sheet-size: 70mm 130mm;
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
        Booking Receipt:  {{ $appointment->id }}
    </h2>
</div>
<table style="font-size: 10px;">
    <tr>
        <td>
            Date: {{  $appointment->created_at->format('d.m.y') }}
        </td>
        <td>
            Time: {{  $appointment->created_at->format('h:i:s A') }}
        </td>
    </tr>
    <tr>
        <td>
            Customer ID: {{ $appointment->customer->id ?? '#' }} <br />
            Customer Name: {{ $appointment->customer->name ?? '#' }} <br />
        </td>
    </tr>
</table>
<br>
<div id="invoice-POS">
    <div id="bot">
        <div id="table">
            <table>
                <tr class="">
                    <td class="Rate" style="width: 50%; text-align:left;">
                        <h3>Service</h3>
                    </td>
                    <td class="payment" style="width: 50%; text-align:right;">
                        {{ $appointment->service->name ?? '#' }}
                    </td>
                </tr>
                {{-- <tr class="">
                    <td class="Rate" style="width: 50%; text-align:left;">
                        <h3>Total (+VAT)</h3>
                    </td>
                    <td class="payment" style="width: 50%; text-align:right;">
                        {{ $appointment->service->price ?? '#' }}
                    </td>
                </tr> --}}
                <tr class="">
                    <td class="Rate">
                        <h3>Advance amount</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $appointment->advance_amount ?? '#' }}
                    </td>
                </tr>
                <tr class="">
                    <td class="Rate">
                        <h3>Due amount</h3>
                    </td>
                    <td class="payment" style="text-align:right;">
                        {{ $appointment->service->price - $appointment->advance_amount ?? '#' }}
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
