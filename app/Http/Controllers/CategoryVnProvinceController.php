<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryVnProvinceRequest;
use App\Http\Requests\UpdateCategoryVnProvinceRequest;
use App\Models\CategoryVnProvince;
use Illuminate\Http\Request;

class CategoryVnProvinceController extends Controller
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
            'payload' => CategoryVnProvince::paginate($perPage),
        ];
    }

    public function indexNoPaginate()
    {
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => CategoryVnProvince::select('id as value', 'name as label')->get(),
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
     * @param  \App\Http\Requests\StoreCategoryVnProvinceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryVnProvinceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryVnProvince $categoryVnProvince)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryVnProvince $categoryVnProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryVnProvinceRequest  $request
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryVnProvinceRequest $request, CategoryVnProvince $categoryVnProvince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryVnProvince  $categoryVnProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryVnProvince $categoryVnProvince)
    {
        //
    }
}
