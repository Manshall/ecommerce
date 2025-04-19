<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['product_id', 'path'];

    // Relasi balik ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

