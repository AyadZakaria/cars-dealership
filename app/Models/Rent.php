<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'uuid',
        'reservation_uuid',
        'customer_uuid',
        'car_uuid',
        'start_date',
        'end_date',
        'reservation_confirmation_date',
        'total_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = 'rents';
    protected $casts = [
        'uuid' => 'string',
        'reservation_uuid' => 'string',
        'customer_uuid' => 'string',
        'car_uuid' => 'string',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'reservation_confirmation_date' => 'datetime',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_uuid', 'uuid');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_uuid', 'uuid');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_uuid', 'uuid');
    }
}
