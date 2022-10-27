<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryVnDistrictRequest;
use App\Http\Requests\UpdateCategoryVnDistrictRequest;
use App\Models\CategoryVnDistrict;
use Illuminate\Http\Request;

class CategoryVnDistrictController extends Controller
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

        $queryBuilder = CategoryVnDistrict::select('*');
        if ($request->has('province_id')) {
            $queryBuilder = $queryBuilder->where('category_vn_province_id', $request->province_id);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $queryBuilder->paginate(15),
        ];
    }

    public function indexNoPaginate(Request $request)
    {
        $queryBuilder = CategoryVnDistrict::select('id as value', 'name as label');
        if ($request->has('province_id')) {
            $queryBuilder = $queryBuilder->where('category_vn_province_id', $request->province_id);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $queryBuilder->get(),
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
     * @param  \App\Http\Requests\StoreCategoryVnDistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryVnDistrictRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryVnDistrict  $categoryVnDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryVnDistrict $categoryVnDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryVnDistrict  $categoryVnDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryVnDistrict $categoryVnDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryVnDistrictRequest  $request
     * @param  \App\Models\CategoryVnDistrict  $categoryVnDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryVnDistrictRequest $request, CategoryVnDistrict $categoryVnDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryVnDistrict  $categoryVnDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryVnDistrict $categoryVnDistrict)
    {
        //
    }
}
