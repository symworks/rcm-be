<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryCurrencyRequest;
use App\Http\Requests\UpdateCategoryCurrencyRequest;
use App\Models\CategoryCurrency;

class CategoryCurrencyController extends Controller
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
            'payload' => CategoryCurrency::paginate(15),
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
     * @param  \App\Http\Requests\StoreCategoryCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryCurrencyRequest $request)
    {
        //
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],

            'category_nation_id' => ['required', 'integer'],
        ]);

        $categoryCurrency = new CategoryCurrency();
        $categoryCurrency->fill($request->all());
        $categoryCurrency->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $categoryCurrency->id
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryCurrency $categoryCurrency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryCurrency $categoryCurrency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryCurrencyRequest  $request
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryCurrencyRequest $request, $id)
    {
        //
        $request->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],

            'category_nation_id' => ['required', 'integer'],
        ]);

        $categoryCurrency = new CategoryCurrency();
        $categoryCurrency->fill($request->all());

        $affected = CategoryCurrency::where('id', $id)->update($categoryCurrency->toArray());

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
     * @param  \App\Models\CategoryCurrency  $categoryCurrency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existCategoryCurrency = CategoryCurrency::find($id);
        if (!$existCategoryCurrency) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid category category ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $existCategoryCurrency->delete();
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
