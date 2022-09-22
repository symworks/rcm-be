<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductTypeRequest;
use App\Http\Requests\UpdateCategoryProductTypeRequest;
use App\Models\CategoryProductType;

class CategoryProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCategoryProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProductTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProductType  $categoryProductType
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductType $categoryProductType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProductType  $categoryProductType
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductType $categoryProductType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductTypeRequest  $request
     * @param  \App\Models\CategoryProductType  $categoryProductType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryProductTypeRequest $request, CategoryProductType $categoryProductType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryProductType  $categoryProductType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProductType $categoryProductType)
    {
        //
    }
}
