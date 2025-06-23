<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'uuid',
        'car_uuid',
        'customer_uuid',
        'rent_start_date',
        'rent_end_date',
        'status',
        'reservation_type',
        'total_rent_price',
        'total_sale_price',
        'is_confirmed',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $table = 'reservations';

    protected $casts = [
        'uuid' => 'string',
        'car_uuid' => 'string',
        'customer_uuid' => 'string',
        'rent_start_date' => 'datetime',
        'rent_end_date' => 'datetime',
        'status' => 'string',
        'reservation_type' => 'string',
        'total_rent_price' => 'decimal:2',
        'total_sale_price' => 'decimal:2',
        'is_confirmed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_uuid', 'uuid');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_uuid', 'uuid');
    }
}
