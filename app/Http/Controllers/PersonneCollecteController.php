<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonneCollecte;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

class PersonneCollecteController extends Controller
{
    // Enregistrer personne collecté avec api
    public function store(Request $request){
        try {
            // Validation des champs obligatoires uniquement
            $validated = $request->validate([
                'user_id' => 'required',
                'nom' => 'required',
                'prenom' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'lieu_residence' => 'required',
                'lieu_vote' => 'required',
            ]);

            /* // Ajouter les champs facultatifs avec valeurs par défaut
            $validated['date_naissance'] = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['date_naissance'])->format('Y-m-d');
            $validated['operation'] = $request->input('operation', 'non renseigné');
            $validated['poste'] = $request->input('poste', 'non renseigné');
            $validated['niveau_etude'] = $request->input('niveau_etude', 'non renseigné');
            $validated['info'] = $request->input('info', 'non renseigné');
            $validated['region_aff'] = $request->input('region_aff', '0');
            $validated['dep_aff'] = $request->input('dep_aff', '0');
            $validated['sp_aff'] = $request->input('sp_aff', '0');
            $validated['commune_aff'] = $request->input('commune_aff', '0');
            $validated['centre_aff'] = $request->input('centre_aff', '0');
            $validated['statut'] = 'En attente'; // Par exemple */

            $personnecollecte = PersonneCollecte::create($validated);

            return response()->json([
                "status" => 200,
                "message" => 'Personne collectée enregistrée avec succès',
                "Personne Collecte" => $personnecollecte,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur lors de l\'enregistrement',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    // Enregistrer une personne collectée avec le formulaire
    public function storeFromForm(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'contact' => 'required',
                'email' => 'nullable|email',
                'lieu_residence' => 'required',
                'lieu_vote' => 'required',
            ]);

            // On ajoute l'user_id de l'utilisateur connecté
            $validated['user_id'] = Auth::id();

            PersonneCollecte::create($validated);

            // Redirection selon le rôle
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.allcollected')->with('success_message', 'Personne collectée ajoutée avec succès.');
            }

            return redirect()->route('user.mes-collectes')->with('success_message', 'Personne collectée ajoutée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement');
        }
    }


    // Modifier une personne enregistrée
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'contact' => 'required',
                'email' => 'nullable|email',
                'lieu_residence' => 'required',
                'lieu_vote' => 'required',
            ]);

            $personne = PersonneCollecte::findOrFail($id);
            $personne->update($validated);

             // Redirection selon le rôle
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.allcollected')->with('success_message', 'Personne collectée modifiée avec succès.');
            }

            return redirect()->route('user.mes-collectes')->with('success_message', 'Personne collectée modifiée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
        }
    }

    // Supprimer une personne collecté enregistré
    public function destroy($id)
    {
        try {
            $personne = PersonneCollecte::findOrFail($id);
            $personne->delete();

             // Redirection selon le rôle
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.allcollected')->with('success_message', 'Personne collectée supprimée avec succès.');
            }

            return redirect()->route('user.mes-collectes')->with('success_message', 'Personne collectée supprimée avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression.');
        }
    }

}
