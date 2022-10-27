<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryVnWardRequest;
use App\Http\Requests\UpdateCategoryVnWardRequest;
use App\Models\CategoryVnWard;
use Illuminate\Http\Request;

class CategoryVnWardController extends Controller
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

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'paylaod' => CategoryVnWard::paginate($perPage), 
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
     * @param  \App\Http\Requests\StoreCategoryVnWardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryVnWardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryVnWard $categoryVnWard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryVnWard $categoryVnWard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryVnWardRequest  $request
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryVnWardRequest $request, CategoryVnWard $categoryVnWard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryVnWard  $categoryVnWard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryVnWard $categoryVnWard)
    {
        //
    }
}
