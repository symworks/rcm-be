<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends Controller
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

        $queryBuilder = DB::table('payment_methods');
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
     * @param  \App\Http\Requests\StorePaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
        ]);

        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $request->name;
        $paymentMethod->logo = $request->logo;
        $paymentMethod->description = $request->description;

        $paymentMethod->created_by_id = $request->user()->id;
        $paymentMethod->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $paymentMethod->id,
            ],
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentMethodRequest  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
        ]);

        $affected = PaymentMethod::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'logo' => $request->logo,
            'description' => $request->description,
            'updated_by_id' => $request->updated_by_id,
        ]);

        return response()->json([
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'updatedCount' => $affected,
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $paymentMethod = PaymentMethod::find($id);
        if (!$paymentMethod) {
            return [
                'error_code' => 400,
                'msg' => 'Payment method not found',
            ];
        }

        $affected = $paymentMethod->delete();
        return response()->json([
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ]);
    }
}
