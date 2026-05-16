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
        $totalRevenue = Order::where('statut_commande', 'livree')->sum('montant_total');
        $pendingOrders = Order::where('statut_commande', 'en_attente')->count();
        $totalClients = Client::count();
        $totalProducts = Product::count();

        $completedOrdersCount = Order::where('statut_commande', 'livree')->count();
        $panierMoyen = $completedOrdersCount > 0 ? $totalRevenue / $completedOrdersCount : 0;

        // ==========================================
        // 2. DONNÉES DU GRAPHIQUE (TOP 5 PRODUITS)
        // ==========================================
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.produit_id', '=', 'products.id')
            ->join('orders', 'order_items.commande_id', '=', 'orders.id')
            ->where('orders.statut_commande', 'livree')
            ->select('products.nom', DB::raw('SUM(order_items.quantite) as total_vendus'))
            ->groupBy('products.id', 'products.nom')
            ->orderByDesc('total_vendus')
            ->take(5)
            ->get();

        $topProductsLabels = $topProducts->pluck('nom')->toArray();
        $topProductsData = $topProducts->pluck('total_vendus')->toArray();

        // ==========================================
        // 3. DONNÉES DU GRAPHIQUE (VENTES PAR CATÉGORIE)
        // ==========================================
        $categorySales = DB::table('order_items')
            ->join('products', 'order_items.produit_id', '=', 'products.id')
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->join('orders', 'order_items.commande_id', '=', 'orders.id')
            ->where('orders.statut_commande', 'livree')
            ->select('categories.nom', DB::raw('SUM(order_items.prix_total) as chiffre_affaires'))
            ->groupBy('categories.id', 'categories.nom')
            ->orderByDesc('chiffre_affaires')
            ->get();

        $categorySalesLabels = $categorySales->pluck('nom')->toArray();
        $categorySalesData = $categorySales->pluck('chiffre_affaires')->toArray();

        // ==========================================
        // 4. DONNÉES DU GRAPHIQUE (REVENUS 12 MOIS)
        // ==========================================
        $revenueChartLabels = [];
        $revenueChartData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M Y');

            $sum = Order::where('statut_commande', 'livree')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('montant_total');

            $revenueChartLabels[] = ucfirst($monthName);
            $revenueChartData[] = $sum;
        }

        // ==========================================
        // 5. ACQUISITION CLIENTS (6 DERNIERS MOIS)
        // ==========================================
        $clientAcquisitionLabels = [];
        $clientAcquisitionData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M Y');

            $count = Client::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $clientAcquisitionLabels[] = ucfirst($monthName);
            $clientAcquisitionData[] = $count;
        }

        // ==========================================
        // 6. RÉPARTITION DES MÉTHODES DE PAIEMENT
        // ==========================================
        $paymentMethods = Order::select('methode_paiement', DB::raw('count(*) as total'))
            ->groupBy('methode_paiement')
            ->get();

        $paymentMethodLabels = $paymentMethods->pluck('methode_paiement')->map(function ($item) {
            return $item === 'paiement_livraison' ? 'Paiement à la livraison' : 'Virement bancaire';
        })->toArray();
        $paymentMethodData = $paymentMethods->pluck('total')->toArray();

        // ==========================================
        // 7. DERNIÈRES COMMANDES
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
            'panierMoyen',
            'topProductsLabels',
            'topProductsData',
            'categorySalesLabels',
            'categorySalesData',
            'revenueChartLabels',
            'revenueChartData',
            'clientAcquisitionLabels',
            'clientAcquisitionData',
            'paymentMethodLabels',
            'paymentMethodData',
            'recentOrders'
        ));
    }
}
