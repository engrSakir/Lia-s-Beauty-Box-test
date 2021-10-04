<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReferralDiscountPercentage;
use Illuminate\Http\Request;

class ReferralDiscountPercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referralDiscountPercentages= ReferralDiscountPercentage::orderBy('id','DESC')->get();
        return view('backend.referral.index', compact('referralDiscountPercentages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'percentage_amount' => 'required|numeric|min:0|max:100'
        ]);
        $referralDiscountPercentage = new ReferralDiscountPercentage();
        $referralDiscountPercentage->amount = $request->percentage_amount;
        $referralDiscountPercentage->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReferralDiscountPercentage  $referralDiscountPercentage
     * @return \Illuminate\Http\Response
     */
    public function show(ReferralDiscountPercentage $referralDiscountPercentage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReferralDiscountPercentage  $referralDiscountPercentage
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferralDiscountPercentage $referralDiscountPercentage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReferralDiscountPercentage  $referralDiscountPercentage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReferralDiscountPercentage $referralDiscountPercentage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReferralDiscountPercentage  $referralDiscountPercentage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferralDiscountPercentage $referralDiscountPercentage)
    {
        $referralDiscountPercentage->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
