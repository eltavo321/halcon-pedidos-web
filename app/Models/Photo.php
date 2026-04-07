<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'photo_path', 'photo_type', 'uploaded_by'];

    const TYPE_LOADING = 'loading';
    const TYPE_DELIVERY = 'delivery';

    public static $types = [
        self::TYPE_LOADING => 'Foto de Carga',
        self::TYPE_DELIVERY => 'Foto de Entrega',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}