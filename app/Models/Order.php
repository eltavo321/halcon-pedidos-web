<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_number',
        'fiscal_data',
        'order_date',
        'delivery_address',
        'notes',
        'status',
        'created_by',
        'process_name',      // 👈 NUEVO
        'process_date'       // 👈 NUEVO
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'process_date' => 'datetime', // 👈 NUEVO
        'deleted_at' => 'datetime',
    ];

    // 📌 ESTADOS
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

    // 🔗 RELACIONES
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // 👇 RELACIONES ESPECÍFICAS (MEJOR QUE ACCESORES)
    public function routePhoto()
    {
        return $this->hasOne(Photo::class)->where('photo_type', 'in_route');
    }

    public function deliveredPhoto()
    {
        return $this->hasOne(Photo::class)->where('photo_type', 'delivered');
    }

    // 🧠 ACCESORES
    public function getStatusLabelAttribute()
    {
        return self::$statuses[$this->status] ?? $this->status;
    }
}