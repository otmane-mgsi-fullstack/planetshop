<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;

use Illuminate\Http\Request;

class DashOrderController extends Controller
{
    public function index(Request $request)
    {
        // On charge la relation client et les articles (avec les produits) pour les détails
        $query = Order::with(['client', 'items.produit']);

        // Recherche par ID de commande, nom ou email du client
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Recherche par ID (ex: 4821)
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('nom_client', 'like', "%{$search}%")
                    ->orWhere('email_client', 'like', "%{$search}%")
                    ->orWhereHas('client', function($cq) use ($search) {
                        $cq->where('prenom', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%");
                    });
            });
        }






        // Filtrage par Statut de la commande
        if ($request->filled('status')) {
            $query->where('statut_commande', $request->status);
        }

        // Filtrage par Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Récupération paginée (10 par page)
        $orders = $query->latest()->paginate(10);

        // Statistiques (KPIs)
        $totalOrders = Order::count();
        $pendingOrders = Order::where('statut_commande', 'en_attente')->count();
        $deliveredOrders = Order::where('statut_commande', 'livree')->count();
        $cancelledOrders = Order::where('statut_commande', 'annulee')->count();

        return view('dashboard.order', compact(
            'orders', 'totalOrders', 'pendingOrders', 'deliveredOrders', 'cancelledOrders'
        ));
    }

    // On ne met pas de fonction store complexe ici, car les commandes sont généralement créées par les clients sur le site.

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'statut_commande' => 'required|string|in:en_attente,confirmee,en_preparation,en_livraison,livree,annulee,retournee',
            'statut_paiement' => 'required|string|in:non_paye,paye,rembourse'
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Le statut de la commande a été mis à jour.');
    }

    public function destroy(Order $order)
    {
        // Supprimer la commande (les OrderItem devraient être supprimés en cascade dans la BDD,
        // ou vous pouvez ajouter $order->items()->delete() avant $order->delete() )
        $order->items()->delete();
        $order->delete();

        return redirect()->back()->with('success', 'La commande a été supprimée avec succès.');
    }


    public function latestNotifications()
    {
        $orders = \App\Models\Order::latest()
            ->take(5)
            ->get(['id', 'nom_client', 'montant_total', 'statut_commande', 'created_at']);

        return response()->json($orders);
    }


    public function exportCsv()
    {
        $fileName = 'orders.csv';

        $orders = Order::all();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($orders) {

            $file = fopen('php://output', 'w');

            // UTF-8 pour Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // HEADER
            fputcsv($file, [
                'ID',
                'Client',
                'Email',
                'Téléphone',
                'Total',
                'Statut Commande',
                'Paiement',
                'Date'
            ], ';');

            // DATA
            foreach ($orders as $order) {

                fputcsv($file, [
                    $order->id,
                    $order->nom_client,
                    $order->email_client,
                    $order->telephone_client,
                    $order->montant_total . ' MAD',
                    $order->statut_commande,
                    $order->statut_paiement,
                    $order->created_at->format('Y-m-d H:i'),
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


}
