<style>
    @page {
    background-color: #ffffff;
    sheet-size: 70mm 120mm;
    /* size: auto; */
    background-color: azure;
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
h3{
    font-size: 10px;
}
</style>

<div style="width: 100%; text-align:center;">
   
</div>
<table>
    <tr>
        <td style="font-size: 10px;">
            {{ config('app.name') }}<br />
            {{ get_static_option('address') ?? 'Example Address' }} <br>
            {{ get_static_option('phone') ?? '01223344556677' }}<br />

            {{ get_static_option('email') ?? 'email@example.com' }}<br />
             <h3>Sales Receipt</h3>
            <h4>Invoice #: {{ $invoice->id }}</h4><br />

            Customer: {{ $invoice->appointment->customer->name ?? '#' }}<br />
        </td>
    </tr>
</table>
<div id="invoice-POS">
    <div id="bot">
      <div id="table">
        <table style="width: 100%;">
          <tr class="tabletitle" style="width: 100%;">
            <td class="item" style="width: 50%">
              <h3>Service</h3>
            </td>
            <td class="Rate" style="width: 50%; text-align:right;">
              <h3>Sub Total</h3>
            </td>
          </tr>
          @foreach ($invoice->items as $item)
          <tr class="item @if($loop->last) last @endif">
              <td>{{ $item->service->name }}</td>
              <td style="text-align:right;">  {{ $item->price }} x {{ $item->quantity }} =   {{ $item->price * $item->quantity }}</td>
          </tr>
          @endforeach
          <tr class="tabletitle">
            <td class="Rate">
              <h3>Total</h3>
            </td>
            <td class="payment" style="text-align:right;">
                @if(inv_calculator($invoice)['discount_amount'] > 0)
                <del><small>  {{ inv_calculator($invoice)['main_price'] }}</small></del><sup>{{  inv_calculator($invoice)['discount_percentage'] }}%OFF</sup>
                  {{ inv_calculator($invoice)['price_after_discount'] }}
                @else
                  {{ inv_calculator($invoice)['main_price'] }}
                @endif
            </td>
          </tr>

          <tr class="tabletitle">
            <td class="Rate">
              <h3>Vat ({{ inv_calculator($invoice)['vat_percentage'] }}%)</h3>
            </td>
            <td class="payment" style="text-align:right;">
                  {{ inv_calculator($invoice)['vat_amount'] }}
            </td>
          </tr>
          <tr class="tabletitle">
            <td class="Rate">
              <h3> Fixed Discount:</h3>
            </td>
            <td class="payment" style="text-align:right;">
                 {{ inv_calculator($invoice)['fixed_discount'] }}
            </td>
          </tr>
          <tr class="tabletitle">
            <td class="Rate">
              <h3> Grand Total:</h3>
            </td>
            <td class="payment" style="text-align:right;">
                 {{ inv_calculator($invoice)['price'] }}
            </td>
          </tr>
          <tr class="tabletitle">
            <td class="Rate">
              <h3> Paid:</h3>
            </td>
            <td class="payment" style="text-align:right;">
                 {{ inv_calculator($invoice)['paid'] }}
            </td>
          </tr>

        </table>
        <table cellpadding="0" cellspacing="0" style="margin-top: 60px;">
            <tr>
                <th>
                    Developed By <a href="https://www.iciclecorporation.com/" target="_blank">Icicle Corporation</a>
                </th>
            </tr>
        </table>
      </div>
      <!--End Table-->

    </div>
    <!--End InvoiceBot-->
  </div>
  <!--End Invoice-->
