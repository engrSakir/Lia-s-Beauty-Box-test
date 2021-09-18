<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice - {{ config('app.name') }}</title>
        @page {
            header: page-header;
            footer: page-footer;
        }
		<style>
			.invoice-box {
				max-width: 100%;
				margin: auto;
				padding: 30px;
				/* border: 1px solid #eee; */
				/* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ asset(get_static_option('logo') ?? 'assets/frontend/images/logo.png') }}" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									Invoice #: 123<br />
									Created: January 1, 2015<br />
									Due: February 1, 2015
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{ $invoice->appointment->customer->name ?? '#' }}<br />
									{{ $invoice->appointment->customer->email ?? '#' }}<br />
									{{ $invoice->appointment->customer->phone ?? '#' }}
								</td>

								<td>
									{{ config('app.name') }}<br />
									{{ get_static_option('email') ?? 'email@example.com' }}<br />
									{{ get_static_option('address') ?? 'Example Address' }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>
					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>
					<td>A/C: 00-00-00-00</td>
				</tr>

				<tr class="heading">
					<td>Item</td>
					<td>Price</td>
				</tr>
                @foreach ($invoice->items as $item)
                <tr class="item @if($loop->last) last @endif">
                    <td>{{ $item->service->name }}</td>
                    <td>BDT {{ $item->price }} x {{ $item->quantity }} = BDT {{ $invoice->items()->sum(\DB::raw('quantity * price')) ?? '#' }}</td>
                </tr>
                @endforeach


				<tr class="total">
					<td></td>
					<td>Total: XXXX</td>
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
	</body>
</html>
