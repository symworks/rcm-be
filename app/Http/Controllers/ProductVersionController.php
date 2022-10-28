<?php

namespace App\Http\Controllers;

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

        $results = [];

        $queryBuilder = DB::table('product_versions');
        if ($request->has('fields')) {
            $queryBuilder = $queryBuilder->select($request->fields);
        } else {
            $queryBuilder = $queryBuilder->select('*');
        }

        if ($request->has('match_col') && $request->has('match_key')) {
            $queryBuilder = $queryBuilder->where($request->match_col, $request->match_key);
        }

        if ($request->has('find_col') && $request->has('find_key')) {
            $queryBuilder = $queryBuilder->where($request->find_col, 'like', '%'.$request->find_key.'%');
        }

        if ($request->has('order_col') && $request->has('order_key')) {
            $queryBuilder = $queryBuilder->orderBy($request->order_col, $request->order_key);
        }

        if ($request->has('numcomp_col') && $request->has('numcomp_opt') && $request->has('numcomp_val')) {
            $queryBuilder = $queryBuilder->where($request->numcomp_col, $request->numcomp_opt, $request->numcomp_val);
        }

        if (!$request->has('use_paginate') || $request->use_paginate == 'true') {
            $results = $queryBuilder->paginate($perPage);
        } else {
            $results = $queryBuilder->get();
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $results,
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'origin_price' => ['required', 'numeric'],
            'official_price' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric'],
            'product_name' => ['required', 'string', 'max:255'],
            'product_type_id' => ['required', 'numeric'],
            'product_type_name' => ['required', 'string', 'max:255'],
        ]);

        $productVersion = new ProductVersion();
        $productVersion->name = $request->name;
        $productVersion->origin_price = $request->origin_price;
        $productVersion->official_price = $request->official_price;
        $productVersion->product_id = $request->product_id;
        $productVersion->product_name = $request->product_name;
        $productVersion->product_type_id = $request->product_type_id;
        $productVersion->product_type_name = $request->product_type_name;

        $productVersion->created_by_id = $request->user()->id;
        $productVersion->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $productVersion->id,
            ]
        ];
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
    public function update(Request $request)
    {
        //
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'origin_price' => ['required', 'numeric'],
                'official_price' => ['required', 'numeric'],
                'product_id' => ['required', 'numeric'],
                'product_name' => ['required', 'string', 'max:255'],
                'product_type_id' => ['required', 'numeric'],
                'product_type_name' => ['required', 'string', 'max:255'],
            ]
        );

        $affected = ProductVersion::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'origin_price' => $request->origin_price,
            'official_price' => $request->official_price,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'product_type_id' => $request->product_type_id,
            'product_type_name' => $request->product_type_name,
        ]);

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'updatedCount' => $affected
                ]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productVersion = ProductVersion::find($id);
        if (!$productVersion) {
            return [
                'error_code' => 400,
                'msg' => 'Product version not found',
            ];
        }

        $affected = $productVersion->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
