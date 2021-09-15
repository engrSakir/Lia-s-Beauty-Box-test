@extends('layouts.backend.app')

@section('title') Dashboard @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Image Category</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Image Category</li>
                </ol>
                <a href="{{ route('backend.imageCategory.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
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
                <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($imageCategories as $imageCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $imageCategory->name }}</td>
                                    <td>{{ $imageCategory->created_at->format('d/m/Y') }}</td>
                                    <td>
                                    <a  class="text-warning" href="{{ route('backend.imageCategory.edit', $imageCategory) }}">
                                        <i class="fa fa-edit" ></i>
                                    </a>
                                    <a  class="text-danger deleteBtn" href="{{ route('backend.imageCategory.show', $imageCategory) }}">
                                        <i class="fa fa-trash" ></i>
                                    </a>
                                    
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
