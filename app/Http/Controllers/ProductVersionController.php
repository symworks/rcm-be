<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVersionRequest;
use App\Http\Requests\UpdateProductVersionRequest;
use App\Models\ProductVersion;
use Illuminate\Http\Request;

class ProductVersionController extends Controller
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

        $productVersions = ProductVersion::select('*');

        if ($request->has('product_id')) {
            $productVersions = $productVersions->where('product_id', $request->product_id);
        }

        // qty_critical
        // 1. instock
        // 2. sold
        // 3. busy
        // 4. not specified

        if ($request->has('critical')) {
            switch ($request->qty_critical) {
            case 'instock':
                $productVersions = $productVersions->where('instock_qty', '>', 0);
            case 'sold':
                $productVersions = $productVersions->where('instock_qty', '>', 0);
            case 'busy':
                $productVersions = $productVersions->where('busy_qty', '>', 0);
            default:
                // Do nothing
            }
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $productVersions->paginate($perPage),
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
     * @param  \App\Http\Requests\StoreProductVersionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductVersionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVersion $productVersion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVersion $productVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductVersionRequest  $request
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductVersionRequest $request, ProductVersion $productVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVersion  $productVersion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVersion $productVersion)
    {
        //
    }
}
