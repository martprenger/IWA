<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klant extends Model
{
    use HasFactory;

    protected $table = 'klanten';

    protected $fillable = [
        'id',
        'klantnaam',
        'email',
        'password'
    ];

    public function apiKeys()
    {
        return $this->hasMany(APIkeys::class, 'klantenID');
    }
}
