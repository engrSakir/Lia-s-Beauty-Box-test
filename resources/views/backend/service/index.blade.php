@extends('layouts.backend.app')

@section('title') Service @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Service</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Service</li>
                </ol>
                <a href="{{ route('backend.service.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->category->name ?? '#' }}</td>
                                    <td>BDT {{ $service->price }}</td>
                                    <td>{{ $service->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.service.show', $service) }}" class="btn btn-info btn-circle"><i class="fa fa-eye"></i> </a>
                                        <a href="{{ route('backend.service.edit', $service) }}" class="btn btn-warning btn-circle"><i class="fa fa-pen"></i> </a>
                                        <button value="{{ route('backend.service.destroy', $service) }}"
                                            class="btn btn-danger btn-circle delete-btn"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
