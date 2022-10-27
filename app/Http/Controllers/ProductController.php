<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

        $queryBuilder = DB::table('products')
        ->select('products.*', 'product_versions.official_price', 'product_versions.origin_price')
        ->join('product_versions', function ($join) {
            $join->on('products.id', 'product_versions.product_id')
            ->limit(1);
        });

        if ($request->has('id')) {
            $queryBuilder = $queryBuilder->where('products.id', $request->id);
        }

        if ($request->has('ids') && $request->has('product_version_ids')) {
            $productIds = $request->ids;
            $productVersionIds = $request->product_version_ids;
            if (count($productIds) != count($productVersionIds)) {
                return [
                    'error_code' => 400,
                    'msg' => 'Product Ids and Product Version Ids not match'
                ];
            }

            for ($i = 0; $i < count($productIds); $i++) {
                $queryBuilder = $queryBuilder->orWhere('product_versions.product_id', $productIds[$i])->where('product_versions.id', $productVersionIds[$i]);
            }
        }

        if ($request->has('product_type_id')) {
            $queryBuilder = $queryBuilder->where('product_type_id', $request->product_type_id);
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
