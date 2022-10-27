<?php

namespace App\Http\Controllers;

use App\Models\CategoryVnProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryVnProvinceController extends Controller
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

        $queryBuilder = DB::table('category_vn_provinces');
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
     * @param  \App\Http\Requests\StoreCategoryVnProvinceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
        ]);

        $categoryVnProvince = new CategoryVnProvince();
        $categoryVnProvince->code = $request->code;
        $categoryVnProvince->name = $request->name;

        $categoryVnProvince->created_by_id = $request->user()->id;
        $categoryVnProvince->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $categoryVnProvince->id,
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryVnProvince $categoryVnProvince)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryVnProvince $categoryVnProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryVnProvinceRequest  $request
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryVnProvince $categoryVnProvince)
    {
        //
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
            ]
        );

        $affected = CategoryVnProvince::where('id', $request->id)
        ->update([
            'code' => $request->code,
            'name' => $request->name,
            'updated_by_id' => $request->user()->id,
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
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryVnProvince = CategoryVnProvince::find($id);
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
