<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnRent extends Model
{
    protected $table = 'return_rents';

    protected $fillable = [
        'tenant_id',
        'no_car',
        'date_borrow',
        'date_return',
        'down_payment',
        'discount',
        'total'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }
}
