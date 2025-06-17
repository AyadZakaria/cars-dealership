<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'uuid',
        'brand',
        'model',
        'image_url',
        'year',
        'price',
        'mileage',
        'fuel_type',
        'availability',
        'in_service',
        'created_by'
    ];
    protected $table = 'cars';

    protected $casts = [
        'uuid' => 'string',
        'brand' => 'string',
        'model' => 'string',
        'image_url' => 'string',
        'year' => 'integer',
        'price' => 'decimal:2',
        'mileage' => 'integer',
        'availability' => 'string',
        'fuel_type' => 'string',
        'in_service' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function scopeForRent($query)
    {
        return $query->where('availability', 'for_rent')
            ->where('in_service', true);
    }
    public function scopeForSale($query)
    {
        return $query->where('availability', 'for_sale')
            ->where('in_service', true);
    }
}
