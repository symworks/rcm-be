<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
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

        $productTypes = [];

        if (!$request->has('is_active')) {
            $productTypes = ProductType::paginate($perPage);
        } else {
            $productTypes = ProductType::where('is_active', $request->is_active)->paginate($perPage);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $productTypes,
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
     * @param  \App\Http\Requests\StoreProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTypeRequest  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}