<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductOrderRequest;
use App\Http\Requests\UpdateProductOrderRequest;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
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

        $queryBuilder = ProductOrder::select('*');
        $results = [];

        if ($request->has('id')) {
            $queryBuilder = $queryBuilder->where('id', $request->id);
        }

        if (!$request->has('use_paginate') || $request->use_paginate === 'true') {
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
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOrderRequest $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'string'],
            'delivery_method' => ['required', 'boolean'],
            'customer_address' => ['string'],
            'other_request' => ['string', 'nullable'],
            'is_invoice' => ['required', 'boolean'],
            'is_call_other' => ['required', 'boolean'],
            'total_price' => ['required', 'numeric'],
            'store_province_id' => ['integer'],
            'store_district_id' => ['integer'],
            'store_address_id' => ['integer'],
            'customer_province_id' => ['integer'],
            'customer_district_id' => ['integer'],
            'user_id' => ['integer'],
        ]);

        $productOrder = ProductOrder::create($request->all());
        $productOrder->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $productOrder->id,
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOrder $productOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOrder $productOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductOrderRequest  $request
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function selectMethod(UpdateProductOrderRequest $request, ProductOrder $productOrder)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
            'payment_method_id' => ['required', 'numeric'],
        ]);

        $getDatas = ProductOrder::where('id', $request->id)->get();
        if (count($getDatas) != 1) {
            return [
                'error_code' => 300,
                'msg' => 'Đơn hàng không tồn tại.'
            ];
        } else if (!($getDatas[0]->status == ProductOrder::STATUS_INIT)) {
            return [
                'error_code' => 300,
                'msg' => 'Đơn hàng đã được khóa, vui lòng liên đăng nhập hoặc hệ quản trị viên để biết tình trạng đơn hàng',
            ];
        }

        $status = ProductOrder::STATUS_WAIT_FOR_CUSTOMER_PAYING; // Thanh toán qua vdt, banking,...
        if ($request->payment_method_id == 1) { // Nhận hàng trực tiếp
            $getDatas[0]->status = ProductOrder::STATUS_WAIT_FOR_STAFF_CONFIRM_ORDERING;
        }

        $affected = ProductOrder::where('id', $request->id)
        ->update([
            'payment_method_id' => $request->payment_method_id,
            'status' => $status
        ]);

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'updatedCount' => $affected,
            ],
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOrder $productOrder)
    {
        //
    }
}
