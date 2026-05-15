@extends('layouts.dashboard')

@section('content')

    <style>
        /* On réutilise tes variables et ton style de base en les adaptant au support */
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
        .kpi-card {
            background: var(--surface); border: 1px solid var(--border); border-radius: var(--r);
            padding: 22px 22px 18px; box-shadow: var(--shadow); position: relative; overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .kpi-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--orange); }
        .kpi-card.blue::before   { background: #4a90e2; }
        .kpi-card.green::before  { background: #10b981; }
        .kpi-card.purple::before { background: #8b5cf6; }

        .kpi-label { font-size: 11.5px; font-weight: 600; color: var(--text-3); text-transform: uppercase; margin-bottom: 8px; }
        .kpi-value { font-family: var(--fh); font-size: 28px; font-weight: 800; color: var(--text-1); line-height: 1; }
        .kpi-icon { position: absolute; top: 18px; right: 18px; width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; font-size: 20px; }

        .kpi-card        .kpi-icon { background: var(--o-dim); color: var(--orange); }
        .kpi-card.blue   .kpi-icon { background: rgba(74,144,226,.12); color: #4a90e2; }
        .kpi-card.purple .kpi-icon { background: rgba(139,92,246,.12); color: #8b5cf6; }
        .kpi-card.green  .kpi-icon { background: rgba(16,185,129,.12); color: #10b981; }

        /* Filtres et Table */
        .filters-bar { display: flex; justify-content: space-between; background: var(--surface); border: 1px solid var(--border); padding: 16px 22px; border-radius: var(--r); margin-bottom: 24px; gap: 16px; }
        .table-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r); overflow: hidden; }
        .cli-table { width: 100%; border-collapse: collapse; }
        .cli-table thead th { background: var(--surface2); color: var(--text-3); font-size: 11px; text-transform: uppercase; padding: 13px 20px; text-align: left; }
        .cli-table tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        .cli-table tbody tr:hover { background: var(--row-hover); }
        .cli-table tbody td { padding: 13px 20px; font-size: 13.5px; color: var(--text-1); }

        /* Statuts Spécifiques Support */
        .status-badge { font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
        .s-open    { background: rgba(239,68,68,.13); color: #ef4444; } /* Ouvert - Rouge */
        .s-pending { background: var(--o-dim); color: var(--orange); }  /* En cours - Orange */
        .s-closed  { background: rgba(16,185,129,.13); color: #10b981; } /* Résolu - Vert */

        .btn-action { width: 32px; height: 32px; border-radius: 8px; background: var(--surface2); border: 1px solid var(--border); display: inline-grid; place-items: center; color: var(--text-2); cursor: pointer; transition: 0.2s; }
        .btn-action:hover { background: var(--o-dim); color: var(--orange); }

        @media (max-width: 768px) { .kpi-grid { grid-template-columns: 1fr; } .filters-bar { flex-direction: column; } }
    </style>

    <!-- KPI SUPPORT -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="bi bi-chat-left-dots-fill"></i></div>
            <div class="kpi-label">Total Tickets</div>
            <div class="kpi-value">{{ $totalTickets ?? 0 }}</div>
        </div>
        <div class="kpi-card purple">
            <div class="kpi-icon"><i class="bi bi-exclamation-circle-fill"></i></div>
            <div class="kpi-label">Ouverts</div>
            <div class="kpi-value">{{ $openTickets ?? 0 }}</div>
        </div>
        <div class="kpi-card blue">
            <div class="kpi-icon"><i class="bi bi-hourglass-split"></i></div>
            <div class="kpi-label">En cours</div>
            <div class="kpi-value">{{ $pendingTickets ?? 0 }}</div>
        </div>
        <div class="kpi-card green">
            <div class="kpi-icon"><i class="bi bi-check-all"></i></div>
            <div class="kpi-label">Résolus</div>
            <div class="kpi-value">{{ $resolvedTickets ?? 0 }}</div>
        </div>
    </div>

    <!-- FILTRES -->
    <form action="{{ route('dash.support') }}" method="GET" class="filters-bar">
        <div class="d-flex gap-3 align-items-center">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un message ou email..." value="{{ request('search') }}" style="width:300px;">
            <select name="statut" class="form-select" style="width:180px;">
                <option value="">Tous les statuts</option>
                <option value="ouvert" {{ request('statut') == 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="resolu" {{ request('statut') == 'resolu' ? 'selected' : '' }}>Résolu</option>
            </select>
            <button type="submit" class="btn-action" style="width: 45px; height: 38px;"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <!-- TABLE DES TICKETS -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="cli-table">
                <thead>
                <tr>
                    <th>Client</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $ticket->nom }}</div>
                            <div style="font-size: 11px; color: var(--text-3);">{{ $ticket->email }}</div>
                        </td>
                        <td><span class="badge bg-light text-dark" style="font-weight: 500;">{{ $ticket->sujet }}</span></td>
                        <td style="max-width: 250px;" class="text-truncate">
                            {{ $ticket->message }}
                        </td>
                        <td>
                            @if($ticket->statut == 'ouvert')
                                <span class="status-badge s-open">Ouvert</span>
                            @elseif($ticket->statut == 'en_cours')
                                <span class="status-badge s-pending">En cours</span>
                            @else
                                <span class="status-badge s-closed">Résolu</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 12px;">{{ $ticket->created_at }}</div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-action" data-bs-toggle="modal" data-bs-target="#viewTicket{{ $ticket->id }}" title="Lire">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action" data-bs-toggle="modal" data-bs-target="#statusTicket{{ $ticket->id }}" title="Changer statut">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL : VOIR LE MESSAGE -->
                    <div class="modal fade" id="viewTicket{{ $ticket->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Détails du message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>De :</strong> {{ $ticket->nom }} ({{ $ticket->email }})</p>
                                    <p><strong>Sujet :</strong> {{ $ticket->sujet }}</p>
                                    <hr>
                                    <p style="white-space: pre-line;">{{ $ticket->message }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="mailto:{{ $ticket->email }}?subject=RE: {{ $ticket->sujet }}" class="btn-orange text-white text-decoration-none px-3 py-2 rounded">
                                        <i class="bi bi-reply"></i> Répondre par Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Aucun ticket de support trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $tickets->links() }}
        </div>
    </div>

@endsection
