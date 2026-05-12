<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Client facultatif
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients')
                ->nullOnDelete();

            // Informations client
            $table->string('nom_client');

            $table->string('email_client')->nullable();

            $table->string('telephone_client');

            $table->text('adresse_livraison');

            $table->text('notes')->nullable();

            // Prix
            $table->decimal('sous_total', 10, 2);

            $table->decimal('frais_livraison', 10, 2)->default(0);

            $table->decimal('montant_total', 10, 2);

            // Méthode paiement
            $table->enum('methode_paiement', [

                'paiement_livraison',
                'virement_bancaire'

            ])->default('paiement_livraison');

            // Statut commande IMPORTANT
            $table->enum('statut_commande', [

                'en_attente',
                'confirmee',
                'en_preparation',
                'en_livraison',
                'livree',
                'annulee',
                'retournee'

            ])->default('en_attente');

            // Statut paiement
            $table->enum('statut_paiement', [

                'non_paye',
                'paye',
                'rembourse'

            ])->default('non_paye');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
