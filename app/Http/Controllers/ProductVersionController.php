<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVersionRequest;
use App\Http\Requests\UpdateProductVersionRequest;
use App\Models\ProductVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVersionController extends Controller
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

        $queryBuilder = DB::table('product_versions')
        ->join('product_images', 'product_versions.product_image_id', 'product_images.id')
        ->join('products', 'products.id', 'product_versions.product_id')
        ->select('product_versions.*', 'product_images.image_url', 'products.average_evaluation', 'products.product_type_id', 'products.product_info');

        if ($request->has('id')) {
            $queryBuilder = $queryBuilder->where('product_versions.id', $request->id);
        }

        if ($request->has('product_version_ids')) {
            $productVersionIds = $request->product_version_ids;
            for ($i = 0; $i < count($productVersionIds); $i++) {
                $queryBuilder = $queryBuilder->orWhere('product_versions.id', $productVersionIds[$i]);
            }
        }

        if ($request->has('product_id')) {
            $queryBuilder = $queryBuilder->where('product_versions.product_id', $request->product_id);
        }

        if ($request->has('product_type_id')) {
            $queryBuilder = $queryBuilder->where('products.product_type_id', $request->product_type_id);
        }

        // qty_critical
        // 1. instock
        // 2. sold
        // 3. busy
        // 4. not specified

        if ($request->has('critical')) {
            switch ($request->qty_critical) {
            case 'instock':
                $queryBuilder = $queryBuilder->where('instock_qty', '>', 0);
            case 'sold':
                $queryBuilder = $queryBuilder->where('instock_qty', '>', 0);
            case 'busy':
                $queryBuilder = $queryBuilder->where('busy_qty', '>', 0);
            default:
                // Do nothing
            }
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
     * @param  \App\Http\Requests\StoreProductVersionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductVersionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVersion $productVersion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVersion $productVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductVersionRequest  $request
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductVersionRequest $request, ProductVersion $productVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVersion $productVersion)
    {
        //
    }
}
