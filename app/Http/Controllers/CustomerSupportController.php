<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- Ajoute ça pour vérifier l'existence

class CustomerSupportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sujet'   => 'required|string|max:150',
            'message' => 'required|string|max:2000',
            'nom'     => Auth::check() ? 'nullable' : 'required|string|max:100',
            'email'   => Auth::check() ? 'nullable' : 'required|email|max:150',
        ]);

        $data = [
            'sujet'   => $request->sujet,
            'message' => $request->message,
            'statut'  => 'ouvert',
        ];

        if (Auth::check()) {
            $user = Auth::user();

            // Sécurité : On vérifie si cet ID existe réellement dans la table 'clients'
            $clientExists = DB::table('clients')->where('id', $user->id)->exists();

            if ($clientExists) {
                $data['client_id'] = $user->id;
                $data['nom']       = $user->nom ?? $user->name;
                $data['email']     = $user->email;
            } else {
                // Si l'utilisateur connecté n'est pas un client (ex: un admin connecté sur le même navigateur)
                // On traite sa demande comme un ticket "invité" sans casser la base de données
                $data['client_id'] = null;
                $data['nom']       = $user->nom ?? $user->name ?? $request->nom ?? 'Visiteur';
                $data['email']     = $user->email ?? $request->email;
            }
        } else {
            // Client non connecté
            $data['client_id'] = null;
            $data['nom']       = $request->nom;
            $data['email']     = $request->email;
        }

        // Insertion sécurisée
        CustomerSupport::create($data);

        return back()->with('success_support', 'Votre demande de support a été envoyée avec succès !');
    }
}
