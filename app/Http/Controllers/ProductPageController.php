<?php

namespace App\Http\Controllers;

use App\Models\Product; // Assurez-vous que c'est le bon namespace pour votre modèle
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    /**
     * Affiche la page de détails d'un produit spécifique.
     *
     * @param string $slug
     */
    public function show($slug)
    {
        // On récupère le produit par son slug, en s'assurant qu'il est actif
        $product = Product::where('slug', $slug)
            ->where('actif', true)
            ->firstOrFail();

        // Optionnel : Récupérer des produits similaires basés sur la même catégorie
        /*
        $relatedProducts = Product::where('categorie_id', $product->categorie_id)
                                  ->where('id', '!=', $product->id)
                                  ->where('actif', true)
                                  ->take(4)
                                  ->get();
        */

        // On retourne la vue (le nom reste identique)
        return view('store.product', compact('product'));
    }





    public function commander($id)
    {

        $product = Product::findOrFail($id);

        // Vérification du stock
        if ($product->stock <= 0) {
            return back()->with('error', 'Produit en rupture de stock.');
        }

        // Prix final
        $prixFinal = $product->prix_promotion ?? $product->prix;

        // Récupération du client connecté
        $client = \App\Models\Client::where('user_id', auth()->id())->first();

        // Vérification du client
        if (!$client) {
            return back()->with('error', 'Profil client introuvable.');
        }

        try {

            // Création de la commande
            $order = \App\Models\Order::create([
                'client_id' => $client->id,

                'nom_client' => $client->nom,
                'email_client' => $client->email,
                'telephone_client' => $client->telephone,

                'adresse_livraison' => trim($client->adresse . ', ' . $client->ville, ', '),

                'sous_total' => $prixFinal,
                'frais_livraison' => 0,
                'montant_total' => $prixFinal,

                'statut_commande' => 'en_attente',
                'statut_paiement' => 'non_paye'
            ]);

            // Ajouter le produit dans order_items
            \App\Models\OrderItem::create([
                'commande_id' => $order->id,
                'produit_id' => $product->id,
                'quantite' => 1,
                'prix_unitaire' => $prixFinal,
                'prix_total' => $prixFinal
            ]);

            // Diminuer le stock
            $product->stock -= 1;
            $product->save();

            return back()->with('success', 'Commande enregistrée avec succès !');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }


}
