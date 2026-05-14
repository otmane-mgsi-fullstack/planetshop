<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashClientController extends Controller
{

    public function index(Request $request)
    {
        $query = Client::query();



        // Filtrage par Statut
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('actif', 1);
            } elseif ($request->status === 'inactive') {
                $query->where('actif', 0);
            }
        }

        // Récupérer les clients avec compteurs de commandes et sommes
        $clients = $query->withCount('commandes')
            ->withSum('commandes', 'montant_total')
            ->latest()
            ->paginate(10);

        // Statistiques (KPIs)
        $totalClients = Client::count();
        $newClients = Client::whereMonth('created_at', now()->month)->count();
        $activeClients = Client::where('actif', 1)->count();
        $vipClients = Client::withCount('commandes')->having('commandes_count', '>=', 5)->count();

        return view('dashboard.client', compact('clients', 'totalClients', 'newClients', 'activeClients', 'vipClients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'password' => 'required|min:6',
            'actif' => 'nullable'
        ]);

        DB::beginTransaction();

        try {

            // 1. CREATE USER
            $user = User::create([
                'name' => $validated['prenom'] . ' ' . $validated['nom'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'client',
            ]);

            // 2. CREATE CLIENT
            Client::create([
                'user_id' => $user->id,
                'prenom' => $validated['prenom'],
                'nom' => $validated['nom'],
                'telephone' => $validated['telephone'],
                'adresse' => $validated['adresse'],
                'ville' => $validated['ville'],
                'pays' => $validated['pays'],
                'actif' => $request->boolean('actif'),
            ]);

            DB::commit();

            return back()->with('success', 'Client ajouté avec succès.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors([
                'error' => 'Erreur lors de la création : ' . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'actif' => 'boolean'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;

        $client->update($validated);

        return redirect()->back()->with('success', 'Les informations du client ont été mises à jour.');
    }

    public function toggleStatus(Client $client)
    {
        // Inverse le statut actif / inactif
        $client->update(['actif' => !$client->actif]);
        return redirect()->back()->with('success', 'Le statut du client a été modifié.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->back()->with('success', 'Le client a été supprimé.');
    }
}
