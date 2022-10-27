<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdsCampaignRequest;
use App\Http\Requests\UpdateAdsCampaignRequest;
use App\Models\AdsCampaign;
use Illuminate\Http\Request;

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

        $adsCampaigns = [];
        if (!$request->has('is_active')) {
            $adsCampaigns = AdsCampaign::paginate($perPage);
        } else {
            $adsCampaigns = AdsCampaign::where('is_active', $request->is_active)->paginate($perPage);
        }

        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => $adsCampaigns,
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
    public function store(StoreAdsCampaignRequest $request)
    {
        //
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
    public function update(UpdateAdsCampaignRequest $request, AdsCampaign $adsCampaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdsCampaign  $adsCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdsCampaign $adsCampaign)
    {
        //
    }
}
