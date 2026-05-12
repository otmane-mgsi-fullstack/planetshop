<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashIndexController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. KPIs GLOBAUX
        // ==========================================
        $totalRevenue = Order::where('statut_commande', 'livré')->sum('montant_total');
        $pendingOrders = Order::where('statut_commande', 'en attente')->count();
        $totalClients = Client::count();
        $totalProducts = Product::count();

        // ==========================================
        // 2. DONNÉES DU GRAPHIQUE (REVENUS 12 MOIS)
        // ==========================================
        $revenueChartLabels = [];
        $revenueChartData = [];

        // On remonte 11 mois en arrière jusqu'au mois actuel (12 mois au total)
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            // Format du mois (ex: "Jan 2025")
            $monthName = $date->translatedFormat('M Y');

            // Somme des commandes livrées pour ce mois-là
            $sum = Order::whereRaw('LOWER(statut_commande) = ?', ['livré'])
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('montant_total');

            $revenueChartLabels[] = ucfirst($monthName);
            $revenueChartData[] = $sum;
        }

        // ==========================================
        // 3. DONNÉES DU GRAPHIQUE (STATUTS COMMANDES)
        // ==========================================
        // On récupère le compte de chaque statut en ignorant la casse
        $statusCounts = Order::select(DB::raw('LOWER(statut_commande) as statut'), DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->pluck('total', 'statut')
            ->toArray();

        $statusChartData = [
            $statusCounts['en attente'] ?? 0,
            $statusCounts['en transit'] ?? 0,
            $statusCounts['livré'] ?? 0,
            $statusCounts['annulé'] ?? 0
        ];

        // ==========================================
        // 4. DERNIÈRES COMMANDES
        // ==========================================
        $recentOrders = Order::with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalRevenue',
            'pendingOrders',
            'totalClients',
            'totalProducts',
            'revenueChartLabels',
            'revenueChartData',
            'statusChartData',
            'recentOrders'
        ));
    }
}
