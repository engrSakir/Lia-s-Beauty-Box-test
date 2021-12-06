@extends('layouts.backend.app')

@section('title') Daily Report @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Daily Report</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Daily Report</li>
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
    
    <div class="col-md-6 col-lg-12 col-xlg-2" style="text-align:center;">
    <a href="{{ route('backend.dailyreport.show') }}" target="_blank"
    class="btn btn-lg btn-primary waves-effect btn-rounded waves-light"> <i
        class="fas fa-print"></i> </a>

    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Datewise Report</h4>
                </div>

    <form action="{{ route('backend.dailyreport.store') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-success">
                                    <label class="form-label" for="starting_date">Date <b class="text-danger">*</b></label>
                                        <input type="date" id="starting_date" name="starting_date" class="form-control form-control-danger" value="{{ old('starting_date') }}" required>
                                        @error('starting_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                

                           

                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> View</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>

                  
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
