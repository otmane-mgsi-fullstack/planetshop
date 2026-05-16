
@extends('layouts.dashboard')

@section('content')

    <style>
        /* ─── KPI CARDS ─────────────────────────────────────── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .kpi-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 22px 22px 18px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s, background .3s, border-color .3s;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .kpi-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--orange);
            border-radius: 16px 16px 0 0;
        }
        .kpi-card.blue::before   { background: #4a90e2; }
        .kpi-card.green::before  { background: #10b981; }
        .kpi-card.purple::before { background: #8b5cf6; }

        .kpi-label {
            font-size: 11.5px; font-weight: 600;
            color: var(--text-3);
            text-transform: uppercase; letter-spacing: .8px;
            margin-bottom: 8px;
            transition: color .3s;
        }
        .kpi-value {
            font-family: var(--fh);
            font-size: 28px; font-weight: 800;
            color: var(--text-1); line-height: 1; margin-bottom: 10px;
            transition: color .3s;
        }
        .kpi-icon {
            position: absolute; top: 18px; right: 18px;
            width: 42px; height: 42px; border-radius: 12px;
            display: grid; place-items: center; font-size: 20px;
            transition: background .3s, color .3s;
        }
        .kpi-card        .kpi-icon { background: var(--o-dim);           color: var(--orange); }
        .kpi-card.blue   .kpi-icon { background: rgba(74,144,226,.12);   color: #4a90e2; }
        .kpi-card.green  .kpi-icon { background: rgba(16,185,129,.12);   color: #10b981; }
        .kpi-card.purple .kpi-icon { background: rgba(139,92,246,.12);   color: #8b5cf6; }

        /* ─── FILTERS BAR ───────────────────────────────────── */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 16px 22px;
            border-radius: var(--r);
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
            transition: background .3s, border-color .3s;
        }
        .filters-group { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }

        .btn-orange {
            background: var(--orange); color: #fff; border: none;
            border-radius: 10px; padding: 8px 16px;
            font-size: 13px; font-weight: 600; font-family: var(--fb);
            cursor: pointer; display: flex; align-items: center; gap: 6px;
            transition: background .2s, box-shadow .2s;
            text-decoration: none;
        }
        .btn-orange:hover { background: var(--orange-lt); box-shadow: 0 4px 14px rgba(255,107,0,.3); color: #fff; }

        .btn-outline-custom {
            background: transparent;
            color: var(--text-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 13px; font-weight: 600; font-family: var(--fb);
            cursor: pointer;
            display: flex; align-items: center; gap: 6px;
            transition: background .2s, color .2s, border-color .2s;
            text-decoration: none;
        }
        .btn-outline-custom:hover {
            background: var(--o-dim);
            color: var(--orange);
            border-color: var(--orange);
        }

        /* ─── TABLE CARD ────────────────────────────────────── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
            transition: background .3s, border-color .3s;
        }

        .cli-table { width: 100%; border-collapse: collapse; }

        .cli-table thead th {
            background: var(--surface2) !important;
            color: var(--text-3) !important;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            padding: 13px 20px; text-align: left;
            transition: background .3s, color .3s;
        }

        .cli-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s, border-color .3s;
        }
        .cli-table tbody tr:last-child { border-bottom: none; }
        .cli-table tbody tr:hover { background: var(--row-hover); }

        .cli-table tbody td {
            padding: 13px 20px;
            font-size: 13.5px;
            color: var(--text-1);
            vertical-align: middle;
            transition: color .3s;
        }

        .td-sub { font-size: 11px; color: var(--text-3); margin-top: 2px; transition: color .3s; }

        /* Avatars */
        .avatar-sm {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--orange);
            color: #fff; font-size: 13px; font-weight: 700;
            font-family: var(--fh);
            display: inline-grid; place-items: center;
            flex-shrink: 0; text-transform: uppercase;
        }
        .avatar-sm.blue   { background: #4a90e2; }
        .avatar-sm.green  { background: #10b981; }
        .avatar-sm.purple { background: #8b5cf6; }
        .avatar-sm.teal   { background: #14b8a6; }

        /* Count badge */
        .count-badge {
            display: inline-block;
            padding: 3px 10px; border-radius: 8px;
            font-size: 12px; font-weight: 700;
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text-1);
            transition: background .3s, border-color .3s, color .3s;
        }

        /* Status badges */
        .status-badge {
            font-size: 11px; font-weight: 600;
            padding: 4px 12px; border-radius: 20px;
            display: inline-block;
        }
        .s-success { background: rgba(16,185,129,.13); color: #10b981; }
        .s-warn    { background: var(--o-dim);          color: var(--orange); }
        .s-danger  { background: rgba(239,68,68,.13);   color: #ef4444; }

        /* Action buttons */
        .action-btns { display: flex; gap: 8px; }
        .btn-action {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: inline-grid; place-items: center;
            color: var(--text-2); font-size: 14px;
            cursor: pointer;
            transition: background .2s, color .2s, border-color .2s;
        }
        .btn-action:hover        { background: var(--o-dim); color: var(--orange); border-color: transparent; }
        .btn-action.delete:hover { background: rgba(239,68,68,.12); color: #ef4444; border-color: transparent; }
        .btn-action.activate:hover { background: rgba(16,185,129,.12); color: #10b981; border-color: transparent; }

        /* ─── PAGINATION ────────────────────────────────────── */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            transition: border-color .3s;
        }

        /* ─── MODALS ────────────────────────────────────────── */
        .modal-content {
            background: var(--surface) !important;
            border: 1px solid var(--border) !important;
            border-radius: var(--r);
            box-shadow: var(--shadow-lg);
            color: var(--text-1) !important;
        }
        .modal-header {
            background: var(--surface2) !important;
            border-bottom: 1px solid var(--border) !important;
            padding: 20px 24px;
        }
        .modal-title {
            font-family: var(--fh);
            font-size: 17px; font-weight: 700;
            color: var(--text-1) !important;
        }
        .modal-body  { padding: 24px; background: var(--surface) !important; }
        .modal-footer {
            background: var(--surface2) !important;
            border-top: 1px solid var(--border) !important;
            padding: 14px 24px;
            gap: 8px;
        }

        /* Form labels */
        .modal-body .form-label {
            color: var(--text-2);
            font-size: 12.5px; font-weight: 600;
            margin-bottom: 6px;
            transition: color .3s;
        }
        .modal-body .form-check-label {
            color: var(--text-2);
            font-size: 13px;
            transition: color .3s;
        }

        /* Client info card inside modal */
        .client-info-card {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: background .3s, border-color .3s;
        }

        .client-avatar-lg {
            width: 64px; height: 64px; border-radius: 50%;
            background: var(--orange);
            color: #fff; font-size: 24px; font-weight: 700;
            font-family: var(--fh);
            display: inline-grid; place-items: center;
            flex-shrink: 0; text-transform: uppercase;
        }

        .client-name {
            font-family: var(--fh);
            font-size: 18px; font-weight: 700;
            color: var(--text-1); margin-bottom: 6px;
            transition: color .3s;
        }

        .client-stats {
            display: flex;
            gap: 0;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
            transition: border-color .3s;
        }
        .client-stat-item {
            text-align: center;
            flex: 1;
            padding: 0 12px;
        }
        .client-stat-item + .client-stat-item {
            border-left: 1px solid var(--border);
        }
        .client-stat-value {
            font-family: var(--fh);
            font-size: 18px; font-weight: 800;
            color: var(--text-1); margin-bottom: 3px;
            transition: color .3s;
        }
        .client-stat-label {
            font-size: 10.5px; font-weight: 600;
            color: var(--text-3);
            text-transform: uppercase; letter-spacing: .6px;
            transition: color .3s;
        }

        /* Section titles inside modal */
        .modal-section-title {
            font-family: var(--fh);
            font-size: 13px; font-weight: 700;
            color: var(--text-1);
            margin-bottom: 12px;
            display: flex; align-items: center; gap: 8px;
            transition: color .3s;
        }
        .modal-section-title i { color: var(--orange); }

        /* Info list inside modal */
        .info-list { list-style: none; padding: 0; margin: 0 0 20px; }
        .info-list li {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 6px 0;
            font-size: 13.5px;
            color: var(--text-2);
            border-bottom: 1px solid var(--border);
            transition: color .3s, border-color .3s;
        }
        .info-list li:last-child { border-bottom: none; }
        .info-list li i { color: var(--text-3); width: 16px; flex-shrink: 0; margin-top: 2px; }

        /* Empty state inside modal table */
        .modal-empty {
            text-align: center;
            padding: 20px;
            color: var(--text-3);
            font-size: 13px;
            font-style: italic;
        }

        /* Alerts */
        .alert {
            background: var(--surface2) !important;
            border-color: var(--border) !important;
            color: var(--text-1) !important;
            margin-bottom: 20px;
        }
        .alert-success { background: rgba(16,185,129,.10) !important; border-color: rgba(16,185,129,.25) !important; color: #10b981 !important; }
        .alert-danger  { background: rgba(239,68,68,.10)  !important; border-color: rgba(239,68,68,.25)  !important; color: #ef4444 !important; }

        /* VIP badge */
        .vip-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 700;
            background: rgba(234,179,8,.15);
            color: #ca8a04;
            margin-left: 6px;
        }

        /* Contact button */
        .btn-contact {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            border: 1.5px solid var(--border);
            background: transparent;
            color: var(--text-2);
            text-decoration: none;
            transition: all .2s;
        }
        .btn-contact:hover {
            background: var(--o-dim);
            color: var(--orange);
            border-color: var(--orange);
        }

        /* ─── RESPONSIVE ────────────────────────────────────── */
        @media (max-width: 1200px) { .kpi-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 768px)  {
            .kpi-grid { grid-template-columns: 1fr; }
            .filters-bar { flex-direction: column; align-items: stretch; }
            .filters-group { flex-direction: column; align-items: stretch; }
            .client-stats { flex-direction: column; gap: 10px; }
            .client-stat-item + .client-stat-item { border-left: none; border-top: 1px solid var(--border); padding-top: 10px; }
        }
    </style>

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Veuillez vérifier les champs du formulaire :
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- KPI CARDS -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="bi bi-people-fill"></i></div>
            <div class="kpi-label">Total Clients</div>
            <div class="kpi-value">{{ $totalClients ?? 0 }}</div>
        </div>
        <div class="kpi-card green">
            <div class="kpi-icon"><i class="bi bi-person-plus-fill"></i></div>
            <div class="kpi-label">Nouveaux (Ce mois)</div>
            <div class="kpi-value">{{ $newClients ?? 0 }}</div>
        </div>
        <div class="kpi-card blue">
            <div class="kpi-icon"><i class="bi bi-person-check-fill"></i></div>
            <div class="kpi-label">Clients Actifs</div>
            <div class="kpi-value">{{ $activeClients ?? 0 }}</div>
        </div>
        <div class="kpi-card purple">
            <div class="kpi-icon"><i class="bi bi-star-fill"></i></div>
            <div class="kpi-label">Clients VIP</div>
            <div class="kpi-value">{{ $vipClients ?? 0 }}</div>
        </div>
    </div>

    <!-- FILTERS -->
    <form action="{{ route('dash.client') }}" method="GET" class="filters-bar">
        <div class="filters-group">
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"
                   style="color:var(--text-3); font-size:13px;"></i>
                <input type="text" name="search" class="form-control ps-5"
                       placeholder="Rechercher par nom, email…"
                       value="{{ request('search') }}"
                       style="width:250px;">
            </div>
            <select name="status" class="form-select" style="width:160px;">
                <option value="">Tous les statuts</option>
                <option value="active"   {{ request('status')=='active'  ?'selected':'' }}>Actif</option>
                <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactif</option>
            </select>
            <button type="submit" class="btn-outline-custom"><i class="bi bi-funnel"></i> Filtrer</button>
        </div>
        <div class="filters-group">
            <button type="button" class="btn-outline-custom"><i class="bi bi-download"></i> Exporter CSV</button>
            <a href="{{ route('clients.export.csv') }}" class="btn-outline-custom">
                <i class="bi bi-download"></i> Exporter CSV
            </a>
            <button type="button" class="btn-orange"
                    data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="bi bi-person-plus-fill"></i> Ajouter Client
            </button>
        </div>
    </form>

    <!-- TABLE -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="cli-table">
                <thead>
                <tr>
                    <th><input type="checkbox" class="form-check-input"></th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Inscription</th>
                    <th>Commandes</th>
                    <th>Total Dépensé</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($clients) && $clients->count() > 0)
                    @php $colors = ['purple','blue','green','teal']; @endphp
                    @foreach($clients as $i => $client)
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm {{ $colors[$i % 4] }}">
                                        {{ substr($client->prenom, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-size:13.5px; font-weight:600;">
                                            {{ $client->prenom }} {{ $client->nom }}
                                        </div>
                                        <div class="td-sub">#CLI-{{ $client->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $client->email }}</div>
                                <div class="td-sub">{{ $client->telephone ?? 'Non renseigné' }}</div>
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</div>
                                <div class="td-sub">{{ \Carbon\Carbon::parse($client->created_at)->format('H:i') }}</div>
                            </td>
                            <td>
                                <span class="count-badge">{{ $client->commandes_count ?? 0 }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($client->commandes_sum_montant_total ?? 0, 2, ',', ' ') }} MAD</strong>
                            </td>
                            <td>
                                @if($client->actif)
                                    <span class="status-badge s-success">Actif</span>
                                @else
                                    <span class="status-badge s-warn">Inactif</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-action"
                                            data-bs-toggle="modal"
                                            data-bs-target="#clientModal{{ $client->id }}"
                                            title="Voir Profil">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn-action"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editClientModal{{ $client->id }}"
                                            title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('clients.toggle', $client->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn-action {{ $client->actif ? 'delete' : 'activate' }}"
                                                title="{{ $client->actif ? 'Suspendre' : 'Réactiver' }}">
                                            <i class="bi {{ $client->actif ? 'bi-slash-circle' : 'bi-check-circle' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; padding:36px; color:var(--text-3);">
                            Aucun client trouvé.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            @isset($clients)
                {{ $clients->links('pagination::bootstrap-5') }}
            @endisset
        </div>
    </div>

    <!-- ══ MODAL : AJOUTER CLIENT ══ -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nouveau Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Prénom <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="prenom" class="form-control" required value="{{ old('prenom') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nom <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="nom" class="form-control" required value="{{ old('nom') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email <span style="color:#ef4444;">*</span></label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mot de passe <span style="color:#ef4444;">*</span></label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Ville</label>
                                <input type="text" name="ville" class="form-control" value="{{ old('ville') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pays</label>
                                <input type="text" name="pays" class="form-control" value="{{ old('pays', 'Maroc') }}">
                            </div>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" name="actif" value="1" id="actifNew" checked>
                            <label class="form-check-label" for="actifNew">Compte Actif</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn-orange">Créer le client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ══ MODALS : VOIR / MODIFIER CLIENTS ══ -->
    @isset($clients)
        @php $colors = ['purple','blue','green','teal']; @endphp
        @foreach($clients as $i => $client)

            {{-- ── MODAL PROFIL ── --}}
            <div class="modal fade" id="clientModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profil Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Header client -->
                            <div class="client-info-card">
                                <div class="client-avatar-lg {{ $colors[$i % 4] }}" style="background: {{ ['#8b5cf6','#4a90e2','#10b981','#14b8a6'][$i % 4] }}">
                                    {{ substr($client->prenom, 0, 1) }}
                                </div>
                                <div class="flex-grow-1 w-100">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                        <div>
                                            <div class="client-name">
                                                {{ $client->prenom }} {{ $client->nom }}
                                                @if(($client->commandes_count ?? 0) >= 5)
                                                    <span class="vip-badge"><i class="bi bi-star-fill"></i> VIP</span>
                                                @endif
                                            </div>
                                            @if($client->actif)
                                                <span class="status-badge s-success">Compte Actif</span>
                                            @else
                                                <span class="status-badge s-warn">Compte Inactif</span>
                                            @endif
                                        </div>
                                        <a href="mailto:{{ $client->email }}" class="btn-contact">
                                            <i class="bi bi-envelope"></i> Contacter
                                        </a>
                                    </div>

                                    <div class="client-stats">
                                        <div class="client-stat-item">
                                            <div class="client-stat-value">{{ $client->commandes_count ?? 0 }}</div>
                                            <div class="client-stat-label">Commandes</div>
                                        </div>
                                        <div class="client-stat-item">
                                            <div class="client-stat-value">{{ number_format($client->commandes_sum_montant_total ?? 0, 0, ',', ' ') }} MAD</div>
                                            <div class="client-stat-label">Total Dépensé</div>
                                        </div>
                                        <div class="client-stat-item">
                                            @php
                                                $panierMoyen = ($client->commandes_count ?? 0) > 0
                                                    ? ($client->commandes_sum_montant_total / $client->commandes_count)
                                                    : 0;
                                            @endphp
                                            <div class="client-stat-value">{{ number_format($panierMoyen, 0, ',', ' ') }} MAD</div>
                                            <div class="client-stat-label">Panier Moyen</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="modal-section-title">
                                        <i class="bi bi-person-lines-fill"></i> Coordonnées
                                    </div>
                                    <ul class="info-list">
                                        <li><i class="bi bi-envelope"></i> {{ $client->email }}</li>
                                        <li><i class="bi bi-telephone"></i> {{ $client->telephone ?? 'Non renseigné' }}</li>
                                        <li>
                                            <i class="bi bi-geo-alt"></i>
                                            <span>
                                            {{ $client->adresse ?: 'Adresse non renseignée' }}
                                                @if($client->ville) <br>{{ $client->ville }}@endif
                                                @if($client->pays)  <br>{{ $client->pays }}@endif
                                        </span>
                                        </li>
                                        <li><i class="bi bi-calendar3"></i>
                                            Inscrit le {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal-section-title">
                                        <i class="bi bi-clock-history"></i> Dernières commandes
                                    </div>
                                    <div class="modal-empty">
                                        Historique des commandes non affiché dans cette vue.
                                    </div>
                                    <div style="text-align:right;">
                                        <a href="#" style="font-size:12px; color:var(--orange); text-decoration:none; font-weight:600;">
                                            Voir tout l'historique <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn-orange"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editClientModal{{ $client->id }}">
                                <i class="bi bi-pencil"></i> Éditer le profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── MODAL EDIT ── --}}
            <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier — {{ $client->prenom }} {{ $client->nom }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Prénom <span style="color:#ef4444;">*</span></label>
                                        <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nom <span style="color:#ef4444;">*</span></label>
                                        <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control" value="{{ $client->telephone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adresse</label>
                                    <input type="text" name="adresse" class="form-control" value="{{ $client->adresse }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ville</label>
                                        <input type="text" name="ville" class="form-control" value="{{ $client->ville }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pays</label>
                                        <input type="text" name="pays" class="form-control" value="{{ $client->pays }}">
                                    </div>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox"
                                           name="actif" value="1"
                                           id="actifEdit{{ $client->id }}"
                                        {{ $client->actif ? 'checked' : '' }}>
                                    <label class="form-check-label" for="actifEdit{{ $client->id }}">Compte Actif</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn-orange">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    @endisset

@endsection
