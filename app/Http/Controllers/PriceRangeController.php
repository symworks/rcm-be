<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRangeRequest;
use App\Http\Requests\UpdatePriceRangeRequest;
use App\Models\PriceRange;

class PriceRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(UpdatePriceRangeRequest $request, PriceRange $priceRange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceRange  $priceRange
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceRange $priceRange)
    {
        //
    }
}
