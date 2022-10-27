<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductEvaluateRequest;
use App\Http\Requests\UpdateProductEvaluateRequest;
use App\Models\Product;
use App\Models\ProductEvaluate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductEvaluateController extends Controller
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

        $queryBuilder = ProductEvaluate::select('*');
        if ($request->has('product_id')) {
            $queryBuilder = $queryBuilder->where('product_id', $request->product_id);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $queryBuilder->paginate($perPage),
        ];
    }

    public function indexWithCreatedUser(Request $request)
    {
        //
        $perPage = 15;
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $queryBuilder = DB::table('product_evaluates')
            ->join('users', 'product_evaluates.created_by_id', '=', 'users.id')
            ->select('product_evaluates.*', 'users.name', 'users.avatar');

        if ($request->has('product_id')) {
            $queryBuilder = $queryBuilder->where('product_evaluates.product_id', $request->product_id);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $queryBuilder->paginate($perPage),
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
     * @param  \App\Http\Requests\StoreProductEvaluateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductEvaluateRequest $request)
    {
        //
        $product = new ProductEvaluate();
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

    public function anonymousStore(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string'],
                'content' => ['required', 'string'],
                'rate_value' => ['required', 'integer'],
                'product_id' => ['required', 'integer'],
            ]
        );

        $anonymousUser = User::firstOrNew(array('email' => $request->email));
        $anonymousUser->name = $request->name;
        $anonymousUser->anonymous_user = true;
        $anonymousUser->avatar = 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200';
        $anonymousUser->save();

        $productEvaluate = new ProductEvaluate();
        $productEvaluate->rate_value = $request->rate_value;
        $productEvaluate->content = $request->content;
        $productEvaluate->product_id = $request->product_id;
        $productEvaluate->created_by_id = $anonymousUser->id;
        $productEvaluate->updated_by_id = $anonymousUser->id;
        $productEvaluate->save();
        DB::select('SELECT function_product_update_evaluation(?, ?);', [$request->product_id, $request->rate_value]);

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'user_id' => $anonymousUser->id,
                'product_evaluate_id' => $productEvaluate->id,
            ],
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function show(ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductEvaluateRequest  $request
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductEvaluateRequest $request, ProductEvaluate $productEvaluate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductEvaluate  $productEvaluate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductEvaluate $productEvaluate)
    {
        //
    }
}
