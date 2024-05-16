<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['fecha_pedido', 'product_id', 'unidades_comprar'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
