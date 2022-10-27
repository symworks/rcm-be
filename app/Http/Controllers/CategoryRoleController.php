<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRoleRequest;
use App\Http\Requests\UpdateCategoryRoleRequest;
use App\Models\CategoryRole;

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
    public function index()
    {
        //
        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => CategoryRole::paginate(15),
            ]
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
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoryRole = new CategoryRole($request->all());
        $categoryRole->is_system_role = false;
        $categoryRole->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $categoryRole->id,
                ]
            ]
        );
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
    public function update(UpdateCategoryRoleRequest $request, $id)
    {
        //
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoryRole = new CategoryRole();
        $categoryRole->fill($request->all());

        $affected = CategoryRole::where('id', $id)->where('is_system_role', false)->update($categoryRole->toArray());

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'updatedCount' => $affected,
                ]
            ]
        );
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
        $existCategoryRole = CategoryRole::find($id);
        if (!$existCategoryRole) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid category role id id provided',
                    'payload' => null,
                ]
            );
        }

        if ($existCategoryRole->is_system_role) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Could not delete system data',
                    'payload' => null,
                ]
            );
        }

        $existCategoryRole->delete();
        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'deletedId' => $existCategoryRole->id,
                ]
            ]
        );
    }
}
