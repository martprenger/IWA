<?php
// app/Models/NearestLocation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NearestLocation extends Model
{
    protected $table = 'nearestlocation';
    public $timestamps = false;

    protected $fillable = [
        'station_name',
        'name',
        'administrative_region1',
        'administrative_region2',
        'country_code',
        'longitude',
        'latitude',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_name', 'name');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'country_code');
    }
}
