<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRoleRequest;
use App\Http\Requests\UpdateCategoryRoleRequest;
use App\Models\CategoryRole;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="My First API Documentation",
 *     version="0.1",
 *      @OA\Contact(
 *          email="binhnguyen.balebom@gmail.com"
 *      ),
 * ),
 *  @OA\Server(
 *      description="Learning env",
 *      url="https://foo.localhost:8000/api/"
 *  ),
 */
class CategoryRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * @OA\Get(
     *      path="/api/role",
     *      operationId="index",
     *      tags={"Clients"},
     *      summary="Get list of category roles",
     *      description="Returns list of category roles",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     *     )
     *
     * Returns list of category roles
     */
    public function index(Request $request)
    {
        //
        $perPage = 15;
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $results = [];

        $queryBuilder = CategoryRole::select('*');
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
     * @param  \App\Http\Requests\StoreCategoryRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoryRole = new CategoryRole();
        $categoryRole->code = $request->code;
        $categoryRole->name = $request->name;

        $categoryRole->is_system_role = false;

        $categoryRole->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $categoryRole->id,
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryRole  $categoryRole
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryRole $categoryRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryRole  $categoryRole
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryRole $categoryRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRoleRequest  $request
     * @param  \App\Models\CategoryRole  $categoryRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'id' => ['required', 'numeric'],
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            $affected = CategoryRole::where('id', $request->id)
            ->where('is_system_role', false)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
            ]);
        } catch (Exception $ex) {
            return [
                'error_code' => 200,
                'msg' => 'Cannot update system role',
            ];
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'updatedCount' => $affected,
            ]
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryRole  $categoryRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoryRole = CategoryRole::find($id);
        if (!$categoryRole) {
            return [
                'error_code' => 400,
                'msg' => 'Category role not found',
            ];
        }

        if ($categoryRole->is_system_role) {
            return [
                'error_code' => 400,
                'msg' => 'Cannot delete system role'
            ];
        }

        $affected = $categoryRole->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
