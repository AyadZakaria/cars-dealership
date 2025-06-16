<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'uuid',
        'customer_uuid',
        'car_uuid',
        'purchase_date',
        'total_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = 'purchases';
    protected $casts = [
        'uuid' => 'string',
        'customer_uuid' => 'string',
        'car_uuid' => 'string',
        'purchase_date' => 'datetime',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_uuid', 'uuid');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_uuid', 'uuid');
    }
}
