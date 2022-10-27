<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRangeRequest;
use App\Http\Requests\UpdatePriceRangeRequest;
use App\Models\PriceRange;
use Illuminate\Http\Request;

class PriceRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $product_id)
    {
        //
        $per_page = 15;
        if ($request->has('per_page')) {
            $per_page = $request->per_page > $per_page ? $per_page : $request->per_page;
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => PriceRange::where('product_id', $product_id)::paginate($per_page),
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
     * @param  \App\Http\Requests\StorePriceRangeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRangeRequest $request)
    {
        //
        $request->validate(
            [
                'min_price' => ['required', 'float'],
                'nax_price' => ['required', 'float'],
            ]
        );

        $priceRange = new PriceRange();
        $priceRange->fill($request->all());
        $priceRange->created_by_id = $request->user()->id;
        $priceRange->updated_by_id = $request->user()->id;
        $priceRange->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $priceRange->id,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceRange  $priceRange
     * @return \Illuminate\Http\Response
     */
    public function show(PriceRange $priceRange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceRange  $priceRange
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceRange $priceRange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePriceRangeRequest  $request
     * @param  \App\Models\PriceRange  $priceRange
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceRangeRequest $request, $id)
    {
        //
        $request->validate(
            [
                'min_price' => ['required', 'float'],
                'nax_price' => ['required', 'float'],
            ]
        );

        $priceRange = new PriceRange();
        $priceRange->fill($request->all());

        $affected = PriceRange::where('id', $id)->update($priceRange->toArray());

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
     * @param  \App\Models\PriceRange  $priceRange
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $priceRange = PriceRange::find($id);
        if (!$priceRange) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid PriceRange ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $priceRange->delete();
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
