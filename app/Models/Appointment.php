<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * Los atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['fecha_pedido', 'product_id', 'unidades_comprar'];

    /**
     * Define la relación con el modelo Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        // Define la relación "pertenece a" con el modelo Product
        return $this->belongsTo(Product::class);
    }
}
