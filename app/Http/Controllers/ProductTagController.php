<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductTagRequest;
use App\Http\Requests\UpdateProductTagRequest;
use App\Models\ProductTag;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        //
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => ProductTag::where('product_id', $product_id)::paginate(15),
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
     * @param  \App\Http\Requests\StoreProductTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTagRequest $request)
    {
        //
        $request->validate(
            [
                'product_id' => ['required', 'integer'],
                'category_product_tag_id' => ['required', 'integer'],
            ]
        );

        $productTag = new ProductTag();
        $productTag->fill($request->all());
        $productTag->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $productTag->id
                ] 
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTag $productTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTagRequest  $request
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTagRequest $request, $id)
    {
        //
        $request->validate(
            [
                'product_id' => ['required', 'integer'],
                'category_product_tag_id' => ['required', 'integer'],
            ]
        );

        $productTag = new ProductTag();
        $productTag->fill($request->all());
        
        $affected = ProductTag::where('id', $id)->update($productTag->toArray());

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
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productTag = ProductTag::find($id);

        if (!$productTag) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Product tag not found',
                ]
            );
        }

        $affected = $productTag->delete();
        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'deletedId' =>$affected
                ]
            ]
        );

    }
}
