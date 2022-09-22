<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryNationRequest;
use App\Http\Requests\UpdateCategoryNationRequest;
use App\Models\CategoryNation;

class CategoryNationController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryNationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryNationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNation $categoryNation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryNation $categoryNation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryNationRequest  $request
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryNationRequest $request, CategoryNation $categoryNation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryNation $categoryNation)
    {
        //
    }
}
