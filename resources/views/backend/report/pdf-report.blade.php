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


</body>

</html>
