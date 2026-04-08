<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

   protected $fillable = [
    'order_id',
    'photo_path',
    'photo_type',
    'uploaded_by'
    ];

    const TYPE_LOADING = 'loading';
    const TYPE_DELIVERY = 'delivery';

    public static $types = [
        self::TYPE_LOADING => 'Foto de Carga',
        self::TYPE_DELIVERY => 'Foto de Entrega',
    ];

   public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function deliveredPhoto()
    {
        return $this->hasOne(Photo::class)->where('type', 'delivered');
    }

    public function routePhoto()
    {
        return $this->hasOne(Photo::class)->where('type', 'in_route');
    }
}
