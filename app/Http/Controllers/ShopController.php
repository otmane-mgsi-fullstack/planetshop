<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// Décommentez la ligne suivante si vous avez un modèle Category
// use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        // 1. Récupérer les catégories
        // Si vous n'avez pas de modèle Category, vous pouvez récupérer les catégories distinctes depuis la table products,
        // ou simplement envoyer une collection vide pour utiliser le fallback HTML.
        $categories = collect();
        if (class_exists('App\Models\Category')) {
            $categories = \App\Models\Category::all();
        }

        // 2. Récupérer les produits depuis la base de données
        // On récupère par exemple les 8 derniers produits. Adaptez la condition (ex: where('statut', 'actif')) selon votre table.
        $products = collect();
        if (class_exists('App\Models\Product')) {
            $products = Product::latest()->take(8)->get();

            // On peut définir un "is_featured" aléatoire pour la démonstration ou le baser sur une vraie colonne de votre table
            foreach ($products as $index => $product) {
                // S'il n'y a pas de colonne is_featured, on en met un en vedette virtuellement (ex: le premier)
                $product->is_featured = ($index === 1);

                // Si la colonne specifications est une chaîne JSON en base de données,
                // vous pouvez vous assurer qu'elle est décodée ici si votre modèle ne l'a pas castée en array
                if (is_string($product->specifications)) {
                    $product->specifications = json_decode($product->specifications, true);
                }
            }
        }






        // 3. Retourner la vue avec les données
        return view('store.index', compact('categories', 'products'));
    }
}
