<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'slug',
        'description',
        'image',
        'actif'
    ];

    public function produits()
    {
        return $this->hasMany(Product::class, 'categorie_id');
    }
}
