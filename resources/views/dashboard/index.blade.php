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
        .kpi-card.purple::before { background: #8b5cf6; }
        .kpi-card.teal::before   { background: #10b981; }

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
            color: var(--text-1);
            line-height: 1; margin-bottom: 10px;
            transition: color .3s;
        }

        .kpi-icon {
            position: absolute; top: 18px; right: 18px;
            width: 42px; height: 42px;
            border-radius: 12px;
            display: grid; place-items: center;
            font-size: 20px;
            transition: background .3s, color .3s;
        }
        .kpi-card        .kpi-icon { background: var(--o-dim);              color: var(--orange); }
        .kpi-card.blue   .kpi-icon { background: rgba(74,144,226,.12);      color: #4a90e2; }
        .kpi-card.purple .kpi-icon { background: rgba(139,92,246,.12);      color: #8b5cf6; }
        .kpi-card.teal   .kpi-icon { background: rgba(16,185,129,.12);      color: #10b981; }

        /* ─── CHARTS GRID ───────────────────────────────────── */
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .chart-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 24px;
            box-shadow: var(--shadow);
            transition: background .3s, border-color .3s;
        }

        .chart-card-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px;
        }

        .chart-card-title {
            font-family: var(--fh);
            font-size: 15px; font-weight: 700;
            color: var(--text-1);
            transition: color .3s;
        }

        .chart-container { position: relative; height: 300px; width: 100%; }

        /* ─── TABLE CARD ────────────────────────────────────── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: background .3s, border-color .3s;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
            transition: border-color .3s;
        }

        .table-title {
            font-family: var(--fh);
            font-size: 15px; font-weight: 700;
            color: var(--text-1);
            transition: color .3s;
        }

        /* Table styles — héritent des variables du layout */
        .idx-table { width: 100%; border-collapse: collapse; }

        .idx-table thead th {
            background: var(--surface2) !important;
            color: var(--text-3) !important;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            padding: 13px 24px; text-align: left;
            transition: background .3s, color .3s;
        }

        .idx-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s, border-color .3s;
        }
        .idx-table tbody tr:last-child { border-bottom: none; }
        .idx-table tbody tr:hover { background: var(--row-hover); }

        .idx-table tbody td {
            padding: 13px 24px;
            font-size: 13.5px;
            color: var(--text-1);
            vertical-align: middle;
            transition: color .3s;
        }

        .td-sub {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 2px;
            transition: color .3s;
        }

        /* Status badges */
        .status-badge {
            font-size: 11px; font-weight: 600;
            padding: 4px 12px; border-radius: 20px;
            display: inline-block;
        }
        .s-success { background: rgba(39,174,96,.13);  color: #27ae60; }
        .s-warn    { background: var(--o-dim);          color: var(--orange); }
        .s-info    { background: rgba(74,144,226,.13);  color: #4a90e2; }
        .s-danger  { background: rgba(231,76,60,.13);   color: #e74c3c; }

        /* Voir tout button */
        .btn-voir {
            font-family: var(--fb);
            font-size: 12px; font-weight: 600;
            padding: 6px 14px; border-radius: 8px;
            border: 1.5px solid var(--border);
            background: transparent;
            color: var(--text-2);
            cursor: pointer;
            transition: background .18s, color .18s, border-color .18s;
            text-decoration: none; display: inline-block;
        }
        .btn-voir:hover {
            background: var(--o-dim);
            color: var(--orange);
            border-color: var(--orange);
        }

        /* ─── RESPONSIVE ────────────────────────────────────── */
        @media (max-width: 1200px) {
            .kpi-grid   { grid-template-columns: repeat(2, 1fr); }
            .chart-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .kpi-grid { grid-template-columns: 1fr; }
        }
    </style>

    <!-- KPI CARDS -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="bi bi-wallet2"></i></div>
            <div class="kpi-label">Chiffre d'Affaires</div>
            <div class="kpi-value">{{ number_format($totalRevenue ?? 0, 2, ',', ' ') }} MAD</div>
        </div>
        <div class="kpi-card blue">
            <div class="kpi-icon"><i class="bi bi-hourglass-split"></i></div>
            <div class="kpi-label">Commandes en attente</div>
            <div class="kpi-value">{{ $pendingOrders ?? 0 }}</div>
        </div>
        <div class="kpi-card purple">
            <div class="kpi-icon"><i class="bi bi-people-fill"></i></div>
            <div class="kpi-label">Total Clients</div>
            <div class="kpi-value">{{ $totalClients ?? 0 }}</div>
        </div>
        <div class="kpi-card teal">
            <div class="kpi-icon"><i class="bi bi-box-seam-fill"></i></div>
            <div class="kpi-label">Produits en base</div>
            <div class="kpi-value">{{ $totalProducts ?? 0 }}</div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="chart-grid">
        <div class="chart-card">
            <div class="chart-card-header">
                <div class="chart-card-title">Évolution des Revenus (12 derniers mois)</div>
            </div>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card-header">
                <div class="chart-card-title">Répartition par Statut</div>
            </div>
            <div class="chart-container">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- RECENT ORDERS TABLE -->
    <div class="table-card">
        <div class="table-header">
            <div class="table-title">Dernières Commandes</div>
            <a href="{{ route('dash.order') }}" class="btn-voir">Voir tout <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="table-responsive">
            <table class="idx-table">
                <thead>
                <tr>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    @foreach($recentOrders as $order)
                        <tr>
                            <td><strong>#ORD-{{ $order->id }}</strong></td>
                            <td>
                                <div class="fw-semibold">{{ $order->nom_client ?? 'Client Inconnu' }}</div>
                                <div class="td-sub">{{ $order->email_client ?? '--' }}</div>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td><strong>{{ number_format($order->montant_total, 2, ',', ' ') }} MAD</strong></td>
                            <td>
                                @if(strtolower($order->statut_commande) == 'livré')
                                    <span class="status-badge s-success">Livré</span>
                                @elseif(strtolower($order->statut_commande) == 'en transit')
                                    <span class="status-badge s-info">En transit</span>
                                @elseif(strtolower($order->statut_commande) == 'annulé')
                                    <span class="status-badge s-danger">Annulé</span>
                                @else
                                    <span class="status-badge s-warn">En attente</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 32px; color: var(--text-3);">
                            Aucune commande récente.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const html = document.documentElement;

            /* Lire une variable CSS du thème actuel */
            function cv(v) {
                return getComputedStyle(html).getPropertyValue(v).trim();
            }

            /* Détecter dark mode */
            function isDark() {
                return html.getAttribute('data-theme') === 'dark';
            }

            /* ── REVENUE CHART (ligne) ─────────────────────── */
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');

            const revenueLabels = {!! json_encode($revenueChartLabels ?? []) !!};
            const revenueData   = {!! json_encode($revenueChartData   ?? []) !!};

            let revenueChart, statusChart;

            function buildRevenueChart() {
                if (revenueChart) revenueChart.destroy();

                const dark = isDark();

                const grad = ctxRevenue.createLinearGradient(0, 0, 0, 300);
                grad.addColorStop(0, dark ? 'rgba(255,107,0,.30)' : 'rgba(255,107,0,.22)');
                grad.addColorStop(1, 'rgba(255,107,0,0)');

                revenueChart = new Chart(ctxRevenue, {
                    type: 'line',
                    data: {
                        labels: revenueLabels,
                        datasets: [{
                            label: "Chiffre d'Affaires",
                            data: revenueData,
                            borderColor: '#ff6b00',
                            backgroundColor: grad,
                            borderWidth: 3,
                            pointBackgroundColor: dark ? '#1a2335' : '#ffffff',
                            pointBorderColor: '#ff6b00',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: dark ? '#1a2335' : '#fff',
                                borderColor:     dark ? '#283044' : '#e5e9f2',
                                borderWidth: 1,
                                titleColor: dark ? '#e8edf7' : '#1a2540',
                                bodyColor:  dark ? '#8a97b0' : '#5a6880',
                                padding: 12,
                                titleFont: { family: 'Syne', size: 13, weight: '700' },
                                bodyFont:  { family: 'DM Sans', size: 13 },
                                callbacks: {
                                    label: ctx => '  ' + ctx.parsed.y.toLocaleString('fr-FR') + ' MAD'
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                border: { display: false },
                                ticks: { font: { family: 'DM Sans' }, color: cv('--text-3') }
                            },
                            y: {
                                grid: { color: cv('--border') },
                                border: { display: false },
                                ticks: {
                                    font: { family: 'DM Sans' },
                                    color: cv('--text-3'),
                                    callback: v => v >= 1000 ? (v/1000) + 'k' : v
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            /* ── STATUS CHART (doughnut) ───────────────────── */
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            const statusData = {!! json_encode($statusChartData ?? [0,0,0,0]) !!};

            function buildStatusChart() {
                if (statusChart) statusChart.destroy();

                const dark = isDark();

                statusChart = new Chart(ctxStatus, {
                    type: 'doughnut',
                    data: {
                        labels: ['En attente', 'En transit', 'Livré', 'Annulé'],
                        datasets: [{
                            data: statusData,
                            backgroundColor: ['#ff6b00', '#4a90e2', '#27ae60', '#e74c3c'],
                            borderWidth: dark ? 2 : 3,
                            borderColor: dark ? '#1a2335' : '#ffffff',
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 18,
                                    font: { family: 'DM Sans', size: 12 },
                                    color: cv('--text-2')
                                }
                            },
                            tooltip: {
                                backgroundColor: dark ? '#1a2335' : '#fff',
                                borderColor:     dark ? '#283044' : '#e5e9f2',
                                borderWidth: 1,
                                titleColor: dark ? '#e8edf7' : '#1a2540',
                                bodyColor:  dark ? '#8a97b0' : '#5a6880',
                                padding: 12,
                                bodyFont: { family: 'DM Sans', size: 13 }
                            }
                        }
                    }
                });
            }

            /* Build initial */
            buildRevenueChart();
            buildStatusChart();

            /* Rebuild quand le thème change (le bouton dispatch un event) */
            document.getElementById('themeBtn')?.addEventListener('click', () => {
                /* Léger délai pour laisser data-theme se mettre à jour */
                setTimeout(() => {
                    buildRevenueChart();
                    buildStatusChart();
                }, 50);
            });

        });
    </script>

@endsection
