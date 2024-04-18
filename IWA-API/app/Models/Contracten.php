<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracten extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'customer_id',
        'expiration_date',
    ];

    // Define the relationship with the Klant model
    public function klant()
    {
        return $this->belongsTo(Klant::class, 'customer_id');
    }

    public function stations()
    {
        return $this->hasMany(ContractStation::class, 'contract_id');
    }
    public function permissions()
    {
        return $this->hasMany(PermissionContract::class, 'contract_id');
    }
}
