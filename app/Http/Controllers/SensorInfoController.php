<?php

namespace App\Http\Controllers;

use App\SensorInfo;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class SensorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SensorInfo::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = new SensorInfo();
        $s->smoke_level = $request->smoke_level;
        $s->co2_level = $request->co2_level;
        $s->room_no = $request->room_no;
        $s->floor_no = $request->floor_no;
        $s->is_active = $request->is_active;
        $s->save();

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return \Illuminate\Http\Response
     */
    public function show(SensorInfo $sensorinfo)
    {
        return $sensorinfo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return \Illuminate\Http\Response
     */
    public function isRegistered(SensorInfo $id)
    {
        $as = ["isAvailable" => true, "info" => $id];
        return $as;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorInfo $sensorInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SensorInfo  $sensorinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SensorInfo $sensorinfo)
    {
        $sensorinfo->update($request->all());
        return $sensorinfo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorInfo $sensorInfo)
    {
        //
    }
}
