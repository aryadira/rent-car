<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = [
        'no_ktp',
        'name',
        'date_of_birth',
        'email',
        'phone',
        'description',
    ];

    public function rent()
    {
        return $this->hasOne(Rent::class, 'tenant_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
