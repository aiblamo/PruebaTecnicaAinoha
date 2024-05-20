<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'photo'];
    
    /**
     * Define la relación muchos a muchos con la tabla de categorías a través de la tabla pivote 'category_product'.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    /**
     * Define la relación uno a muchos con la tabla de precios de productos.
     */
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    /**
     * Obtiene el precio más reciente del producto para la fecha especificada.
     *
     * @param  string  $fecha_pedido
     * @return float|null
     */
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

    /**
     * Define la relación de pertenencia a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

