@extends('layouts.backend.app')

@section('title') Dashboard @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <a href="{{ route('backend.invoice.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> POS </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Column -->
    @foreach ($dashboard_items as $dashboard_item)
    <div class="col-md-6 col-lg-4 col-xlg-2">
       <a href="{{ $dashboard_item['url'] ?? 'javascript:void(0)' }}">
        <div class="card">
            <div class="box @if($loop->odd) bg-info @else bg-success @endif text-center">
                <h1 class="font-light text-white">{{ $dashboard_item['count'] }}</h1>
                <h6 class="text-white">{{ $dashboard_item['title'] }}</h6>
            </div>
        </div>
       </a>
    </div>
    @endforeach
    <!-- Chart -->
    <hr>
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-white text-center">
                <h6>{{ $user_chart->options['chart_title'] }}</h6>
                {!! $user_chart->renderHtml() !!}
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-white text-center">
                <h6>{{ $invoice_chart->options['chart_title'] }}</h6>
                {!! $invoice_chart->renderHtml() !!}
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-white text-center">
                <h6>{{ $appointment_chart->options['chart_title'] }}</h6>
                {!! $appointment_chart->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('head')

@endpush

@push('foot')
{!! $user_chart->renderChartJsLibrary() !!}
{!! $user_chart->renderJs() !!}
{!! $invoice_chart->renderJs() !!}
{!! $appointment_chart->renderJs() !!}
@endpush
