<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductTagRequest;
use App\Http\Requests\UpdateCategoryProductTagRequest;
use App\Models\CategoryProductTag;

class CategoryProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => CategoryProductTag::paginate(15),
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
        $request->validate(
            [
                'code' => ['required','string','max:255'],
                'name' => ['required','string','max:255'],
            ]
        );

        $categoryProductTag = new CategoryProductTag();
        $categoryProductTag->fill($request->all());
        $categoryProductTag->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $categoryProductTag->id,
                ]
            ]
        );
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
    public function update(UpdateCategoryProductTagRequest $request, $id)
    {
        //
        $request->validate(
            [
                'code' => ['required','string','max:255'],
                'name' => ['required','string','max:255'],
            ]
        );

        $categoryProductTag = new CategoryProductTag();
        $categoryProductTag->fill($request->all());

        $affected = CategoryProductTag::where('id', $id)->update($categoryProductTag->totallyGuarded());

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
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid Category Product Tag ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $categoryProductTag->delete();
        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'deletedId' => $affected,
                ]
            ]
        );
    }
}
