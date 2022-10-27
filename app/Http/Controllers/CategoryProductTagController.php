<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductTagRequest;
use App\Http\Requests\UpdateCategoryProductTagRequest;
use App\Models\CategoryProductTag;
use Illuminate\Http\Request;

class CategoryProductTagController extends Controller
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

        $queryBuilder = CategoryProductTag::select('*');
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
     * @param  \App\Http\Requests\StoreCategoryProductTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProductTagRequest $request)
    {
        //
        $request->validate([
            'code' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
        ]);

        $categoryProductTag = new CategoryProductTag();
        $categoryProductTag->code = $request->code;
        $categoryProductTag->name = $request->name;

        $categoryProductTag->created_by_id = $request->user()->id;
        $categoryProductTag->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $categoryProductTag->id,
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductTag $categoryProductTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductTag $categoryProductTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductTagRequest  $request
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryProductTagRequest $request)
    {
        //
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
            ]
        );

        $affected = CategoryProductTag::where('id', $request->id)
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
     * @param  \App\Models\CategoryProductTag  $categoryProductTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryProductTag = CategoryProductTag::find($id);
        if (!$categoryProductTag) {
            return [
                'error_code' => 400,
                'msg' => 'Category role not found',
            ];
        }

        $affected = $categoryProductTag->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
