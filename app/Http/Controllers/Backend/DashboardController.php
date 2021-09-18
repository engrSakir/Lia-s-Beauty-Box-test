<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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

        return view('backend.dashboard.index', compact('dashboard_items', 'user_chart', 'invoice_chart', 'appointment_chart'));
    }
}
