<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryCurrencyRequest;
use App\Http\Requests\UpdateCategoryCurrencyRequest;
use App\Models\CategoryCurrency;

class CategoryCurrencyController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryCurrencyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryCurrency $categoryCurrency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryCurrency $categoryCurrency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryCurrencyRequest  $request
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryCurrencyRequest $request, CategoryCurrency $categoryCurrency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryCurrency $categoryCurrency)
    {
        //
    }
}
