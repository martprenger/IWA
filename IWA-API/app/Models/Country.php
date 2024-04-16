<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    protected $primaryKey = 'country_code';

    public $incrementing = false;

    protected $fillable = [
        'country_code',
        'country',
    ];

    public $timestamps = false;

    // Define relationships if any
    public function geolocations()
    {
        return $this->hasMany(Geolocation::class, 'country_code', 'country_code');
    }
}
