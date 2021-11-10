@extends('layouts.backend.app')

@section('title') User Show @endsection

@section('bread-crumb')
   <!-- ============================================================== -->
   <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <a href="{{ route('backend.user.index') }}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Back to list</a>
        </div>
    </div>
</div>
<!-- ============================================================== -->
@endsection

@section('content')
      <!-- Row -->
      <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <img src="{{ asset($user->image ?? 'uploads/images/no_image.png') }}" class="img-circle" width="150" />
                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        <h6 class="card-subtitle">{{ $user->email }}</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-md-116 col-lg-116">
                                <i class="fas fa-arrow-alt-circle-right"></i> Ref Link ({{ $user->referUsers->count() }}): &nbsp;
                                <a href="javascript:void(0)" class="link">
                                    <font class="font-medium copy-btn"> {{ route('refRegister', $user->referral_code) }}</font>
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{ $user->phone }}</h6> <small class="text-muted p-t-30 db">Address</small>
                    <h6>{{ $user->address }}</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">Home</a> </li>
                    @if($user->hasRole('Admin') || $user->hasRole('Employee'))
                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#salary" role="tab">Salary</a> </li>
                    @endif

                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">
                            <div class="alert alert-success text-center" role="alert">
                                <h1>
                                   <b> {{ $user->roles()->first()->name ?? '*' }}</b>
                                </h1>
                            </div>
                        </div>
                    </div>
                    @if($user->hasRole('Admin') || $user->hasRole('Employee'))
                    <!--second tab-->
                    <div class="tab-pane" id="salary" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xlg-6">
                                <div class="card">
                                    <div class="box bg-success text-center">
                                        <h1 class="font-light text-white">{{ $user->salaries->sum('amount') }}</h1>
                                        <h6 class="text-white">Total Salary</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xlg-6">
                                <div class="card">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white">{{ $user->salaries()->whereMonth('created_at', date('m'))->sum('amount') }}</h1>
                                        <h6 class="text-white">Total Salary of this month({{ date('M') }})</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table color-bordered-table primary-bordered-table">
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
                                    @foreach ($user->salaries as $salary)
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
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
@endsection

@push('head')

@endpush

@push('foot')
<script>
    $(".copy-btn").click(function() {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(this).text()).select();
        document.execCommand("copy");
        $temp.remove();
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Copy',
            showConfirmButton: false,
            timer: 500
        })
    });
    </script>
@endpush
