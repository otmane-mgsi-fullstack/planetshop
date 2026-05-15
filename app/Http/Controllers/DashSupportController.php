<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSupport; // Vérifie bien le nom de ton Model
use DB;

class DashSupportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Récupération des compteurs pour les KPI
        $stats = DB::table('customers_support')
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN statut = 'ouvert' THEN 1 ELSE 0 END) as ouverts,
                SUM(CASE WHEN statut = 'en_cours' THEN 1 ELSE 0 END) as en_cours,
                SUM(CASE WHEN statut = 'resolu' THEN 1 ELSE 0 END) as resolus
            ")
            ->first();

        // 2. Construction de la requête avec filtres
        $query = CustomerSupport::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('sujet', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // 3. Pagination
        $tickets = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('dashboard.support', [
            'tickets'         => $tickets,
            'totalTickets'    => $stats->total ?? 0,
            'openTickets'     => $stats->ouverts ?? 0,
            'pendingTickets'  => $stats->en_cours ?? 0,
            'resolvedTickets' => $stats->resolus ?? 0
        ]);
    }

    /**
     * Mise à jour du statut du ticket
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:ouvert,en_cours,resolu'
        ]);

        $ticket = CustomerSupport::findOrFail($id);
        $ticket->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut du ticket mis à jour avec succès.');
    }

    /**
     * Supprimer un ticket
     */
    public function destroy($id)
    {
        $ticket = CustomerSupport::findOrFail($id);
        $ticket->delete();

        return back()->with('success', 'Ticket supprimé.');
    }
}
