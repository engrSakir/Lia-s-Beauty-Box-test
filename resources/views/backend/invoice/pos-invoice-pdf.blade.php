<html>
<head>
    <style>
    @page{
        size:letter;
    }
   
    html {
        width: 100%;
    height: 70%;

}
    body {
        font-family: sans-serif;
        font-size: 10pt;
       background-color: #ffffff;  
        background-repeat: no-repeat;
        background-position: 50% 50%; 
        background-size:729px 424px;
      
  
    }
    header{

        width:100%;
        height: 154px;
        
        text-align:center;
        margin: 0 auto;
       position:fixed;
    

    }

    footer{

    width:100%;
    height: 84px;
    text-align:center;
    margin: 0 auto;
    padding:0px;
    left: 0px;
    right: 0px;
   
    


}

    p {
        margin: 0pt;
    }

    table.items {
        /*border: 0.1mm solid #e7e7e7;*/
    }

    td {
        vertical-align: top;
    }

    .items td {
        border-left: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    table thead td {
        text-align: center;
        /*border: 0.1mm solid #e7e7e7;*/
    }

    .items td.blanktotal {
        background-color: #EEEEEE;
  
        background-color: #FFFFFF;
       
    }

    .items td.totals {
        text-align: right;
       
    }

    .items td.cost {
        text-align: "."center;
    }
    </style>
    <title>Invoice</title>
</head>

<body>
<header>
</header>
    <table width="100%" style="margin-top:50px;font-family: sans-serif;" cellpadding="10">
    
        <tr>
            <td width="100%" style="text-align: center; padding: 0px;">
           <h2> {{ config('app.name') }}</h2>
            {{ get_static_option('address') ?? 'Example Address' }} <br>
            {{ get_static_option('phone') ?? '01223344556677' }}<br />

            {{ get_static_option('email') ?? 'email@example.com' }}<br />
             <h3>Sales Receipt</h3>
            <h4>Invoice #: {{ $invoice->id }}</h4>
            
            </td>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="60%"><span style="width: 500px;"><strong>Date: {{$invoice->created_at->format('d/m/Y') }}</strong><br>Counter ID:{{$invoice->counter_id }}<br>Customer Name: {{ $invoice->appointment->customer->name ?? '#' }}</span></td>
            <td width="40%"><span style="float:right;"><strong>Time: {{ $invoice->created_at->format('h:i A') }}</strong><br>Served by:{{$invoice->from_phone }}</span>
</td>
        </tr>
    </table>
    <br>
   
    <br>
    <table class="items"  width="100%" style="margin-top:50px;font-size: 14px; float:left; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr style="border:2px solid #000000;">
            <td width="15%" style="text-align: left;"><strong>SL</strong></td>
                <td width="40%" style="text-align: left;"><strong>Service</strong></td>
                <td width="15%" style="text-align: left;"><strong>Price</strong></td>
                <td width="15%" style="text-align: left;"><strong>Quantity</strong></td>

                <td width="15%" style="text-align: left;"><strong>Subtotal</strong></td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            
            <tr>
                <td style="padding: 0px 7px; line-height: 20px;">
                    <br>
                </td>
                <td style="padding: 0px 7px; line-height: 20px;">
                    <br>
                </td>
                <td style="padding: 0px 7px; line-height: 20px;">
                    <br>
                </td>
                <td style="padding: 0px 7px; line-height: 20px;">
                    <br>
                </td>
                <td style="padding: 0px 7px; line-height: 20px;">
                    <br>
                </td>
                
            </tr>
            @foreach ($invoice->items as $item)
          <tr class="item @if($loop->last) last @endif">
          <td scope="row">{{ $loop->iteration }}</td>
              <td>{{ $item->service->name }}</td>
              <td>{{ $item->price }}</td>
              <td>{{ $item->quantity }}</td>
              <td style="text-align:right;">  {{ $item->price }} x {{ $item->quantity }} =   {{ $item->price * $item->quantity }}</td>
          </tr>
          @endforeach
                                    
           
        </tbody>
    </table>
   
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;margin-top:100px;margin-bottom:150px;" >
        <tr>
            <td>
            <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Total</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>VAT</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Fixed Discount</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Grand Total</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"><strong>Paid</strong></td>
                    </tr>
                   
                    
                </table>
                <table width="40%" align="right" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style=" padding: 0px 8px; line-height: 20px;"></td>
                        <td style="text-align:right; padding: 0px 8px; line-height: 20px;">
                        @if(inv_calculator($invoice)['discount_amount'] > 0)
                <del><small>  {{ inv_calculator($invoice)['main_price'] }}</small></del><sup>{{  inv_calculator($invoice)['discount_percentage'] }}%OFF</sup>
                  {{ inv_calculator($invoice)['price_after_discount'] }}
                @else
                  {{ inv_calculator($invoice)['main_price'] }}
                @endif
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"></td>

                        <td style="text-align:right; padding: 0px 8px; line-height: 20px;">
                        {{ inv_calculator($invoice)['vat_amount'] }}
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"></td>

                        <td style="text-align:right; padding: 0px 8px; line-height: 20px;">
                        {{ inv_calculator($invoice)['fixed_discount'] }}
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"></td>

                        <td style="text-align:right; padding: 0px 8px; line-height: 20px;">
                        {{ inv_calculator($invoice)['price'] }}

                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 8px; line-height: 20px;"></td>

                        <td style="text-align:right; padding: 0px 8px; line-height: 20px;">
                        {{ inv_calculator($invoice)['paid'] }}

                        </td>
                       
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
    
    <tr>
            <td width="100%" style="text-align: center; padding: 0px;">
        Developed By <a href="https://www.iciclecorporation.com/" target="_blank">Icicle Corporation</a>
        </td>
        </tr>

        <br>
    </table>
    <footer>

    </footer>
</body>
</html>