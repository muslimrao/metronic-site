<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pilots extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table 		= 'pilots';
    protected $primaryKey 	= 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function flight_history()
    {
        return $this->hasMany(FlightHistory::class,'pilot_id');
    }

    public function pilot_role()
    {
        return $this->belongsTo(PilotRoles::class,'pilot_role_id');
    }

    public function rank()
    {
        return $this->belongsTo(Ranks::class,'rank_id');
    }

    public function hub()
    {
        return $this->belongsTo(Hubs::class,'hub_id');
    }

    public function airline()
    {
        return $this->belongsTo(Airlines::class,'airline_id');
    }

    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


    public function getRoleNameAttribute()
    {
        return $this->pilot_role->name;
    }

    
    public function getRoleSlugAttribute()
    {
        return $this->pilot_role->slug;
    }

    public function getRankNameAttribute()
    {
        if ( $this->rank != null )
        {
            return $this->rank->rank_name;
        }
        
        return '';
    }

    public function getHubNameAttribute()
    {
        if ( $this->hub != null)
        {
            return $this->hub->hub_name;
        }
        
        return '';
    }


    public function favorite_aircrafts()
    {
        
        return $this->flight_history()-> select('*', \DB::raw('count(*) as total_flights_by_aircraft'))->groupByRaw('pilot_id, aircraft_id')->orderBy('total_flights_by_aircraft', 'desc');
        // return $this->where("id", 9);
    }
}
