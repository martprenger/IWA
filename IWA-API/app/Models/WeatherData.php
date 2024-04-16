<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{

    protected $fillable = [
        'STN', 'DATE', 'TIME', 'TEMP', 'DEWP', 'STP', 'SLP', 'VISIB', 'WDSP', 'PRCP', 'SNDP', 'FRSHTT', 'CLDC', 'WNDDIR'
    ];

    public static function isNumericType($value) {
        $isNumeric = [
            'TEMP', 'DEWP', 'STP', 'SLP', 'VISIB', 'WDSP', 'PRCP', 'SNDP', 'CLDC', 'WINDDIR'
        ];
        return in_array($value, $isNumeric);
    }
}
