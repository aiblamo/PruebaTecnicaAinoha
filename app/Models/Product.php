<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'photo'];
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getLatestPriceForDate($fecha_pedido)
{
    // Obtener el precio más reciente del producto para la fecha especificada
    $latestPrice = $this->prices()
        ->where('start_date', '<=', $fecha_pedido)
        ->where('end_date', '>=', $fecha_pedido)
        ->latest('created_at')
        ->first();

    // Retornar el precio o null si no se encuentra ningún precio
    return $latestPrice ? $latestPrice->price : null;
}

public function user()
{
    return $this->belongsTo(User::class);
}

}