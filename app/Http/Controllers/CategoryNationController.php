<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryNationRequest;
use App\Http\Requests\UpdateCategoryNationRequest;
use App\Models\CategoryNation;
use Illuminate\Support\Facades\DB;

class CategoryNationController extends Controller
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
                'payload' => CategoryNation::paginate(15),
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
     * @param  \App\Http\Requests\StoreCategoryNationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryNationRequest $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoryNation = new CategoryNation($request->all());
        $categoryNation->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $categoryNation,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNation $categoryNation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryNation $categoryNation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryNationRequest  $request
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryNationRequest $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $categoryNation = new CategoryNation();
        $categoryNation->fill($request->all());

        $affected = CategoryNation::where('id', $id)->update($categoryNation->toArray());

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
     * @param  \App\Models\CategoryNation  $categoryNation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existCategoryNation = CategoryNation::find($id);
        if (!$existCategoryNation) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid Category Nation ID',
                    'payload' => null
                ]
            );
        }

        $affected = $existCategoryNation->delete();
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
