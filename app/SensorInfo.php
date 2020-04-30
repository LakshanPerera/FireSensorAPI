<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class SensorInfo extends Model
{
    protected $guarded = [];
    protected $appends = ["is_active"];

    // if the difference between the last value updated time and the current time is greater than 10 Sec,
    // assume the sensor as inactive
    public function getIsActiveAttribute($value){
        // if updated_at is null, then return false
        if($this->updated_at === null) return false;
        $timeGap = Carbon::now()->diffInSeconds($this->updated_at);
        $TIME_GAP = 10;
        if($timeGap > $TIME_GAP){
            return false;
        }else{
            return true;
        }
    }
}
