<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductEvaluateRequest;
use App\Http\Requests\UpdateProductEvaluateRequest;
use App\Models\ProductEvaluate;

class ProductEvaluateController extends Controller
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
     * @param  \App\Http\Requests\StoreProductEvaluateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductEvaluateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function show(ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductEvaluateRequest  $request
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductEvaluateRequest $request, ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductEvaluate $productEvaluate)
    {
        //
    }
}
