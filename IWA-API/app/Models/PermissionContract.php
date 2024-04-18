<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionContract extends Model
{
    use HasFactory;

    protected $table = 'contract_permissions';

    protected $fillable = [
        'contract_id',
        'permissions',
    ];

    // Define the relationship with the Contract model
    public function contract()
    {
        return $this->belongsTo(Contracten::class);
    }
}
