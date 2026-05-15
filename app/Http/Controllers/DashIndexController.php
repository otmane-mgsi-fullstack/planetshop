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
            'topProductsLabels',
            'topProductsData',
            'categorySalesLabels',
            'categorySalesData',
            'recentOrders'
        ));
    }
}
