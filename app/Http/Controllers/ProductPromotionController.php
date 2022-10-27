<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPromotionRequest;
use App\Http\Requests\UpdateProductPromotionRequest;
use App\Models\ProductPromotion;

class ProductPromotionController extends Controller
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
     * @param  \App\Http\Requests\StoreProductPromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPromotionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductPromotionRequest  $request
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductPromotionRequest $request, ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPromotion $productPromotion)
    {
        //
    }
}
