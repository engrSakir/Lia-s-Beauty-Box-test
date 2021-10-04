<?php

use App\Models\Invoice;
use App\Models\Schedule;
use App\Models\StaticOption;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


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

    function inv_calculator(Invoice $invoice){
        $main_price = $invoice->items()->sum(DB::raw('quantity * price'));
        $price = $main_price;
        if($invoice->vat_percentage > 0){
            $vat_percentage = $invoice->vat_percentage;
            $vat_amount     = ($main_price / 100) * $invoice->vat_percentage;
            $price_after_vat = $main_price + ($main_price / 100) * $invoice->vat_percentage;
        }else{
            $vat_percentage = 0;
            $vat_amount     = 0;
            $price_after_vat = $main_price;
        }

        if($invoice->discount_percentage > 0){
            $discount_percentage = $invoice->discount_percentage;
            $discount_amount     = ($main_price / 100) * $invoice->discount_percentage;
            $price_after_discount= $main_price - ($main_price / 100) * $invoice->discount_percentage;
        }else{
            $discount_percentage = 0;
            $discount_amount = 0;
            $price_after_discount = $main_price;
        }
        $price +=$vat_amount;
        $price -=$discount_amount;

        $paid = $invoice->payments->sum('amount');
        $due = $price - $paid;
        // dd('Price:'.$price.' Paid:'.$paid.' Due: '.round($due, 0));
        $data = [
            'vat_percentage'    => round($vat_percentage),
            'vat_amount'        => round($vat_amount),
            'discount_percentage'    => round($discount_percentage),
            'discount_amount'        => round($discount_amount),
            'price' => round($price),
            'main_price' => round($main_price),
            'price_after_discount' => round($price_after_discount),
            'price_after_vat' => round($price_after_vat),
            'paid' => round($paid),
            'due' => round($due),
        ];
        return $data;
    }

/*
Schedule has lot of appointment
*/
}
