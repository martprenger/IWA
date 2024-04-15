<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIkeys extends Model
{
    use HasFactory;

    protected $table = 'APIkeys';

    protected $fillable = [
        'id',
        'klantenID',
        'APIkey',
        'actief',
        'created_at',
    ];

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klantenID');
    }
}
