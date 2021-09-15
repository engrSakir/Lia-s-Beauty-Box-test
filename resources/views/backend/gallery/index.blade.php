@extends('layouts.backend.app')

@section('title') Dashboard @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Gallery</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
                <a href="{{ route('backend.gallery.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
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
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleries as $gallery)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img id="image_display" width="150" src="{{ asset($gallery->image ?? 'uploads/images/no_image.png') }}" class="image-display" alt="User image"/>
                                    </td>
                                    <td>{{ $gallery->category->name ?? '#' }}</td>
                                    <td>{{ $gallery->created_at->format('d/m/Y') }}</td>
                                    <td>
                                    <a  class="text-warning" href="{{ route('backend.gallery.edit', $gallery) }}">
                                        <i class="fa fa-edit" ></i>
                                    </a>
                                    <a  class="text-danger deleteBtn" href="{{ route('backend.gallery.show', $gallery) }}">
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
