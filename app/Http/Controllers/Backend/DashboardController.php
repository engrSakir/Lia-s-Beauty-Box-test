<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
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

        return view('backend.dashboard.index', compact('user_chart', 'invoice_chart', 'appointment_chart'));
    }
}
