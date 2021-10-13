<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        div {
            margin-bottom: 15px;
            padding: 4px 12px;
        }

        .danger {
            background-color: #ffdddd;
            border-left: 6px solid #f44336;
        }

        .success {
            background-color: #ddffdd;
            border-left: 6px solid #04AA6D;
        }

        .info {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
        }


        .warning {
            background-color: #ffffcc;
            border-left: 6px solid #ffeb3b;
        }

        #center-section {
            width: 100%;
            display: flex;
            justify-content: space-around;
        }
        .primary-bordered-table{
            width: 100%;
        }
        .first{
            border:1px solid #2196F3;
 
        }
        .first th{
            background-color:#E7F3FE;
            color:#000000;
            font-weight:bold;
        }
        .first td{
            border:1px solid #E7F3FE;
        }
        .second{
            border:1px solid #04AA6D;
        }
        .second th{
            background-color:#DDFFDD;
            color:#000000;
            font-weight:bold;
        }
        .second td{
            border:1px solid #DDFFDD;
        }

    </style>
</head>

<body>
    <div  style="width: 100%; text-align: center; " >
            <h2>Report <br> {{ config('app.name') }}</h2>
            <h3>Date: {{ $start->format('d-m-Y') }} to {{ $end->format('d-m-Y') }}</h3>
    </div>

    @foreach ($count_items as $count_item)
        <div class=" @if ($loop->odd) info @else success @endif">
            <p> {{ $count_item['title'] }}: &nbsp; <strong>{{ $count_item['count'] }}</strong></p>
        </div>
    @endforeach
    <hr>
    <h3>Invoice</h3>
    <table class="table color-bordered-table primary-bordered-table first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Paid</th>
                                    @can('Total vat amount visibility permission')
                                    <th>Vat</th>
                                    @endcan
                                    {{-- <th>Due</th> --}}
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->appointment->customer->name ?? '#' }}</td>
                                        <td>
                                            {{ inv_calculator($invoice)['price'] ?? '#' }}
                                        </td>
                                        <td>{{ $invoice->payments->sum('amount') }}</td>
                                        {{-- <td>{{ inv_calculator($invoice)['due'] }}</td> --}}
                                        @can('Total vat amount visibility permission')
                                        <td>
                                            {{ inv_calculator($invoice)['vat_amount'] ?? '#' }}
                                        </td>
                                        @endcan
                                        <td>{{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h3>Expense</h3>
                        <table class="table color-bordered-table primary-bordered-table second">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Category</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->category->name ?? '#' }}</td>
                                    <td>{{ $expense->created_at->format('d/m/Y') }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <h3>Salary</h3>
                    <table class="table color-bordered-table primary-bordered-table first">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Salary Date</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaryes as $salary)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $salary->employee->name  }}</td>
                                    <td>BDT {{ $salary->amount }}</td>
                                    <td>{{ date('d/m/Y', strtotime($salary->salary_date)) }}</td>
                                    <td>{{ $salary->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.employeeSalary.show', $salary) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i> </a>
                                        <a href="{{ route('backend.employeeSalary.edit', $salary) }}" class="btn btn-warning btn-circle"><i class="fa fa-pen"></i> </a>
                                        <button value="{{ route('backend.employeeSalary.destroy', $salary) }}"
                                            class="btn btn-danger btn-circle delete-btn"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

</body>

</html>
