<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryVnWardRequest;
use App\Http\Requests\UpdateCategoryVnWardRequest;
use App\Models\CategoryVnWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryVnWardController extends Controller
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

        $queryBuilder = DB::table('category_vn_wards');
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
     * @param  \App\Http\Requests\StoreCategoryVnWardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
            'category_vn_district_id' => ['required', 'numeric'],
        ]);

        $categoryVnWard = new CategoryVnWard();
        $categoryVnWard->code = $request->code;
        $categoryVnWard->name = $request->name;
        $categoryVnWard->category_vn_district_id = $request->category_vn_district_id;

        $categoryVnWard->created_by_id = $request->user()->id;
        $categoryVnWard->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $categoryVnWard->id,
            ]
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryVnWard $categoryVnWard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryVnWard $categoryVnWard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryVnWardRequest  $request
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
            ]
        );

        $affected = CategoryVnWard::where('id', $request->id)
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
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryVnWard = CategoryVnWard::find($id);
        if (!$categoryVnWard) {
            return [
                'error_code' => 400,
                'msg' => 'Category ward not found',
            ];
        }

        $affected = $categoryVnWard->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
