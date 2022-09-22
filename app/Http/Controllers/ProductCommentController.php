<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCommentRequest;
use App\Http\Requests\UpdateProductCommentRequest;
use App\Models\ProductComment;

class ProductCommentController extends Controller
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
     * @param  \App\Http\Requests\StoreProductCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function show(ProductComment $productComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductComment $productComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCommentRequest  $request
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCommentRequest $request, ProductComment $productComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductComment $productComment)
    {
        //
    }
}
