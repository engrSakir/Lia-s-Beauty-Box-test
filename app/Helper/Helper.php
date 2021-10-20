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
        $main_price = $invoice->items()->sum(DB::raw('quantity * price')); //Price with vat
        $price = $main_price;
        $without_vat_actual_price = (100 * $main_price)/(100 + $invoice->vat_percentage);
        // if($invoice->vat_percentage > 0){
            $vat_percentage = $invoice->vat_percentage;
            $vat_amount     = $main_price -  $without_vat_actual_price;
            $price_after_vat = $main_price;
        // }else{
        //     $vat_percentage = 0;
        //     $vat_amount     = 0;
        //     $price_after_vat = $main_price;
        // }

        // if($invoice->discount_percentage > 0){
            $discount_percentage = $invoice->discount_percentage;
            $discount_amount     = (($without_vat_actual_price / 100) * $invoice->discount_percentage) + $invoice->fixed_discount;
            $price_after_discount= $without_vat_actual_price - $discount_amount ;
        // }else{
        //     $discount_percentage = 0;
        //     $discount_amount = 0;
        //     $price_after_discount = $main_price;
        // }
        $price +=$vat_amount;
        $price -=$discount_amount;
        $price -=$invoice->fixed_discount;

        $paid = $invoice->payments->sum('amount');
        $due = $price - $paid;
        $advance_amount = $invoice->appointment->advance_amount ?? 0;
        // dd('Price:'.$price.' Paid:'.$paid.' Due: '.round($due, 0));
        $data = [
            'vat_percentage'    => round($vat_percentage, 2),
            'vat_amount'        => round($vat_amount, 2),
            'discount_percentage'    => round($discount_percentage, 2),
            'discount_amount'        => round($discount_amount, 2),
            'price' => round($price, 2),
            'main_price' => round($main_price, 2),
            'price_after_discount' => round($price_after_discount, 2),
            'price_after_vat' => round($price_after_vat, 2),
            'paid' => round($paid, 2),
            'due' => round($due, 2),
            'fixed_discount' => round($invoice->fixed_discount, 2),
            'advance' => round($advance_amount, 2),
            'current_paid' => round($paid - $advance_amount, 2),
        ];
        return $data;
    }

/*
Schedule has lot of appointment
*/
}
