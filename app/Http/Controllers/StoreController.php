<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
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

        $queryBuilder = DB::table('stores');
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
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address_detail' => ['required', 'string', 'max:255'],
            'province_address_id' => ['required', 'numeric'],
            'province_address_name' => ['required', 'string', 'max:255'],
            'district_address_id' => ['required', 'numeric'],
            'district_address_name' => ['required', 'string', 'max:255'],
            'ward_address_id' => ['required', 'numeric'],
            'ward_address_name' => ['required', 'string', 'max:255'],
        ]);

        $store = new Store();
        $store->name = $request->name;
        $store->address_detail = $request->address_detail;
        $store->province_address_id = $request->province_address_id;
        $store->province_address_name = $request->province_address_name;
        $store->district_address_id = $request->district_address_id;
        $store->district_address_name = $request->district_address_name;
        $store->ward_address_id = $request->ward_address_id;
        $store->ward_address_name = $request->ward_address_name;

        $store->created_by_id = $request->user()->id;
        $store->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $store->id,
            ],
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'address_detail' => ['required', 'string', 'max:255'],
            'province_address_id' => ['required', 'numeric'],
            'province_address_name' => ['required', 'string', 'max:255'],
            'district_address_id' => ['required', 'numeric'],
            'district_address_name' => ['required', 'string', 'max:255'],
            'ward_address_id' => ['required', 'numeric'],
            'ward_address_name' => ['required', 'string', 'max:255'],
        ]);

        $affected = Store::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'address_detail' => $request->address_detail,
            'province_address_id' => $request->province_address_id,
            'province_address_name' => $request->province_address_name,
            'district_address_id' => $request->district_address_id,
            'district_address_name' => $request->district_address_name,
            'ward_address_id' => $request->ward_address_id,
            'ward_address_name' => $request->ward_address_name,
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $store = Store::find($id);
        if (!$store) {
            return [
                'error_code' => 400,
                'msg' => 'Store not found',
            ];
        }

        $affected = $store->delete();
        return response()->json([
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ]);
    }
}
