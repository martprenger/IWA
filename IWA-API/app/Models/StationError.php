<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationError extends model
{
    protected $table = 'station_error';

    protected $fillable = [
        'station_name',
        'error',
        'count',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
