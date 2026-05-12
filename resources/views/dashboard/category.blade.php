<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXCORE — Gaming Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --orange:    #ff6b00;
            --orange-lt: #ff8c33;
            --o-dim:     rgba(255,107,0,.11);
            --blue:      #3b82f6;
            --green:     #10b981;
            --purple:    #8b5cf6;
            --red:       #ef4444;
            --r:         14px;
            --sw:        258px;
            --fh:        'Syne', sans-serif;
            --fb:        'DM Sans', sans-serif;

            /* layout colors */
            --bg:        #f5f5f7;
            --bg-card:   #ffffff;
            --bg-card-2: #fafafa;
            --bg-input:  #f0f0f3;
            --border:    #e4e4ea;
            --border-2:  #d0d0da;
            --text-1:    #18181b;
            --text-2:    #6b6b80;
            --text-3:    #a0a0b0;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text-1);
            font-family: var(--fb);
            font-size: 15px;
            min-height: 100vh;
        }

        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        h2 {
            font-family: var(--fh);
            font-weight: 800;
            font-size: 28px;
            color: var(--text-1);
        }

        .page-subtitle, [style*="--text-2"] {
            color: var(--text-2);
            font-size: 14px;
        }

        /* ── Primary button ── */
        .btn-o {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: var(--r);
            background: var(--orange);
            color: #fff;
            font-family: var(--fh);
            font-weight: 700;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: background .2s, box-shadow .2s, transform .15s;
        }

        .btn-o:hover {
            background: var(--orange-lt);
            box-shadow: 0 0 22px rgba(255,107,0,.35);
            transform: translateY(-1px);
        }

        .btn-o:active { transform: translateY(0); }

        /* ── Alert ── */
        .alert-success {
            background: rgba(16,185,129,.1);
            border: 1px solid rgba(16,185,129,.3);
            border-radius: var(--r);
            color: var(--green);
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        /* ── Table card ── */
        .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .t-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: var(--bg-card-2);
        }

        .c-title {
            font-family: var(--fh);
            font-size: 13px;
            font-weight: 700;
            color: var(--text-2);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ── Table ── */
        .table {
            margin: 0;
            color: var(--text-1);
            font-family: var(--fb);
        }

        .table thead tr {
            border-bottom: 1px solid var(--border);
        }

        .table thead th {
            background: transparent;
            color: var(--text-3);
            font-family: var(--fh);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 12px 16px;
            border: none;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .table tbody tr:last-child { border-bottom: none; }

        .table tbody tr:hover { background: var(--o-dim); }

        .table tbody td {
            padding: 13px 16px;
            border: none;
            vertical-align: middle;
            font-size: 14px;
            color: var(--text-1);
        }

        /* ── Badges ── */
        .badge.bg-success {
            background: rgba(16,185,129,.15) !important;
            border: 1px solid rgba(16,185,129,.35);
            color: var(--green) !important;
            font-family: var(--fb);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .badge.bg-danger {
            background: rgba(239,68,68,.12) !important;
            border: 1px solid rgba(239,68,68,.3);
            color: var(--red) !important;
            font-family: var(--fb);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        /* ── Icon buttons ── */
        .ib {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-input);
            color: var(--text-2);
            cursor: pointer;
            font-size: 13px;
            transition: all .18s;
        }

        .ib:hover {
            border-color: var(--orange);
            color: var(--orange);
            background: var(--o-dim);
        }

        /* ── Pagination ── */
        .pagination .page-link {
            background: var(--bg-card);
            border-color: var(--border);
            color: var(--text-2);
            font-family: var(--fb);
        }

        .pagination .page-link:hover {
            background: var(--orange);
            border-color: var(--orange);
            color: #fff;
        }

        .pagination .active .page-link {
            background: var(--orange);
            border-color: var(--orange);
            color: #fff;
        }

        /* ── Modals ── */
        .modal-content {
            background: var(--bg-card) !important;
            border: 1px solid var(--border-2) !important;
            border-radius: var(--r) !important;
            color: var(--text-1) !important;
        }

        .modal-header {
            padding: 1.5rem 1.75rem 1.25rem !important;
            border-bottom: 1px solid var(--border) !important;
            background: var(--bg-card-2) !important;
        }

        .modal-header h4 {
            font-family: var(--fh);
            font-weight: 800;
            font-size: 18px;
            color: var(--text-1);
            margin: 0;
        }

        .modal-header p {
            color: var(--text-2);
            font-size: 13px;
            margin: 3px 0 0;
        }

        .btn-close {
            filter: invert(1) brightness(.6);
            transition: filter .18s;
        }

        .btn-close:hover { filter: invert(1) brightness(1); }

        .modal-body {
            padding: 1.5rem 1.75rem !important;
        }

        .modal-footer {
            padding: 1rem 1.75rem 1.5rem !important;
            border-top: 1px solid var(--border) !important;
            background: var(--bg-card-2) !important;
        }

        /* ── Form fields ── */
        label {
            display: block;
            font-size: 12px;
            font-family: var(--fh);
            font-weight: 700;
            color: var(--text-2);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 6px;
        }

        .form-control {
            background: var(--bg-input) !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            color: var(--text-1) !important;
            font-family: var(--fb) !important;
            font-size: 14px !important;
            padding: 10px 14px !important;
            transition: border-color .2s, box-shadow .2s !important;
        }

        .form-control::placeholder { color: var(--text-3) !important; }

        .form-control:focus {
            border-color: var(--orange) !important;
            box-shadow: 0 0 0 3px rgba(255,107,0,.15) !important;
            outline: none !important;
        }

        /* ── Checkbox ── */
        .form-check-input {
            background-color: var(--bg-input) !important;
            border-color: var(--border-2) !important;
        }

        .form-check-input:checked {
            background-color: var(--orange) !important;
            border-color: var(--orange) !important;
        }

        .form-check-label {
            color: var(--text-1);
            font-size: 14px;
            font-family: var(--fb);
            text-transform: none;
            letter-spacing: 0;
            font-weight: 400;
        }

        /* ── Modal buttons ── */
        .btn.btn-secondary {
            background: var(--bg-input) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-2) !important;
            font-family: var(--fb) !important;
            border-radius: 10px !important;
            transition: all .18s !important;
        }

        .btn.btn-secondary:hover {
            border-color: var(--border-2) !important;
            color: var(--text-1) !important;
        }

        .btn.btn-primary {
            background: var(--orange) !important;
            border: none !important;
            color: #fff !important;
            font-family: var(--fh) !important;
            font-weight: 700 !important;
            border-radius: 10px !important;
            transition: background .2s, box-shadow .2s !important;
        }

        .btn.btn-primary:hover {
            background: var(--orange-lt) !important;
            box-shadow: 0 0 18px rgba(255,107,0,.3) !important;
        }

        .btn.btn-warning {
            background: var(--orange) !important;
            border: none !important;
            color: #fff !important;
            font-family: var(--fh) !important;
            font-weight: 700 !important;
            border-radius: 10px !important;
            transition: background .2s, box-shadow .2s !important;
        }

        .btn.btn-warning:hover {
            background: var(--orange-lt) !important;
            box-shadow: 0 0 18px rgba(255,107,0,.3) !important;
        }
    </style>

</head>

<body>

@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">

        <div>
            <h2 style="font-family: var(--fh); font-weight:800; font-size:28px;">
                Gestion Catégories
            </h2>

            <p style="color: var(--text-2); font-size:14px;">
                Gérez toutes les catégories de votre boutique
            </p>
        </div>

        <button class="btn-o" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-plus-lg"></i>
            Ajouter Catégorie
        </button>

    </div>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="table-card">

        <div class="t-head">

            <div>
                <div class="c-title">Liste des Catégories</div>
            </div>

        </div>


        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Produits</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>


                        </td>

                        <td>
                            <strong>{{ $category->nom }}</strong>
                        </td>

                        <td>
                            {{ $category->slug }}
                        </td>

                        <td>
                            {{ $category->produits->count() }} produit(s)
                        </td>

                        <td>
                            @if($category->actif)
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-danger">Inactif</span>
                            @endif
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <button
                                    class="ib editBtn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal"

                                    data-id="{{ $category->id }}"
                                    data-nom="{{ $category->nom }}"
                                    data-slug="{{ $category->slug }}"
                                    data-description="{{ $category->description }}"
                                    data-actif="{{ $category->actif }}"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>


                                <form
                                    action="{{ route('categories.destroy', $category->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="ib">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Aucune catégorie trouvée
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>



    <!-- ADD CATEGORY -->
    <form
        action="{{ route('categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="modal fade" id="addCategoryModal" tabindex="-1">

            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content" style="border-radius:20px;">

                    <div class="modal-header border-0">

                        <div>
                            <h4>Ajouter Catégorie</h4>
                            <p class="text-muted">Créer une nouvelle catégorie</p>
                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Nom</label>
                                <input
                                    type="text"
                                    name="nom"
                                    class="form-control"
                                    required
                                >
                            </div>


                            <div class="col-md-6">
                                <label>Slug</label>
                                <input
                                    type="text"
                                    name="slug"
                                    class="form-control"
                                >
                            </div>


                            <div class="col-12">
                                <label>Description</label>

                                <textarea
                                    name="description"
                                    rows="4"
                                    class="form-control"
                                ></textarea>
                            </div>


                            <div class="col-md-6">
                                <label>Image</label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                >
                            </div>


                            <div class="col-md-6 d-flex align-items-center">

                                <div class="form-check mt-4">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="actif"
                                        value="1"
                                        checked
                                    >

                                    <label class="form-check-label">
                                        Catégorie active
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer border-0">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Annuler
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Ajouter
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>



    <!-- EDIT CATEGORY -->
    <form
        id="editForm"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="modal fade" id="editCategoryModal" tabindex="-1">

            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content" style="border-radius:20px;">

                    <div class="modal-header border-0">

                        <div>
                            <h4>Modifier Catégorie</h4>
                            <p class="text-muted">Mettre à jour la catégorie</p>
                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Nom</label>

                                <input
                                    type="text"
                                    name="nom"
                                    id="edit_nom"
                                    class="form-control"
                                >
                            </div>


                            <div class="col-md-6">
                                <label>Slug</label>

                                <input
                                    type="text"
                                    name="slug"
                                    id="edit_slug"
                                    class="form-control"
                                >
                            </div>


                            <div class="col-12">
                                <label>Description</label>

                                <textarea
                                    name="description"
                                    id="edit_description"
                                    rows="4"
                                    class="form-control"
                                ></textarea>
                            </div>


                            <div class="col-md-6">
                                <label>Image</label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                >
                            </div>


                            <div class="col-md-6 d-flex align-items-center">

                                <div class="form-check mt-4">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="actif"
                                        id="edit_actif"
                                        value="1"
                                    >

                                    <label class="form-check-label">
                                        Catégorie active
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer border-0">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Annuler
                        </button>

                        <button type="submit" class="btn btn-warning">
                            Modifier
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>


    <script>

        const editButtons = document.querySelectorAll('.editBtn');

        editButtons.forEach(button => {

            button.addEventListener('click', function () {

                const id = this.dataset.id;
                const nom = this.dataset.nom;
                const slug = this.dataset.slug;
                const description = this.dataset.description;
                const actif = this.dataset.actif;

                document.getElementById('edit_nom').value = nom;
                document.getElementById('edit_slug').value = slug;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_actif').checked = actif == 1;

                document.getElementById('editForm').action =
                    `/dash/categories/${id}`;
            });

        });

    </script>

@endsection

</body>
</html>
