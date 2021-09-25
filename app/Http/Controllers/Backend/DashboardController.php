<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\EmployeeSalary;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $dashboard_items = [
                [
                    'title' => 'Total User',
                    'count' => User::all()->count(),
                ],
                [
                    'title' => 'Total Services',
                    'count' => Service::all()->count(),
                ],
                [
                    'title' => 'Total Schedule',
                    'count' => Schedule::all()->count(),
                ],
                [
                    'title' => 'Total Appointment',
                    'count' => Appointment::all()->count(),
                ],
                [
                    'title' => 'Total Pending Appointment',
                    'count' => Appointment::where('status', 'Pending')->get()->count(),
                ],
                [
                    'title' => 'Total Approved Appointment',
                    'count' => Appointment::where('status', 'Approved')->get()->count(),
                ],
                [
                    'title' => 'Total Done Appointment',
                    'count' => Appointment::where('status', 'Done')->get()->count(),
                ],
                [
                    'title' => 'Total Reject Appointment',
                    'count' => Appointment::where('status', 'Reject')->get()->count(),
                ],
                [
                    'title' => 'Total Invoice',
                    'count' => Invoice::all()->count(),
                ],
                [
                    'title' => 'Total Amout',
                    'count' => InvoiceItem::sum(DB::raw('quantity * price')),
                ],
                [
                    'title' => 'Total Paid Amout',
                    'count' => Payment::all()->sum('amount'),
                ],
                [
                    'title' => 'Total Due Amout',
                    'count' => InvoiceItem::sum(DB::raw('quantity * price')) - Payment::all()->sum('amount'),
                ],
            ];

            $user_chart = new LaravelChart([
                'chart_title' => 'Users by months',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\User',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
            ]);

            $invoice_chart = new LaravelChart([
                'chart_title' => 'Invoice by months',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Invoice',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
            ]);

            $appointment_chart = new LaravelChart([
                'chart_title' => 'Appointment by months',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Appointment',
                'group_by_field' => 'created_at',
                'group_by_period' => 'month',
                'chart_type' => 'bar',
            ]);
            return view('backend.dashboard.admin-dashboard', compact('dashboard_items', 'user_chart', 'invoice_chart', 'appointment_chart'));
        }else if (auth()->user()->hasRole('Customer')) {
            $dashboard_items = [
                [
                    'title' => 'Appointments',
                    'count' => auth()->user()->appointments()->count(),
                ],
                [
                    'title' => 'Invoices',
                    'count' => auth()->user()->invoices()->count(),
                ],

            ];
            return view('backend.dashboard.customer-dashboard', compact('dashboard_items'));
        }else{
            dd('Role not found');
        }
    }

    public function account(){
        $dashboard_items = [
            [
                'title' => 'Total Profit of this month',
                'count' => Payment::whereMonth('created_at', date('m'))->get()->sum('amount') - Expense::whereMonth('created_at', date('m'))->get()->sum('amount') - EmployeeSalary::whereMonth('created_at', date('m'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Profit of this year',
                'count' => Payment::whereYear('created_at', date('Y'))->get()->sum('amount') - Expense::whereYear('created_at', date('Y'))->get()->sum('amount') - EmployeeSalary::whereYear('created_at', date('Y'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Profit',
                'count' => Payment::sum('amount') - Expense::sum('amount') - EmployeeSalary::sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Income of this month',
                'count' => Payment::whereMonth('created_at', date('m'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Expense of this month',
                'count' => Expense::whereMonth('created_at', date('m'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Salary of this month',
                'count' => EmployeeSalary::whereMonth('created_at', date('m'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Income of this year',
                'count' => Payment::whereYear('created_at', date('Y'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Expense of this year',
                'count' => Expense::whereYear('created_at', date('Y'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Salary of this year',
                'count' => EmployeeSalary::whereYear('created_at', date('Y'))->get()->sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Income',
                'count' => Payment::sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Expense',
                'count' => Expense::sum('amount'),
                'url' => null,
            ],
            [
                'title' => 'Total Salary',
                'count' => EmployeeSalary::sum('amount'),
                'url' => null,
            ],



        ];
        return view('backend.dashboard.account-dashboard', compact('dashboard_items'));
    }
}
