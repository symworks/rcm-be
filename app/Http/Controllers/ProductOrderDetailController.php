<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductOrderDetailRequest;
use App\Http\Requests\UpdateProductOrderDetailRequest;
use App\Models\ProductOrderDetail;

class ProductOrderDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreProductOrderDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOrderDetailRequest $request)
    {
        //
        $request->validate([
            'order_qty' => ['required', 'integer'],
            'product_order_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
        ]);

        $productOrderDetail = ProductOrderDetail::create($request->all());

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $productOrderDetail->get('id'),
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOrderDetail  $productOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOrderDetail $productOrderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOrderDetail  $productOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOrderDetail $productOrderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductOrderDetailRequest  $request
     * @param  \App\Models\ProductOrderDetail  $productOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductOrderDetailRequest $request, ProductOrderDetail $productOrderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOrderDetail  $productOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOrderDetail $productOrderDetail)
    {
        //
    }
}
