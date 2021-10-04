<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCategories = UserCategory::orderBy('id','DESC')->get();
        return view('backend.user_category.index', compact('userCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user_category.create');
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
            'category_name' => 'required|unique:user_categories,name',
            'vat_percentage'    => 'required|numeric|min:0|max:100',
            'discount_percentage'    => 'required|numeric|min:0|max:100',
        ]);
        $userCategory = new UserCategory();
        $userCategory->name = $request->category_name;
        $userCategory->slug = Str::slug($request->category_name, '-');
        $userCategory->vat_percentage = $request->vat_percentage;
        $userCategory->discount_percentage = $request->discount_percentage;
        $userCategory->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function show(UserCategory $userCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCategory $userCategory)
    {
        return view('backend.user_category.edit', compact('userCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCategory $userCategory)
    {
        $request->validate([
            'category_name' => 'required|unique:user_categories,name,'.$userCategory->id,
            'vat_percentage'    => 'required|numeric|min:0|max:100',
            'discount_percentage'    => 'required|numeric|min:0|max:100',
        ]);

        $userCategory->name = $request->category_name;
        $userCategory->slug = Str::slug($request->category_name, '-');
        $userCategory->vat_percentage = $request->vat_percentage;
        $userCategory->discount_percentage = $request->discount_percentage;
        $userCategory->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCategory $userCategory)
    {
        $userCategory->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
