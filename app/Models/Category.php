<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Adicione esta linha
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Adicione esta linha

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function products():hasMany{
        return $this->hasMany(Product::class);
    }
}
