<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashProductController extends Controller
{





    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->search) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // CATEGORY
        if ($request->category) {
            $query->where('categorie_id', $request->category);
        }

        // STOCK STATUS
        if ($request->stock_status) {

            if ($request->stock_status == 'in_stock') {
                $query->where('stock', '>', 10);

            } elseif ($request->stock_status == 'low_stock') {
                $query->whereBetween('stock', [1, 10]);

            } elseif ($request->stock_status == 'out') {
                $query->where('stock', 0);
            }
        }

        $products = $query->paginate(10);

        $categories = Category::all();

        return view('dashboard.product', compact('products', 'categories'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'reference' => 'nullable|string|max:255',
            'prix' => 'required|numeric',
            'prix_promotion' => 'nullable|numeric',
            'stock' => 'required|integer',
            'marque' => 'nullable|string|max:255',

            'processeur' => 'nullable|string',
            'carte_graphique' => 'nullable|string',
            'memoire_ram' => 'nullable|string',
            'stockage' => 'nullable|string',
            'carte_mere' => 'nullable|string',
            'alimentation' => 'nullable|string',
            'systeme_refroidissement' => 'nullable|string',
            'boitier' => 'nullable|string',

            'courte_description' => 'nullable|string',
            'description' => 'nullable|string',

            'meta_titre' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',

            'miniature' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG UNIQUE
        $slug = Str::slug($request->nom);

        $originalSlug = $slug;
        $i = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        $validated['slug'] = $slug;

        // CHECKBOX
        $validated['actif'] = $request->has('actif') ? 1 : 0;
        $validated['mis_en_avant'] = $request->has('mis_en_avant') ? 1 : 0;

        // IMAGE UPLOAD ✔
        if ($request->hasFile('miniature')) {
            $validated['miniature'] =
                $request->file('miniature')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Produit ajouté avec succès');
    }






    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prix' => 'required|numeric',
            'prix_promotion' => 'nullable|numeric',
            'stock' => 'required|integer',
            'courte_description' => 'nullable|string',
            'description' => 'nullable|string',
            'marque' => 'nullable|string',
            'processeur' => 'nullable|string',
            'carte_graphique' => 'nullable|string',
            'memoire_ram' => 'nullable|string',
            'stockage' => 'nullable|string',
            'carte_mere' => 'nullable|string',
            'alimentation' => 'nullable|string',
            'systeme_refroidissement' => 'nullable|string',
            'boitier' => 'nullable|string',
            'meta_titre' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'miniature' => 'nullable|image|max:2048',
        ]);

        $data['actif'] = $request->has('actif') ? 1 : 0;

        if ($request->hasFile('miniature')) {
            $data['miniature'] = $request->file('miniature')->store('products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Produit modifié');
    }




    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('dash.product')->with('success', 'Catégorie supprimée avec succès.');
    }





}
