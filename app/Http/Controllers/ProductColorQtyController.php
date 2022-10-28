<?php

namespace App\Http\Controllers;

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

        $results = [];

        $queryBuilder = DB::table('product_color_qties');
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
     * @param  \App\Http\Requests\StoreProductColorQtyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instock_qty' => ['required', 'numeric'],
            'sold_qty' => ['required', 'numeric'],
            'busy_qty' => ['required', 'numeric'],
            'product_version_id' => ['required', 'numeric'],
            'product_version_name' => ['required', 'string', 'max:255'],
        ]);

        $productColorQty = new ProductColorQty();
        $productColorQty->name = $request->name;
        $productColorQty->instock_qty = $request->instock_qty;
        $productColorQty->sold_qty = $request->sold_qty;
        $productColorQty->busy_qty = $request->busy_qty;
        $productColorQty->product_version_id = $request->product_version_id;
        $productColorQty->product_version_name = $request->product_version_name;

        $productColorQty->created_by_id = $request->user()->id;
        $productColorQty->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $productColorQty->id,
            ]
        ];
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
    public function update(Request $request)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'instock_qty' => ['required', 'numeric'],
            'sold_qty' => ['required', 'numeric'],
            'busy_qty' => ['required', 'numeric'],
            'product_version_id' => ['required', 'numeric'],
            'product_version_name' => ['required', 'string', 'max:255'],
        ]);

        $affected = ProductColorQty::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'instock_qty' => $request->instock_qty,
            'sold_qty' => $request->sold_qty,
            'busy_qty' => $request->busy_qty,
            'product_version_id' => $request->product_version_id,
            'product_version_name' => $request->product_version_name,
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
     * @param  \App\Models\ProductColorQty  $productColorQty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productColorQty = ProductColorQty::find($id);
        if (!$productColorQty) {
            return [
                'error_code' => 400,
                'msg' => 'Product color not found',
            ];
        }

        $affected = $productColorQty->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
