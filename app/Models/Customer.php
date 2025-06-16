<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = 'customers';

    protected $casts = [
        'uuid' => 'string',
        'user_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
