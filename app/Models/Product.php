<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Adicione esta linha

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
