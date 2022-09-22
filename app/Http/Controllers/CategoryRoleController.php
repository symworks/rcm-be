<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRoleRequest;
use App\Http\Requests\UpdateCategoryRoleRequest;
use App\Models\CategoryRole;
use Illuminate\Support\Facades\DB;

class CategoryRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(
            DB::table('category_roles')->paginate(15),
        );
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
    public function store(StoreCategoryRoleRequest $request)
    {
        //
        if (!$request->user()->is_admin) {
            return abort(403);
        }

        CategoryRole::create($request->all());

        $categoryRole = new CategoryRole();
        $categoryRole->fill($request->all());

        $categoryRole->created_by_id = $request->user()->id;
        $categoryRole->updated_by_id = $request->user()->id;

        $categoryRole->save();

        return response()->json();
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
    public function update(UpdateCategoryRoleRequest $request, CategoryRole $categoryRole)
    {
        //
        if (!$request->user()->is_admin) {
            return abort(403);
        }

        $categoryRole = new CategoryRole();
        $categoryRole->fill($request->all());

        $categoryRole->updated_by_id = $request->user()->id;

        CategoryRole::whereIs($request->id)->update($categoryRole->all());

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryRole  $categoryRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryRole $categoryRole)
    {
        //
    }
}
