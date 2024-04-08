<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{

    protected $fillable = [
        'STN', 'DATE', 'TIME', 'TEMP', 'DEWP', 'STP', 'SLP', 'VISIB', 'WDSP', 'PRCP', 'SNDP', 'FRSHTT', 'CLDC', 'WNDDIR'
    ];
}
