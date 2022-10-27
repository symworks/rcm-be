<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductTagRequest;
use App\Http\Requests\UpdateCategoryProductTagRequest;
use App\Models\CategoryProductTag;

class CategoryProductTagController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryProductTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProductTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductTag $categoryProductTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductTag $categoryProductTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductTagRequest  $request
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryProductTagRequest $request, CategoryProductTag $categoryProductTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProductTag $categoryProductTag)
    {
        //
    }
}
