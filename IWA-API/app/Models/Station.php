<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public $timestamps = false;

    protected $table = 'station';

    protected $fillable = [
        'name',
        'elevation',
        'longitude',
        'latitude',
        'location'
    ];

    public function stationErrors()
    {
        return $this->hasMany(StationError::class);
    }

    public function contractStations()
    {
        return $this->hasMany(ContractStation::class);
    }

    public function geolocation()
    {
        return $this->hasOne(Geolocation::class, 'station_name', 'name');
    }
}
