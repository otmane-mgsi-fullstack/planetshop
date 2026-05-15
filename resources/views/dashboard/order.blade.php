<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ShopAdmin — Gestion des Commandes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Google Fonts: Syne + DM Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet"/>

    <style>
        /* ─── VARIABLES ─────────────────────────────────────────── */
        :root {
            --orange:    #ff6b00;
            --orange-lt: #ff8c33;
            --orange-xs: rgba(255,107,0,.10);
            --bg:        #eef1f8;
            --slate:     #5a6880;
            --slate-dk:  #3d4a5f;
            --sidebar-w: 260px;
            --white:     #ffffff;
            --card-r:    16px;
            --shadow:    0 4px 24px rgba(90,104,128,.10);
            --shadow-sm: 0 2px 10px rgba(90,104,128,.08);
            --font-h:    'Syne', sans-serif;
            --font-b:    'DM Sans', sans-serif;
        }

        /* ─── RESET ──────────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-b);
            background: var(--bg);
            color: var(--slate-dk);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

        /* ─── CONTENT ────────────────────────────────────────────── */
        .content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ─── KPI CARDS ──────────────────────────────────────────── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .kpi-card {
            background: var(--white);
            border-radius: var(--card-r);
            padding: 22px 22px 18px;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
        .kpi-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--orange);
            border-radius: 16px 16px 0 0;
        }
        .kpi-card.blue::before  { background: #4a90e2; }
        .kpi-card.green::before { background: #27ae60; }
        .kpi-card.danger::before{ background: #e74c3c; }
        .kpi-label { font-size: 11.5px; font-weight: 600; color: #b0b9cc; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 8px; }
        .kpi-value { font-family: var(--font-h); font-size: 28px; font-weight: 800; color: var(--slate-dk); line-height: 1; margin-bottom: 10px; }
        .kpi-icon {
            position: absolute; top: 18px; right: 18px;
            width: 42px; height: 42px;
            border-radius: 12px;
            display: grid; place-items: center;
            font-size: 20px;
        }
        .kpi-card       .kpi-icon { background: var(--orange-xs); color: var(--orange); }
        .kpi-card.blue  .kpi-icon { background: rgba(74,144,226,.10); color: #4a90e2; }
        .kpi-card.green .kpi-icon { background: rgba(39,174,96,.10);  color: #27ae60; }
        .kpi-card.danger .kpi-icon { background: rgba(231,76,60,.10); color: #e74c3c; }

        /* ─── FILTERS BAR ────────────────────────────────────────── */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--white);
            padding: 16px 22px;
            border-radius: var(--card-r);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }
        .filters-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .form-select, .form-control {
            font-size: 13px;
            font-family: var(--font-b);
            color: var(--slate-dk);
            border: 1px solid #e2e6f0;
            border-radius: 10px;
            padding: 8px 12px;
            background-color: var(--bg);
            box-shadow: none;
        }
        .form-select:focus, .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 2px var(--orange-xs);
        }
        .btn-orange {
            background: var(--orange);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 12.5px;
            font-weight: 600;
            font-family: var(--font-b);
            cursor: pointer;
            display: flex; align-items: center; gap: 6px;
            transition: background .2s, box-shadow .2s;
        }
        .btn-orange:hover { background: var(--orange-lt); box-shadow: 0 4px 14px rgba(255,107,0,.3); color: #fff; }
        .btn-outline {
            background: transparent;
            color: var(--slate);
            border: 1px solid #e2e6f0;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            display: flex; align-items: center; gap: 6px;
            transition: all .2s;
        }
        .btn-outline:hover { background: var(--bg); color: var(--slate-dk); }

        /* ─── TABLE ──────────────────────────────────────────────── */
        .table-card {
            background: var(--white);
            border-radius: var(--card-r);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 24px;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--bg);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #b0b9cc;
            padding: 14px 22px;
            text-align: left;
        }
        tbody tr { border-bottom: 1px solid #f5f6fa; transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #fafbff; }
        tbody td { padding: 14px 22px; font-size: 13.5px; color: var(--slate-dk); vertical-align: middle; }

        .avatar-sm {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--orange);
            color: #fff; font-size: 12px; font-weight: 700; font-family: var(--font-h);
            display: inline-grid; place-items: center;
            flex-shrink: 0;
            text-transform: uppercase;
        }
        .avatar-sm.blue   { background: #4a90e2; }
        .avatar-sm.green  { background: #27ae60; }
        .avatar-sm.purple { background: #8e44ad; }
        .avatar-sm.teal   { background: #16a085; }

        .status-badge {
            font-size: 11px; font-weight: 600;
            padding: 4px 12px; border-radius: 20px;
            display: inline-block;
        }
        .s-success { background: rgba(39,174,96,.12); color: #27ae60; }
        .s-warn    { background: rgba(255,107,0,.12);  color: var(--orange); }
        .s-info    { background: rgba(74,144,226,.12); color: #4a90e2; }
        .s-danger  { background: rgba(231,76,60,.12);  color: #e74c3c; }

        .action-btns {
            display: flex; gap: 8px;
        }
        .btn-action {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--bg);
            border: none;
            display: inline-grid; place-items: center;
            color: var(--slate);
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
        }
        .btn-action:hover { background: var(--orange-xs); color: var(--orange); }
        .btn-action.delete:hover { background: rgba(231,76,60,.10); color: #e74c3c; }

        /* ─── PAGINATION ─────────────────────────────────────────── */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 22px;
            background: #fff;
            border-top: 1px solid #f5f6fa;
        }

        /* ─── MODAL CUSTOMIZATION ────────────────────────────────── */
        .modal-content {
            border: none;
            border-radius: var(--card-r);
            box-shadow: 0 10px 40px rgba(90,104,128,.15);
        }
        .modal-header {
            border-bottom: 1px solid #f0f2f7;
            padding: 20px 24px;
        }
        .modal-title {
            font-family: var(--font-h);
            font-size: 18px;
            font-weight: 700;
        }
        .modal-body {
            padding: 24px;
        }
        .modal-footer {
            border-top: 1px solid #f0f2f7;
            padding: 16px 24px;
        }
        .order-detail-card {
            background: var(--bg);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .order-detail-label {
            font-size: 11px;
            color: #b0b9cc;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .order-detail-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--slate-dk);
        }

        /* ─── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 1200px) {
            .kpi-grid { grid-template-columns: repeat(2,1fr); }
        }
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar { transform: translateX(-260px); }
            .kpi-grid { grid-template-columns: 1fr; }
            .content { padding: 18px 16px; }
            .topbar { padding: 0 16px; }
            .filters-bar { flex-direction: column; align-items: stretch; }
            .filters-group { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>

@extends('layouts.dashboard')

@section('content')

    <!-- CONTENT -->
    <div class="content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Erreur lors de la mise à jour.
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- KPI CARDS -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon"><i class="bi bi-receipt"></i></div>
                <div class="kpi-label">Total Commandes</div>
                <div class="kpi-value">{{ $totalOrders ?? 0 }}</div>
            </div>
            <div class="kpi-card blue">
                <div class="kpi-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="kpi-label">En Attente</div>
                <div class="kpi-value">{{ $pendingOrders ?? 0 }}</div>
            </div>
            <div class="kpi-card green">
                <div class="kpi-icon"><i class="bi bi-check-circle"></i></div>
                <div class="kpi-label">Livrées</div>
                <div class="kpi-value">{{ $deliveredOrders ?? 0 }}</div>
            </div>
            <div class="kpi-card danger">
                <div class="kpi-icon"><i class="bi bi-x-circle"></i></div>
                <div class="kpi-label">Annulées</div>
                <div class="kpi-value">{{ $cancelledOrders ?? 0 }}</div>
            </div>
        </div>

        <!-- FILTERS -->
        <form action="{{ route('dash.order') }}" method="GET" class="filters-bar">
            <div class="filters-group">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" name="search" class="form-control ps-5" placeholder="N° commande, client..." value="{{ request('search') }}" style="width: 220px;">
                </div>
                <select name="status" class="form-select" style="width: 150px;">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmee" {{ request('status') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                    <option value="en_preparation" {{ request('status') == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                    <option value="en_livraison" {{ request('status') == 'en_livraison' ? 'selected' : '' }}>En livraison</option>
                    <option value="livree" {{ request('status') == 'livree' ? 'selected' : '' }}>Livrée</option>
                    <option value="annulee" {{ request('status') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    <option value="retournee" {{ request('status') == 'retournee' ? 'selected' : '' }}>Retournée</option>
                </select>
                <input type="date" name="date" class="form-control" style="width: 160px;" value="{{ request('date') }}" />
                <button type="submit" class="btn-outline"><i class="bi bi-funnel"></i> Filtrer</button>
            </div>
            <div class="filters-group">
                <button type="button" class="btn-outline"><i class="bi bi-download"></i> Exporter CSV</button>
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="table-borderless">
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input"></th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($orders) && $orders->count() > 0)
                        @foreach($orders as $order)
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td><strong>#ORD-{{ $order->id }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sm {{ ['purple', 'blue', 'green', 'teal'][rand(0,3)] }}">
                                            {{ substr($order->nom_client ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold" style="font-size: 13.5px;">{{ $order->nom_client ?? 'Client Inconnu' }}</div>
                                            <div class="text-muted" style="font-size: 11px;">{{ $order->email_client ?? '--' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $order->created_at}}<br>
                                    <small class="text-muted">{{ $order->created_at}}</small>
                                </td>
                                <td><strong>{{ number_format($order->montant_total ?? 0, 2, ',', ' ') }} €</strong></td>
                                <td>
                                    @if(strtolower($order->statut_commande) == 'livree')
                                        <span class="status-badge s-success">Livrée</span>
                                    @elseif(in_array(strtolower($order->statut_commande), ['en_livraison', 'en_preparation', 'confirmee']))
                                        <span class="status-badge s-info">{{ ucfirst(str_replace('_', ' ', $order->statut_commande)) }}</span>
                                    @elseif(in_array(strtolower($order->statut_commande), ['annulee', 'retournee']))
                                        <span class="status-badge s-danger">{{ ucfirst(str_replace('_', ' ', $order->statut_commande)) }}</span>
                                    @else
                                        <span class="status-badge s-warn">En attente</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Ajustez l'icône selon la méthode de paiement, ici un exemple basique -->
                                    <i class="bi bi-credit-card text-muted me-1"></i> {{ $order->methode_paiement == 'virement_bancaire' ? 'Virement bancaire' : 'Paiement à la livraison' }}
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="btn-action" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}" title="Voir Détails"><i class="bi bi-eye"></i></button>
                                        <button class="btn-action" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}" title="Modifier Statut"><i class="bi bi-pencil"></i></button>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Supprimer"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Aucune commande trouvée.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->

            {{ $tickets->links('pagination::bootstrap-5') }}

        </div>

    </div><!-- /content -->

    <!-- MODALS -->
    @if(isset($orders))
        @foreach($orders as $order)

            <!-- Modal: ORDER DETAILS -->
            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Détails de la commande #ORD-{{ $order->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="order-detail-card h-100">
                                        <div class="order-detail-label">Informations Client</div>
                                        <div class="order-detail-value mb-2">{{ $order->nom_client ?? 'Inconnu' }}</div>
                                        <div class="text-muted" style="font-size: 13px;"><i class="bi bi-envelope me-2"></i>{{ $order->email_client ?? '--' }}</div>
                                        <div class="text-muted" style="font-size: 13px;"><i class="bi bi-telephone me-2"></i>{{ $order->telephone_client ?? '--' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="order-detail-card h-100">
                                        <div class="order-detail-label">Livraison & Statuts</div>
                                        <div class="order-detail-value mb-2">Adresse de livraison :</div>
                                        <div class="text-muted" style="font-size: 13px; line-height: 1.5;">
                                            {{ $order->adresse_livraison ?? 'Non renseignée' }}
                                        </div>
                                        <hr class="my-2 border-secondary opacity-25">
                                        <div class="d-flex justify-content-between text-muted" style="font-size: 12px;">
                                            <span>Statut : <strong class="text-dark">{{ ucfirst(str_replace('_', ' ', $order->statut_commande)) }}</strong></span>
                                            <span>Paiement : <strong class="text-dark">{{ ucfirst(str_replace('_', ' ', $order->statut_paiement)) }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($order->notes)
                                <div class="alert alert-secondary mt-3 p-2" style="font-size: 13px;">
                                    <strong><i class="bi bi-info-circle me-1"></i> Note Client :</strong> {{ $order->notes }}
                                </div>
                            @endif

                            <h6 class="mt-4 mb-3 fw-bold" style="font-family: var(--font-h);">Articles commandés</h6>
                            <div class="table-responsive">
                                <table class="table" style="font-size: 13px;">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Qté</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($order->items && $order->items->count() > 0)
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold">{{ $item->produit->nom ?? 'Produit #'.$item->produit_id }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ number_format($item->prix_unitaire, 2, ',', ' ') }} €</td>
                                                <td>{{ $item->quantite }}</td>
                                                <td class="text-end fw-semibold">{{ number_format($item->prix_total, 2, ',', ' ') }} €</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="4" class="text-center text-muted">Aucun article trouvé.</td></tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end text-muted">Sous-total :</td>
                                        <td class="text-end">{{ number_format($order->sous_total ?? 0, 2, ',', ' ') }} €</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end text-muted">Livraison :</td>
                                        <td class="text-end">{{ number_format($order->frais_livraison ?? 0, 2, ',', ' ') }} €</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total :</td>
                                        <td class="text-end fw-bold text-primary" style="font-size: 16px;">{{ number_format($order->montant_total ?? 0, 2, ',', ' ') }} €</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-orange" onclick="window.print()"><i class="bi bi-printer me-2"></i>Imprimer Facture</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal: EDIT ORDER STATUS -->
            <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier Statut #ORD-{{ $order->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Statut de la commande</label>
                                    <select name="statut_commande" class="form-select">
                                        <option value="en_attente" {{ strtolower($order->statut_commande) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmee" {{ strtolower($order->statut_commande) == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="en_preparation" {{ strtolower($order->statut_commande) == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                                        <option value="en_livraison" {{ strtolower($order->statut_commande) == 'en_livraison' ? 'selected' : '' }}>En livraison</option>
                                        <option value="livree" {{ strtolower($order->statut_commande) == 'livree' ? 'selected' : '' }}>Livrée</option>
                                        <option value="annulee" {{ strtolower($order->statut_commande) == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                        <option value="retournee" {{ strtolower($order->statut_commande) == 'retournee' ? 'selected' : '' }}>Retournée</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Statut du paiement</label>
                                    <select name="statut_paiement" class="form-select">
                                        <option value="non_paye" {{ strtolower($order->statut_paiement) == 'non_paye' ? 'selected' : '' }}>Non payé</option>
                                        <option value="paye" {{ strtolower($order->statut_paiement) == 'paye' ? 'selected' : '' }}>Payé</option>
                                        <option value="rembourse" {{ strtolower($order->statut_paiement) == 'rembourse' ? 'selected' : '' }}>Remboursé</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-orange">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
