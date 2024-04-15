<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIkeys extends Model
{
    use HasFactory;


    public function klanten()
    {
        return $this->hasMany(related: Klant::class);
    }

    protected $table = 'APIkeys';

    protected $fillable = [
        'id',
        'klantenID',
        'startdatum',
        'APIkey',
        'actief'
    ];



}
