<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = \App\Models\Category::where('actif', true)->get();

        $query = Product::where('actif', true);

        if ($request->filled('categorie') && $request->categorie !== 'all') {
            $query->where('categorie_id', $request->categorie);
        }

        $products = $query->get();

        // Produits de la catégorie "périphérique"
        $peripheriqueCategory = \App\Models\Category::whereRaw('LOWER(nom) LIKE ?', ['%périphérique%'])
            ->orWhereRaw('LOWER(nom) LIKE ?', ['%peripherique%'])
            ->first();

        $peripheriques = $peripheriqueCategory
            ? Product::where('actif', true)
                ->where('categorie_id', $peripheriqueCategory->id)
                ->get()
            : collect();

        return view('store.index', compact('products', 'categories', 'peripheriques'));
    }
}
