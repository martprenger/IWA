<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ContractStation extends Model
{
    use HasFactory;

    protected $table = 'contract_stations';

    protected $fillable = [
        'contract_id',
        'station',
    ];

    // Define the relationship with the Contract model
    public function contract()
    {
        return $this->belongsTo(Contracten::class);
    }
}
