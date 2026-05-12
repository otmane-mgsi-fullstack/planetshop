<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'nom_client',
        'email_client',
        'telephone_client',
        'adresse_livraison',
        'notes',
        'sous_total',
        'frais_livraison',
        'montant_total',
        'methode_paiement',
        'statut_commande',
        'statut_paiement'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'commande_id');
    }
}
