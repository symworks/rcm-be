<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogProductRequest;
use App\Http\Requests\UpdateLogProductRequest;
use App\Models\LogProduct;

class LogProductController extends Controller
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
     * @param  \App\Http\Requests\StoreLogProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogProduct  $logProduct
     * @return \Illuminate\Http\Response
     */
    public function show(LogProduct $logProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogProduct  $logProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(LogProduct $logProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogProductRequest  $request
     * @param  \App\Models\LogProduct  $logProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogProductRequest $request, LogProduct $logProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogProduct  $logProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogProduct $logProduct)
    {
        //
    }
}
