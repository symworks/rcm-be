<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductBrandRequest;
use App\Http\Requests\UpdateProductBrandRequest;
use App\Models\ProductBrand;

class ProductBrandController extends Controller
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
            'payload' => ProductBrand::paginate(15),
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
     * @param  \App\Http\Requests\StoreProductBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductBrandRequest $request)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'string', 'max:255'],
            ]
        );

        $productBrand = new ProductBrand();
        $productBrand->fill($request->all());
        $productBrand->created_by_id = $request->user()->id;
        $productBrand->updated_by_id = $request->user()->id;
        $productBrand->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $productBrand->id,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrand $productBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBrand $productBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductBrandRequest  $request
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductBrandRequest $request, $id)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'string', 'max:255'],
            ]
        );

        $productBrand = new ProductBrand();
        $productBrand->fill($request->all());

        $affected = ProductBrand::where('id', $id)->update($productBrand->toArray());

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
     * @param  \App\Models\ProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existProductBrand = ProductBrand::find($id);
        if (!$existProductBrand) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid ProductBrand ID',
                    'payload' => null
                ]
            );
        }

        $affected = $existProductBrand->delete();
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
