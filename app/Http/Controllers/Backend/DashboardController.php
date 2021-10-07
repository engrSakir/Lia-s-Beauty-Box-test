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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $total_sale_amount_of_this_month = 0;
            foreach(Invoice::whereMonth('created_at', date('m'))->get() as $inv){
                $total_sale_amount_of_this_month += inv_calculator($inv)['price'];
            }
            $dashboard_items = [
                [
                    'title' => 'Total Invoice of '.Carbon::now()->format('F'),
                    'count' => Invoice::whereMonth('created_at', date('m'))->count(),
                ],
                [
                    'title' => 'Total Sale Amount of '.Carbon::now()->format('F'),
                    'count' => $total_sale_amount_of_this_month,
                ],
                [
                    'title' => 'Total Expense of '.Carbon::now()->format('F'),
                    'count' => Expense::whereMonth('created_at', date('m'))->get()->sum('amount'),
                ],
                [
                    'title' => 'Total User of '.Carbon::now()->format('F'),
                    'count' => User::whereMonth('created_at', date('m'))->count(),
                ],
                [
                    'title' => 'Total Appointment of '.Carbon::now()->format('F'),
                    'count' => Appointment::whereMonth('created_at', date('m'))->count(),
                ],
                [
                    'title' => 'Amount in Hand of '.Carbon::now()->format('F'),
                    'count' => Payment::whereMonth('created_at', date('m'))->get()->sum('amount') - Expense::whereMonth('created_at', date('m'))->get()->sum('amount') - EmployeeSalary::whereMonth('created_at', date('m'))->get()->sum('amount'),
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
        }else if (auth()->user()->hasRole('Employee')) {
            $dashboard_items = [
                [
                    'title' => 'Title 1',
                    'count' => 0,
                ],
                [
                    'title' => 'Title 2',
                    'count' => 0,
                ],

            ];
            return view('backend.dashboard.employee-dashboard', compact('dashboard_items'));
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
        if(auth()->user()->hasPermissionTo('Total vat amount visibility permission')){
            $total_vat_of_the_month = 0;
            foreach(Invoice::whereMonth('created_at', date('m'))->get() as $invoice){
                $total_vat_of_the_month += $invoice->items()->sum(DB::raw('quantity * price')) / 100 * $invoice->vat_percentage;
            }
            $total_vat_of_the_year = 0;
            foreach(Invoice::whereYear('created_at', date('Y'))->get() as $invoice){
                $total_vat_of_the_year += $invoice->items()->sum(DB::raw('quantity * price')) / 100 * $invoice->vat_percentage;
            }
            $total_vat = 0;
            foreach(Invoice::all() as $invoice){
                $total_vat += $invoice->items()->sum(DB::raw('quantity * price')) / 100 * $invoice->vat_percentage;
            }
        }

        $dashboard_items = [
            [
                'title' => 'Total VAT of this month',
                'count' => $total_vat_of_the_month ?? 0,
                'url' => null,
            ],
            [
                'title' => 'Total VAT of this year',
                'count' => $total_vat_of_the_year ?? 0,
                'url' => null,
            ],
            [
                'title' => 'Total VAT',
                'count' => $total_vat ?? 0,
                'url' => null,
            ],
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

    public function indexAdmin()
    {
        $admins = User::role('Admin')->get();
        return view('backend.admin.index', compact('admins'));
    }

    public function indexEmployee()
    {
        $employees = User::role('Employee')->get();
        return view('backend.employee.index', compact('employees'));
    }

    public function indexCustomer()
    {
        $customers = User::role('Customer')->get();
        return view('backend.customer.index', compact('customers'));
    }
}
