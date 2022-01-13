@extends('layouts.backend.app')

@section('title') Invoice Create @endsection

@section('bread-crumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Invoice Create Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Invoice Create Page</li>
            </ol>
            <a href="{{ route('backend.invoice.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i>Invoice List</a>
        </div>
    </div>
</div>
@endsection

@section('content')
@livewire('widgets.edit-invoice' , ['invoice' => $invoice])
{{--
<hr>
@livewire('widgets.appointment' , ['admin_mode' => true]) --}}
@endsection

@push('head')

@endpush

@push('foot')

@endpush