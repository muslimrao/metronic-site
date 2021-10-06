<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightHistory extends Model
{
    use HasFactory;

    protected $table 		= 'flight_history';
    protected $primaryKey 	= 'id';
    protected $query;


    public function pilot()
    {
        return $this->belongsTo(Pilots::class,'pilot_id');
    }

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class,'aircraft_id');
    }


    public function getPilotNameAttribute()
    {
        return $this->pilot->full_name;
    }

    public function getAircraftNameAttribute()
    {
        return $this->aircraft->aircraft_name;
    }


    public function favorite_aircraft()
    {
        return $this->select('*', \DB::raw('count(*) as total_flights_by_aircraft'))->groupByRaw('pilot_id, aircraft_id');
    }


}
