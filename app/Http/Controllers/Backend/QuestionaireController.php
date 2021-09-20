<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Questionaire;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class QuestionaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionaires = Questionaire::orderBy('id','DESC')->get();
        return view('backend.faq.index', compact('questionaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faq.create');
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
            'question'         => 'required|string',
            'answer'         => 'nullable|string',
            
        ]);
        $faq = new Questionaire();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionaire $questionaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionaire $questionaire)
    {
        return view('backend.faq.edit', compact('questionaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionaire $questionaire)
    {
        $request->validate([
            'question'         => 'required|string',
            'answer'         => 'nullable|string',
            
        ]);
        $questionaire->question = $request->question;
        $questionaire->answer = $request->answer;
        $questionaire->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionaire $questionaire)
    {
        //
    }
}
