<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderBy('id','DESC')->get();
        return view('backend.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('backend.expense.create', compact('expenseCategories'));
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
            'amount'         => 'required|numeric',
            'category_id'   => 'required|exists:expense_categories,id',
            'description'   => 'nullable',

        ]);
        $expense = new Expense();
        $expense->amount = $request->amount;
        $expense->category_id = $request->category_id;
        $expense->description = $request->description;
        $expense->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $expenseCategories = ExpenseCategory::all();
        return view('backend.expense.edit', compact('expense', 'expenseCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'amount'         => 'required|numeric',
            'category_id'   => 'required|exists:expense_categories,id',
            'description'   => 'nullable',

        ]);
        $expense->amount = $request->amount;
        $expense->category_id = $request->category_id;
        $expense->description = $request->description;
        $expense->save();
        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
