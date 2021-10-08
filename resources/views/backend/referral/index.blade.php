@extends('layouts.backend.app')

@section('title') Referral Manage @endsection

@section('bread-crumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Referral Manage</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Referral Manage</li>
                </ol>
               <!-- <a href="{{ route('backend.referralDiscountPercentage.create') }}"
                    class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
                    New</a>-->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Discount percentage of referral user</h4>
                </div>
                <form action="{{ route('backend.referralDiscountPercentage.store') }}" method="POST"
                    class="form-horizontal form-material" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="percentage_amount">Percentage Amount <b
                                                class="text-danger">*</b>
                                        </label>
                                        <input type="text" id="percentage_amount" name="percentage_amount"
                                            class="form-control" placeholder="Percentage"
                                            value="{{ old('percentage_amount') }}" required>
                                        @error('percentage_amount')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i>
                                    Update referral discount percentage</button>
                                <button type="reset" class="btn btn-danger">Reset form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Effective From</th>
                                <th scope="col">Last Efective date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referralDiscountPercentages as $referralDiscountPercentage)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $referralDiscountPercentage->amount }}</td>
                                    <td>{{ $referralDiscountPercentage->created_at->format('d/m/Y') }}</td>

                                    <td> @if ($referralDiscountPercentage->next()) {{ $referralDiscountPercentage->next()->created_at->format('d/m/Y') }} @else Running ... @endif</td>

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
