<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'categorie_id',
        'nom',
        'slug',
        'courte_description',
        'description',
        'reference',
        'stock',
        'prix',
        'prix_promotion',
        'miniature',
        'marque',
        'processeur',
        'carte_graphique',
        'memoire_ram',
        'stockage',
        'carte_mere',
        'alimentation',
        'systeme_refroidissement',
        'boitier',
        'meta_titre',
        'meta_description',
        'mis_en_avant',
        'actif'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id','id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function itemsCommande()
    {
        return $this->hasMany(OrderItem::class, 'produit_id');
    }
}
