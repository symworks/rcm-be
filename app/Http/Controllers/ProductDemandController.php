<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDemandRequest;
use App\Http\Requests\UpdateProductDemandRequest;
use App\Models\ProductDemand;

class ProductDemandController extends Controller
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
     * @param  \App\Http\Requests\StoreProductDemandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductDemandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDemand  $productDemand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDemand $productDemand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDemand  $productDemand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDemand $productDemand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductDemandRequest  $request
     * @param  \App\Models\ProductDemand  $productDemand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductDemandRequest $request, ProductDemand $productDemand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDemand  $productDemand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDemand $productDemand)
    {
        //
    }
}
