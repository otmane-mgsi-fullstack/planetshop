<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prenom',
        'nom',
        'email',
        'telephone',
        'adresse',
        'ville',
        'pays',
        'actif',
    ];

    public function commandes()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supports()
    {
        return $this->hasMany(CustomerSupport::class, 'client_id');
    }
}
