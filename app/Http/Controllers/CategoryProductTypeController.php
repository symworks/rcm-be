<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductTypeRequest;
use App\Http\Requests\UpdateCategoryProductTypeRequest;
use App\Models\CategoryProductType;

class CategoryProductTypeController extends Controller
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
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => CategoryProductType::paginate(15),
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
     * @param  \App\Http\Requests\StoreCategoryProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProductTypeRequest $request)
    {
        //
        $request->validate(
            [
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
            ]
        );

        $CategoryProductType = new CategoryProductType();
        $CategoryProductType->fill($request->all());
        $CategoryProductType->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $CategoryProductType->id,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProductType  $CategoryProductType
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductType $CategoryProductType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProductType  $CategoryProductType
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductType $CategoryProductType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductTypeRequest  $request
     * @param  \App\Models\CategoryProductType  $CategoryProductType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryProductTypeRequest $request, $id)
    {
        //
        $request->validate(
            [
                'code' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
            ]
        );

        $CategoryProductType = new CategoryProductType();
        $CategoryProductType->fill($request->all());

        $affected = CategoryProductType::where('id', $id)->update($CategoryProductType->toArray());

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
     * @param  \App\Models\CategoryProductType  $CategoryProductType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existCategoryProductType = CategoryProductType::find($id);
        if (!$existCategoryProductType) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid category product type ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $existCategoryProductType->delete();
        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Succefully',
                'payload' => [
                    'deletedId' => $affected,
                ]
            ]
        );
    }
}
