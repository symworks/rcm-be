<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductColorQtyRequest;
use App\Http\Requests\UpdateProductColorQtyRequest;
use App\Models\ProductColorQty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductColorQtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $perPage = 15;
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $queryBuilder = ProductColorQty::select('*');

        if ($request->has('product_version_id')) {
            $queryBuilder = $queryBuilder->where('product_version_id', $request->product_version_id);
        }

        $result = [];
        if (!$request->has('use_paginate') || $request->use_paginate === 'true') {
            $result = $queryBuilder->paginate($perPage);
        } else {
            $result = $queryBuilder->get();
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $result,
        ];
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
     * @param  \App\Http\Requests\StoreProductColorQtyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductColorQtyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductColorQty  $productColorQty
     * @return \Illuminate\Http\Response
     */
    public function show(ProductColorQty $productColorQty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductColorQty  $productColorQty
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductColorQty $productColorQty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductColorQtyRequest  $request
     * @param  \App\Models\ProductColorQty  $productColorQty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductColorQtyRequest $request, ProductColorQty $productColorQty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductColorQty  $productColorQty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductColorQty $productColorQty)
    {
        //
    }
}
