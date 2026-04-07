<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number', 'customer_name', 'customer_number', 'fiscal_data',
        'order_date', 'delivery_address', 'notes', 'status', 'created_by'
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    const STATUS_ORDERED = 'ordered';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_IN_ROUTE = 'in_route';
    const STATUS_DELIVERED = 'delivered';

    public static $statuses = [
        self::STATUS_ORDERED => 'Pedido',
        self::STATUS_IN_PROCESS => 'En Proceso',
        self::STATUS_IN_ROUTE => 'En Ruta',
        self::STATUS_DELIVERED => 'Entregado',
    ];

    // Relaciones
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Accesores
    public function getStatusLabelAttribute()
    {
        return self::$statuses[$this->status] ?? $this->status;
    }

    public function getLoadingPhotoAttribute()
    {
        return $this->photos()->where('photo_type', 'loading')->first();
    }

    public function getDeliveryPhotoAttribute()
    {
        return $this->photos()->where('photo_type', 'delivery')->first();
    }
}