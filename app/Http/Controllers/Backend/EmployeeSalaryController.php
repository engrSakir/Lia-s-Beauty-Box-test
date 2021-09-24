<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salarys = EmployeeSalary::orderBy('id','DESC')->get();
        return view('backend.salary.index', compact('salarys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::role('Employee')->get();
        return view('backend.salary.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount'         => 'required',
            'employee'   => 'required',
            'comment'         => 'nullable',
            'salary_date'   => 'required',

        ]);
        $employeeSalary = new EmployeeSalary();
        $employeeSalary->amount = $request->amount;
        $employeeSalary->employee_id = $request->employee;
        $employeeSalary->comment = $request->comment;
        $employeeSalary->salary_date = $request->salary_date;
        $employeeSalary->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSalary $employeeSalary)
    {
        if(request()->ajax()){
            return $employeeSalary;
        }
        return view('backend.salary.show', compact('employeeSalary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSalary $employeeSalary)
    {
        $employees = User::role('Employee')->get();
        return view('backend.salary.edit', compact('employees','employeeSalary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSalary $employeeSalary)
    {
        $request->validate([
            'amount'         => 'required',
            'employee'   => 'required',
            'comment'         => 'nullable',
            'salary_date'   => 'required',

        ]);
        $employeeSalary->amount = $request->amount;
        $employeeSalary->employee_id = $request->employee;
        $employeeSalary->comment = $request->comment;
        $employeeSalary->salary_date = $request->salary_date;
        $employeeSalary->save();
        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSalary $employeeSalary)
    {
        //
    }
}
