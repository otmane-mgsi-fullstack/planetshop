<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerSupport extends Model
{
    use HasFactory;
    protected $table = 'customers_support';
    protected $fillable = [
        'client_id',
        'nom',
        'email',
        'sujet',
        'message',
        'statut'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
