<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Models\Producer;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => Producer::paginate(15),
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
     * @param  \App\Http\Requests\StoreProducerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProducerRequest $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_nation_id' => ['required', 'string', 'max:255'],
        ]);

        $producer = new Producer();
        $producer->fill($request->all());
        $producer->created_by_id = $request->user()->id;
        $producer->updated_by_id = $request->user()->id;
        $producer->save();

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'insertedId' => $producer->id,
                ]
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function show(Producer $producer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function edit(Producer $producer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProducerRequest  $request
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProducerRequest $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_nation_id' => ['required', 'string', 'max:255'],
        ]);

        $producer = new Producer();
        $producer->fill($request->all());
        $producer->updated_by_id = $request->user()->id;
        
        $affected = Producer::where('id', $id)->update($producer->toArray());

        return response()->json(
            [
                'error_code' => 200,
                'msg' => 'Successfully',
                'payload' => [
                    'affectedRows' => $affected,
                ]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $existProducer = Producer::find($id);
        if (!$existProducer) {
            return response()->json(
                [
                    'error_code' => 400,
                    'msg' => 'Invalid Role ID',
                    'payload' => null,
                ]
            );
        }

        $affected = $existProducer->delete();
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
