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
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            // Relation catégorie
            $table->foreignId('categorie_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            // Informations produit
            $table->string('nom');

            $table->string('slug')->unique();

            $table->text('courte_description')->nullable();

            $table->longText('description')->nullable();

            // Référence produit
            $table->string('reference')->unique();

            // Gestion stock
            $table->integer('stock')->default(0);

            // Prix
            $table->decimal('prix', 10, 2);

            $table->decimal('prix_promotion', 10, 2)->nullable();

            // Image principale
            $table->string('miniature')->nullable();

            // Marque
            $table->string('marque')->nullable();

            // Caractéristiques PC Gaming
            $table->string('processeur')->nullable();

            $table->string('carte_graphique')->nullable();

            $table->string('memoire_ram')->nullable();

            $table->string('stockage')->nullable();

            $table->string('carte_mere')->nullable();

            $table->string('alimentation')->nullable();

            $table->string('systeme_refroidissement')->nullable();

            $table->string('boitier')->nullable();

            // SEO
            $table->string('meta_titre')->nullable();

            $table->text('meta_description')->nullable();

            // Mise en avant
            $table->boolean('mis_en_avant')->default(false);

            // Activation
            $table->boolean('actif')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
