<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['fecha_pedido', 'product_id', 'unidades_comprar', 'total'];

    /**
     * Define la relación con el modelo Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
