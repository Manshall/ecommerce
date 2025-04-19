<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Import benar
use Illuminate\Database\Eloquent\Model;
use App\Models\Product; // ✅ Pastikan Product diimport

class Brand extends Model
{
    use HasFactory; // ✅ Gunakan trait dengan benar

    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}

