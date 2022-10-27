<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductBrandRequest;
use App\Http\Requests\UpdateProductBrandRequest;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByProductId(Request $request, $product_id)
    {
        //
        $per_page = 15;
        if ($request->has('per_page')) {
            $per_page = $request->per_page > $per_page ? $per_page : $request->per_page;
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => ProductBrand::where('product_id', $product_id)->paginate($per_page),
        ];
    }

    public function indexByProductName(Request $request, $product_name)
    {
        $per_page = 15;
        if ($request->has('per_page')) {
            $per_page = $request->per_page > $per_page ? $per_page : $request->per_page;
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => DB::table('product_brands')
                ->join('products', 'product_brands.product_id', '=', 'products.id')
                ->where('products.name', $product_name)
                ->select('product_brands.*')
                // ->get()
                ->paginate($per_page),
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
                'product_id' => ['required', 'integer'],
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
                'product_id' => ['required', 'integer'],
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
