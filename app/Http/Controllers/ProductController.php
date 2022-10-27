<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $perPage = 15;
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $queryBuilder = Product::select('*');

        if ($request->has('id')) {
            $queryBuilder = $queryBuilder->where('id', $request->id);
        }

        if ($request->has('product_type_id')) {
            $queryBuilder = $queryBuilder->where('product_type_id', $request->product_type_id);
        }

        if ($request->has('price_order')) {
            if ($request->price_order === 'asc') {
                $queryBuilder = $queryBuilder->orderBy('official_price', 'asc');
            } else {
                $queryBuilder = $queryBuilder->orderBy('official_price', 'desc');
            }
        }

        return [
            'error_code' => 200,
            'msg' => 'successfully',
            'payload' => $queryBuilder->paginate($perPage),
        ];
    }

    public function indexNoPaginate(Request $request)
    {
        $queryBuilder = Product::select('*');
        if ($request->has('ids')) {
            $ids = $request->get('ids');
            foreach ($ids as $id) {
                $queryBuilder = $queryBuilder->orWhere('id', $id);
            }
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $queryBuilder->get(),
        ];
    }

    public function productById($id)
    {
        return [
            'error_code' => 200,
            'msg' => 'successfully',
            'payload' => Product::where('id', $id)->get()
        ];
    }

    public function productByProductTypeId(Request $request, $product_type_id)
    {
        //
        $per_page = $request->per_page;
        if (!$per_page) {
            return [
                'error_code' => 400,
                'msg' => 'per_page does not exist',
            ];
        }

        $priceOrder = $request->price_order;

        $products = [];

        if ($priceOrder === 'asc') {
            $products = Product::where('product_type_id', $product_type_id)->orderBy('official_price', 'asc')->paginate($per_page);
        } else if ($priceOrder === 'desc') {
            $products = Product::where('product_type_id', $product_type_id)->orderBy('official_price', 'desc')->paginate($per_page);
        } else {
            $products = Product::where('product_type_id', $product_type_id)->paginate($per_page);
        }

        return [
            'error_code' => 200,
            'msg' => 'successfully',
            'payload' => $products,
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
