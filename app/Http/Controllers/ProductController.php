<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
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
            'code' => 200,
            'msg' => 'successfully',
            'payload' => Product::paginate(15)
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'top_features' => ['required', 'string'],
                'description' => ['required', 'string'],
                'is_discount' => ['required', 'boolean'],
                'is_trending' => ['required', 'boolean'],
                'origin_price' => ['required', 'number'],
                'official_price' => ['required', 'number'],
                'average_evaluation' => ['required', 'number'],
                'total_evaluation' => ['required', 'integer'],
                'image_1' => ['required', 'string'],
                'image_2' => ['required','string'],
                'image_3' => ['required','string'],
                'image_4' => ['required','string'],
                'image_5' => ['required','string'],

                'producer_id' => ['required', 'integer'],
                'category_currency_id' => ['required', 'integer'],
            ]
        );

        $product = new Product();
        $product->fill($request->all());
        $product->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $product->id,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'top_features' => ['required', 'string'],
                'description' => ['required', 'string'],
                'is_discount' => ['required', 'boolean'],
                'is_trending' => ['required', 'boolean'],
                'origin_price' => ['required', 'number'],
                'official_price' => ['required', 'number'],
                'average_evaluation' => ['required', 'number'],
                'total_evaluation' => ['required', 'integer'],
                'image_1' => ['required', 'string'],
                'image_2' => ['required','string'],
                'image_3' => ['required','string'],
                'image_4' => ['required','string'],
                'image_5' => ['required','string'],

                'producer_id' => ['required', 'integer'],
                'category_currency_id' => ['required', 'integer'],
            ]
        );

        $product = new Product();
        $product->fill($request->all());

        $affected = Product::where('id', $id)->update($product->all());

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Succefully',
                'payload' => [
                    'updatedCount' => $affected,
                ]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existProduct = Product::find($id);
        if (!$existProduct) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid Product ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $existProduct->delete();
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
