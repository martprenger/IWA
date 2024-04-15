<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class klant extends Model
{
    use HasFactory;

    public function API()
    {
        return $this->belongsTo(APIkeys::class);
    }

    protected $table = 'klanten';

    protected $fillable = [
        'klantnaam',
        'email',
        'password'
    ];
}
