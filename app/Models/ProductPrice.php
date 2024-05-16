<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'start_date', 'end_date'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
