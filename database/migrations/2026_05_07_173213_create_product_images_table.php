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
        Schema::create('product_images', function (Blueprint $table) {

            $table->id();

            // Produit associé
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Image
            $table->string('image');

            // Alt (SEO / accessibilité)
            $table->string('alt')->nullable();

            // Image principale ou non
            $table->boolean('est_principale')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
