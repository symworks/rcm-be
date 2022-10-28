<?php

namespace App\Http\Controllers;

use App\Models\AdsCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdsCampaignController extends Controller
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

        $results = [];

        $queryBuilder = DB::table('ads_campaigns');
        if ($request->has('fields')) {
            $queryBuilder = $queryBuilder->select($request->fields);
        } else {
            $queryBuilder = $queryBuilder->select('*');
        }

        if ($request->has('match_col') && $request->has('match_key')) {
            $queryBuilder = $queryBuilder->where($request->match_col, $request->match_key);
        }

        if ($request->has('find_col') && $request->has('find_key')) {
            $queryBuilder = $queryBuilder->where($request->find_col, 'like', '%'.$request->find_key.'%');
        }

        if ($request->has('order_col') && $request->has('order_key')) {
            $queryBuilder = $queryBuilder->orderBy($request->order_col, $request->order_key);
        }

        if (!$request->has('use_paginate') || $request->use_paginate == 'true') {
            $results = $queryBuilder->paginate($perPage);
        } else {
            $results = $queryBuilder->get();
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $results,
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
     * @param  \App\Http\Requests\StoreAdsCampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'original' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'string', 'max:255'],
            'link_to_campaign' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $adsCampaign = new AdsCampaign();
        $adsCampaign->name = $request->name;
        $adsCampaign->original = $request->original;
        $adsCampaign->thumbnail = $request->thumbnail;
        $adsCampaign->link_to_campaign = $request->link_to_campaign;

        $adsCampaign->created_by_id = $request->user()->id;
        $adsCampaign->save();

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'insertedId' => $adsCampaign->id,
            ]
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(AdsCampaign $adsCampaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(AdsCampaign $adsCampaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdsCampaignRequest  $request
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdsCampaign $adsCampaign)
    {
        //
        $request->validate(
            [
                'id' => ['required', 'numeric'],
                'name' => ['required', 'string', 'max:255'],
                'original' => ['required', 'string', 'max:255'],
                'thumbnail' => ['required', 'string', 'max:255'],
                'link_to_campaign' => ['required', 'string', 'max:255'],
                'is_active' => ['required', 'boolean'],
            ]
        );

        $affected = AdsCampaign::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'original' => $request->original,
            'thumbnail' => $request->thumbnail,
            'link_to_campaign' => $request->link_to_campaign,
            'is_active' => $request->is_active,
            'updated_by_id' => $request->user()->id,
        ]);

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'updatedCount' => $affected
                ]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $adsCampaign = AdsCampaign::find($id);
        if (!$adsCampaign) {
            return [
                'error_code' => 400,
                'msg' => 'Ads campagin not found',
            ];
        }

        $affected = $adsCampaign->delete();
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'affected' => $affected,
            ]
        ];
    }
}
