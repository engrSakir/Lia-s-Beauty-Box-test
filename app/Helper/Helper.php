<?php

use App\Models\Appointment;
use App\Models\EmployeeSalary;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Schedule;
use App\Models\StaticOption;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


if (!function_exists('random_code')) {
    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function file_uploader($folder_path, $file, $new_file_name = null){
        if ($file && file_exists($file->getRealPath())) {
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            if ($new_file_name){
                $file->move($folder_path, $new_file_name . '.' .$file->getClientOriginalExtension());
                $folder_pathwith_name = $folder_path . $new_file_name . '.' . $file->getClientOriginalExtension();
            }else{
                $file->move($folder_path, $file->getClientOriginalName());
                $folder_pathwith_name = $folder_path . $file->getClientOriginalName();
            }
            return $folder_pathwith_name;
        }
        return false;
    }

    function file_deleter($file){
        try {
            if ($file)
                File::delete(public_path($file));
        }catch (\Exception$exception){

        }
    }

    function total_sale_amount_of_this_day(){
        $total_sale_amount_of_this_day = 0;
        foreach(Invoice::where('created_at', '>=', Carbon::today())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get() as $inv){
            $total_sale_amount_of_this_day += $inv->price();
        }
        return $total_sale_amount_of_this_day;
    }

    function total_sale_amount_of_this_month(){
        $total_sale_amount_of_this_month = 0;
        foreach(Invoice::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get() as $inv){
            $total_sale_amount_of_this_month += $inv->price();
        }
        return $total_sale_amount_of_this_month;
    }

    function total_sale_amount_of_this_year(){
        $total_sale_amount_of_this_year = 0;
        foreach(Invoice::whereYear('created_at', date('Y'))->get() as $inv){
            $total_sale_amount_of_this_year += $inv->price();
        }
        return $total_sale_amount_of_this_year;
    }

    function total_sale_amount_between($start_date,$end_date){
        $total_sale_amount_of_this_between = 0;
        foreach(Invoice::whereBetween('created_at',[$start_date,$end_date])->get() as $inv){
            $total_sale_amount_of_this_between += $inv->price();
        }
        return $total_sale_amount_of_this_between;
    }

    function total_sale_amount(){
        $total_sale_amount = 0;
        foreach(Invoice::all() as $inv){
            $total_sale_amount += $inv->price();
        }
        return $total_sale_amount;
    }

    function total_vat_of_the_day(){
        $total_vat_of_the_day = 0;
        foreach(Invoice::where('created_at', '>=', Carbon::today())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get() as $invoice){
            $total_vat_of_the_day += $invoice->vat();
        }
        return  $total_vat_of_the_day;
    }


    function total_vat_of_the_month(){
        $total_vat_of_the_month = 0;
        foreach(Invoice::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get() as $invoice){
            $total_vat_of_the_month += $invoice->vat();
        }
        return  $total_vat_of_the_month;
    }

    function total_vat_of_the_year(){
        $total_vat_of_the_year = 0;
        foreach(Invoice::whereYear('created_at', date('Y'))->get() as $invoice){
            $total_vat_of_the_year += $invoice->vat();
        }
        return  $total_vat_of_the_year;
    }

    function total_vat(){
        $total_vat = 0;
        foreach(Invoice::all() as $invoice){
            $total_vat += $invoice->vat();
        }
        return  $total_vat;
    }

    function amount_in_hand_of_this_month(){

        $amount_in_hand_of_this_month =
        total_sale_amount_of_this_month()
        + Appointment::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('status', 'Approved')->sum('advance_amount')
        - Expense::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')
        - EmployeeSalary::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');

        return $amount_in_hand_of_this_month;
    }

    function amount_in_hand_of_this_day(){

        $amount_in_hand_of_this_day =
        total_sale_amount_of_this_day()
        + Appointment::where('created_at', '>=', Carbon::today())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('status', 'Approved')->sum('advance_amount')
        - Expense::where('created_at', '>=', Carbon::today())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount')
        - EmployeeSalary::where('created_at', '>=', Carbon::today())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');

        return $amount_in_hand_of_this_day;
    }

    function total_sale_amount_datewise($start_date){
        $total_sale_amount_of_this_date = 0;
        foreach(Invoice::whereDate('created_at','=',$start_date)->get() as $inv){
            $total_sale_amount_of_this_date += $inv->price();
        }
        return $total_sale_amount_of_this_date;
    }


}
