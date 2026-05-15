<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXCORE — Gaming Store</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <style>
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-dot.active {
            background-color: rgba(25, 135, 84, 0.8); /* vert */
            box-shadow: 0 0 6px rgba(25, 135, 84, 0.4);
        }

        .status-dot.inactive {
            background-color: rgba(220, 53, 69, 0.8); /* rouge */
            box-shadow: 0 0 6px rgba(220, 53, 69, 0.4);
        }

        .status-dot {
            width: 12px;
            height: 12px;
        }

        .status-dot.active {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(25,135,84,0.5); }
            70% { box-shadow: 0 0 0 6px rgba(25,135,84,0); }
            100% { box-shadow: 0 0 0 0 rgba(25,135,84,0); }
        }
    </style>

</head>

<body>

@extends('layouts.dashboard')

@section('content')



    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 style="font-family: var(--fh); font-weight:800; font-size:28px;">
                Gestion Produits
            </h2>

            <p style="color: var(--text-2); font-size:14px;">
                Gérez tous les produits de votre boutique
            </p>
        </div>

        <button class="btn-o" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-lg"></i>
            Ajouter Produit
        </button>
    </div>



    <form method="GET" action="{{ url('/dash/products') }}">

        <div class="card mb-4">
            <div class="c-body">

                <div class="row g-3">

                    <!-- SEARCH -->
                    <div class="col-lg-4">
                        <div class="s-wrap w-100">
                            <i class="bi bi-search"></i>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="w-100 product-input"
                                   placeholder="Rechercher un produit..."
                                   style="height:44px;">
                        </div>
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-lg-3">
                        <select name="category" class="form-select filter-select" style="height:44px;">
                            <option value="">Toutes les catégories</option>

                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ request('category') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- STATUS -->
                    <div class="col-lg-3">
                        <select name="stock_status" class="form-select filter-select" style="height:44px;">
                            <option value="">Tous les statuts</option>

                            <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>
                                En stock
                            </option>

                            <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>
                                Stock faible
                            </option>

                            <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>
                                Rupture
                            </option>
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="col-lg-2">
                        <button type="submit" class="btn-o w-100 justify-content-center h-100">
                            <i class="bi bi-funnel-fill"></i>
                            Filtrer
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </form>







    <!-- PRODUCTS TABLE -->
    <div class="table-card">

        <div class="t-head">

            <div>
                <div class="c-title">Liste des Produits</div>
            </div>

            <div class="d-flex gap-4 align-items-center">

                <div class="d-flex align-items-center gap-2">
                    <span class="status-dot active"></span>
                    <span>Actif</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="status-dot inactive"></span>
                    <span>Inactif</span>
                </div>

            </div>

            <div class="d-flex gap-2">



                <button class="ib">
                    <i class="bi bi-download"></i>
                </button>

                <button class="ib">
                    <i class="bi bi-grid"></i>
                </button>

            </div>

        </div>


        <div class="table-responsive table-striped">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr style="{{ $product->actif == 1 ? 'background-color: #19875410;' : 'background-color: rgba(220, 53, 69, 0.12);' }}">

                        <td>
                            <img src="{{ asset('storage/' . $product->miniature) }}" alt="noimg" width="60px" height="40px">
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    <div class="prod-n">{{ $product->nom }}</div>
                                    @if($product->stock == 0)
                                        <span class="badge bg-danger">Rupture de stock</span>
                                    @elseif($product->stock < 5)
                                        <span class="badge bg-warning text-dark">Stock faible</span>
                                    @else
                                        <span class="badge bg-success">En stock</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td>{{ $product->category->nom }}</td>

                        <td>
                            <strong>{{ $product->prix }} MAD</strong>
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            <div class="d-flex gap-2">
                                <button class="ib editBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProductModal"
                                        data-id="{{ $product->id }}"
                                        data-nom="{{ $product->nom }}"
                                        data-prix="{{ $product->prix }}"
                                        data-prix_promotion="{{ $product->prix_promotion }}"
                                        data-stock="{{ $product->stock }}"
                                        data-courte_description="{{ $product->courte_description }}"
                                        data-description="{{ $product->description }}"
                                        data-marque="{{ $product->marque }}"
                                        data-processeur="{{ $product->processeur }}"
                                        data-carte_graphique="{{ $product->carte_graphique }}"
                                        data-memoire_ram="{{ $product->memoire_ram }}"
                                        data-stockage="{{ $product->stockage }}"
                                        data-carte_mere="{{ $product->carte_mere }}"
                                        data-alimentation="{{ $product->alimentation }}"
                                        data-systeme_refroidissement="{{ $product->systeme_refroidissement }}"
                                        data-boitier="{{ $product->boitier }}"
                                        data-meta_titre="{{ $product->meta_titre }}"
                                        data-meta_description="{{ $product->meta_description }}"
                                        data-actif="{{ $product->actif }}"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                              <!--  <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ib">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                                -->

                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>




    </div>


    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>



    <!-- ADD PRODUCT MODAL -->
    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="modal fade" id="addProductModal" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content" style="border-radius:20px;">

                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h4 class="modal-title-custom">Ajouter Produit</h4>
                            <p class="modal-sub">Ajouter un nouveau produit à votre catalogue</p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row g-4">

                            <div class="col-lg-6">
                                <label>Nom Produit</label>
                                <input type="text" name="nom" class="form-control product-input" style="height:48px;" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-6">
                                <label>Catégorie</label>
                                <select name="categorie_id" class="form-select filter-select" style="height:48px;" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" >{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label>Référence</label>
                                <input type="text" name="reference" class="form-control product-input" style="height:48px;">
                                    @error('reference')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="col-lg-4">
                                <label>Prix</label>
                                <input type="number" name="prix" class="form-control product-input" style="height:48px;" required>
                            </div>

                            <div class="col-lg-4">
                                <label>Prix Promotion</label>
                                <input type="number" name="prix_promotion" class="form-control product-input" style="height:48px;" required>
                            </div>

                            <div class="col-lg-4">
                                <label>Stock</label>
                                <input type="number" name="stock" class="form-control product-input" style="height:48px;" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Marque</label>
                                <input type="text" name="marque" class="form-control product-input" style="height:48px;" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Miniature</label>
                                <input type="file" name="miniature" class="form-control" accept="image/*" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Processeur</label>
                                <input type="text" name="processeur" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-6">
                                <label>Carte Graphique</label>
                                <input type="text" name="carte_graphique" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-4">
                                <label>RAM</label>
                                <input type="text" name="memoire_ram" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-4">
                                <label>Stockage</label>
                                <input type="text" name="stockage" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-4">
                                <label>Carte Mère</label>
                                <input type="text" name="carte_mere" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-6">
                                <label>Alimentation</label>
                                <input type="text" name="alimentation" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-lg-6">
                                <label>Refroidissement</label>
                                <input type="text" name="systeme_refroidissement" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-12">
                                <label>Boîtier</label>
                                <input type="text" name="boitier" class="form-control product-input" style="height:48px;">
                            </div>

                            <div class="col-12">
                                <label>Courte Description</label>
                                <textarea name="courte_description" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="col-12">
                                <label>Description</label>
                                <textarea name="description" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="col-lg-6">
                                <label>Meta Titre</label>
                                <input type="text" name="meta_titre" class="form-control product-input">
                            </div>

                            <div class="col-lg-6">
                                <label>Meta Description</label>
                                <input type="text" name="meta_description" class="form-control product-input">
                            </div>

                            <div class="col-lg-6">
                                <input type="checkbox" name="actif" value="1">
                                <label>Produit Actif</label>
                            </div>

                            <div class="col-lg-6">
                                <input type="checkbox" name="mis_en_avant" value="1">
                                <label>Mis En Avant</label>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter Produit</button>
                    </div>

                </div>

            </div>
        </div>

    </form>







                <form id="editForm"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


        <input type="hidden" name="id" id="edit_id">

        <div class="modal fade" id="editProductModal" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content" style="border-radius:20px;">

                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h4>Modifier Produit</h4>
                            <p class="text-muted">Mise à jour des informations</p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-lg-6">
                                <label>Nom</label>
                                <input type="text" name="nom" id="edit_nom" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Prix</label>
                                <input type="number" name="prix" id="edit_prix" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Prix Promotion</label>
                                <input type="number" name="prix_promotion" id="edit_prix_promotion" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Stock</label>
                                <input type="number" name="stock" id="edit_stock" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <label>Courte Description</label>
                                <textarea name="courte_description" id="edit_courte_description" class="form-control" required></textarea>
                            </div>

                            <div class="col-12">
                                <label>Description</label>
                                <textarea name="description" id="edit_description" class="form-control" required></textarea>
                            </div>

                            <div class="col-lg-6">
                                <label>Marque</label>
                                <input type="text" name="marque" id="edit_marque" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Miniature</label>
                                <input type="file" name="miniature" class="form-control" required>
                            </div>

                            <div class="col-lg-6">
                                <label>Processeur</label>
                                <input type="text" name="processeur" id="edit_processeur" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <label>Carte Graphique</label>
                                <input type="text" name="carte_graphique" id="edit_carte_graphique" class="form-control">
                            </div>

                            <div class="col-lg-4">
                                <label>RAM</label>
                                <input type="text" name="memoire_ram" id="edit_memoire_ram" class="form-control">
                            </div>

                            <div class="col-lg-4">
                                <label>Stockage</label>
                                <input type="text" name="stockage" id="edit_stockage" class="form-control">
                            </div>

                            <div class="col-lg-4">
                                <label>Carte Mère</label>
                                <input type="text" name="carte_mere" id="edit_carte_mere" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <label>Alimentation</label>
                                <input type="text" name="alimentation" id="edit_alimentation" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <label>Refroidissement</label>
                                <input type="text" name="systeme_refroidissement" id="edit_systeme_refroidissement" class="form-control">
                            </div>

                            <div class="col-12">
                                <label>Boîtier</label>
                                <input type="text" name="boitier" id="edit_boitier" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <label>Meta Titre</label>
                                <input type="text" name="meta_titre" id="edit_meta_titre" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <label>Meta Description</label>
                                <input type="text" name="meta_description" id="edit_meta_description" class="form-control">
                            </div>

                            <div class="col-lg-6">
                                <input type="checkbox" name="actif" id="edit_actif" value="1">
                                <label>Actif</label>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer border-0">

                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                                Annuler</button>

                        <button type="submit"
                                class="btn btn-warning btn-sm">
                            Modifier
                        </button>

                    </div>

                </div>

            </div>
        </div>

    </form>




