<?php

namespace App\Http\Controllers;

use App\SensorInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class SensorInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SensorInfo[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return SensorInfo::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return SensorInfo
     */
    public function store(Request $request)
    {
        // Server side validation
        $validatedData = $request->validate([
            'floor_no' => 'required|numeric|min:0',
            'room_no' => 'required|numeric|min:0'
        ]);

        // only the room number and the floor number are required for SensorRegistration(other values are updated separately)
        $s = new SensorInfo();
        $s->smoke_level = 0;
        $s->co2_level = 0;
        $s->room_no = $validatedData["room_no"];
        $s->floor_no = $validatedData["floor_no"];
//        $s->is_active = false;
        $s->updated_at = null;
        $s->save();

        return $s;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return SensorInfo
     */
    public function show(SensorInfo $sensorinfo)
    {
        return $sensorinfo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SensorInfo  $sensorInfo
     * @return array
     */
    public function isRegistered($id)
    {
        // find the sensor from the Id
        $user = SensorInfo::find($id);
        // if the Sensor with that ID is not available send back this
        if($user === null) return ["isAvailable" => false];
        // if the sensor is available send
        return ["isAvailable" => true, "info" => $user];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SensorInfo  $sensorinfo
     * @return SensorInfo
     */
    public function update(Request $request, SensorInfo $sensorinfo)
    {
        $validatedData = $request->validate([
            'smoke_level' => 'required|numeric|min:0|max:10',
            'co2_level' => 'required|numeric|min:0|max:10'
        ]);

        $sensorinfo->co2_level = $validatedData["co2_level"];
        $sensorinfo->smoke_level = $validatedData["smoke_level"];
        $sensorinfo->updated_at = Carbon::now();
        $sensorinfo->save();
        return $sensorinfo;
    }

    /**
     * Update the specified attributes as admin resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SensorInfo  $sensorinfo
     * @return SensorInfo
     */
    public function adminUpdate(Request $request, SensorInfo $sensor)
    {
        $validatedData = $request->validate([
            'floor_no' => 'required|numeric|min:0',
            'room_no' => 'required|numeric|min:0'
        ]);

        $sensor->room_no = $validatedData["room_no"];
        $sensor->floor_no = $validatedData["floor_no"];
        // make sure that the updated_at timestamp on floor and room number updates
        $sensor->timestamps = false;
        $sensor->save();

        return $sensor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SensorInfo $sensor
     * @return SensorInfo
     * @throws \Exception
     */
    public function destroy(SensorInfo $sensor)
    {
        $sensor->delete();
        return $sensor;
    }
}
