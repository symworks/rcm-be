<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductBrandRequest;
use App\Http\Requests\UpdateCategoryProductBrandRequest;
use App\Models\CategoryProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProductBrandController extends Controller
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
            'payload' => CategoryProductBrand::where('product_id', $product_id)->paginate($per_page),
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
     * @param  \App\Http\Requests\StoreCategoryProductBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryProductBrandRequest $request)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'string', 'max:255'],
                'product_id' => ['required', 'integer'],
            ]
        );

        $productBrand = new CategoryProductBrand();
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
     * @param  \App\Models\CategoryProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryProductBrand $productBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryProductBrand $productBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductBrandRequest  $request
     * @param  \App\Models\CategoryProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryProductBrandRequest $request, $id)
    {
        //
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'string', 'max:255'],
                'product_id' => ['required', 'integer'],
            ]
        );

        $productBrand = new CategoryProductBrand();
        $productBrand->fill($request->all());

        $affected = CategoryProductBrand::where('id', $id)->update($productBrand->toArray());

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
     * @param  \App\Models\CategoryProductBrand  $productBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existCategoryProductBrand = CategoryProductBrand::find($id);
        if (!$existCategoryProductBrand) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid CategoryProductBrand ID',
                    'payload' => null
                ]
            );
        }

        $affected = $existCategoryProductBrand->delete();
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