@endsection

<script>
    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.editBtn');
        if (!btn) return;

        const id = btn.dataset.id;

        const form = document.getElementById('editForm');

        // ✅ IMPORTANT : route correcte
        form.action = `/dash/products/${id}`;

        // fill inputs
        document.getElementById('edit_nom').value = btn.dataset.nom || '';
        document.getElementById('edit_prix').value = btn.dataset.prix || '';
        document.getElementById('edit_prix_promotion').value = btn.dataset.prix_promotion || '';
        document.getElementById('edit_stock').value = btn.dataset.stock || '';
        document.getElementById('edit_courte_description').value = btn.dataset.courte_description || '';
        document.getElementById('edit_description').value = btn.dataset.description || '';
        document.getElementById('edit_marque').value = btn.dataset.marque || '';
        document.getElementById('edit_processeur').value = btn.dataset.processeur || '';
        document.getElementById('edit_carte_graphique').value = btn.dataset.carte_graphique || '';
        document.getElementById('edit_memoire_ram').value = btn.dataset.memoire_ram || '';
        document.getElementById('edit_stockage').value = btn.dataset.stockage || '';
        document.getElementById('edit_carte_mere').value = btn.dataset.carte_mere || '';
        document.getElementById('edit_alimentation').value = btn.dataset.alimentation || '';
        document.getElementById('edit_systeme_refroidissement').value = btn.dataset.systeme_refroidissement || '';
        document.getElementById('edit_boitier').value = btn.dataset.boitier || '';
        document.getElementById('edit_meta_titre').value = btn.dataset.meta_titre || '';
        document.getElementById('edit_meta_description').value = btn.dataset.meta_description || '';

        document.getElementById('edit_actif').checked = btn.dataset.actif == 1;
    });
</script>


</body>
</html>
