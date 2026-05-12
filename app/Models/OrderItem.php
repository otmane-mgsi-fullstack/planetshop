<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'prix_total'
    ];

    public function commande()
    {
        return $this->belongsTo(Order::class, 'commande_id');
    }

    public function produit()
    {
        return $this->belongsTo(Product::class, 'produit_id');
    }
}
