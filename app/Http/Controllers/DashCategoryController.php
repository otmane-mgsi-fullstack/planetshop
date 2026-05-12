<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashCategoryController extends Controller
{

    public function index(Request $request)
    {
        $query = Category::query();

        // SEARCH
        if ($request->search) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // STATUS
        if ($request->status !== null) {
            $query->where('actif', $request->status);
        }

        $categories = $query->paginate(10);

        return view('dashboard.category', compact('categories'));
    }









    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG UNIQUE
        $slug = Str::slug($request->nom);

        $originalSlug = $slug;
        $i = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        $validated['slug'] = $slug;

        // STATUS
        $validated['actif'] = $request->has('actif') ? 1 : 0;

        // IMAGE
        if ($request->hasFile('image')) {

            $validated['image'] =
                $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return back()->with('success', 'Catégorie ajoutée avec succès');
    }









    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG
        $validated['slug'] = Str::slug($request->nom);

        // STATUS
        $validated['actif'] = $request->has('actif') ? 1 : 0;

        // IMAGE
        if ($request->hasFile('image')) {

            // DELETE OLD IMAGE
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] =
                $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return back()->with('success', 'Catégorie modifiée');
    }










    public function destroy(Category $category)
    {
        // DELETE IMAGE
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée');
    }
}
