<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $results = [];

        $queryBuilder = DB::table('product_orders');
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
     * @param  \App\Http\Requests\StoreProductOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'store_province_name' => ['string'],
            'store_district_id' => ['integer'],
            'store_district_name' => ['string'],
            'store_address_id' => ['integer'],
            'store_address_name' => ['string'],
            'customer_province_id' => ['integer'],
            'customer_province_name' => ['string'],
            'customer_district_id' => ['integer'],
            'customer_district_name' => ['string'],
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
    public function selectMethod(Request $request)
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

    public function update(Request $request)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
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
            'store_province_name' => ['string'],
            'store_district_id' => ['integer'],
            'store_district_name' => ['string'],
            'store_address_id' => ['integer'],
            'store_address_name' => ['string'],
            'customer_province_id' => ['integer'],
            'customer_province_name' => ['string'],
            'customer_district_id' => ['integer'],
            'customer_district_name' => ['string'],
            'payment_method_id' => ['integer'],
            'payment_method_name' => ['string'],
            'status' => ['integer'],
        ]);

        $affected = ProductOrder::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'delivery_method' => $request->delivery_method,
            'customer_address' => $request->customer_address,
            'other_request' => $request->other_request,
            'is_invoice' => $request->is_invoice,
            'is_call_other' => $request->is_call_other,
            'total_price' => $request->total_price,
            'store_province_id' => $request->store_province_id,
            'store_province_name' => $request->store_province_name,
            'store_district_id' => $request->store_district_id,
            'store_district_name' => $request->store_district_name,
            'store_address_id' => $request->store_address_id,
            'store_address_name' => $request->store_address_name,
            'customer_province_id' => $request->customer_province_id,
            'customer_province_name' => $request->customer_province_name,
            'customer_district_id' => $request->customer_district_id,
            'customer_district_name' => $request->customer_district_name,
            'payment_method_id' => $request->payment_method_id,
            'payment_method_name' => $request->payment_method_name,
            'status' => $request->status,
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
    public function destroy($id)
    {
        //
        $categoryVnProvince = ProductOrder::find($id);
        if (!$categoryVnProvince) {
            return [
                'error_code' => 400,
                'msg' => 'Category province not found',
            ];
        }

        $affected = $categoryVnProvince->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
