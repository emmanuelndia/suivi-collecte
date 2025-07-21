<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function login()
    {
        return view('auth.login');
    }

    // Se déconnecter
    public function logout()
    {
        Auth::logout(); // Déconnexion de l'utilisateur

        request()->session()->invalidate(); // Invalider la session
        request()->session()->regenerateToken(); // Régénérer le token CSRF

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }

   public function handleLogin(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            /* dd(Auth::user()); */

            if ($user->is_admin) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('user.index');
            }
        } else {
            return redirect()->back()->with('error_msg', 'Paramètres de connexion invalides');
        }
    }


    // Créer un utilisateur avec un api
    public function store(Request $request){
        try {
            // Validation des champs obligatoires uniquement
            $validated = $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'login' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required'
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

            $user = User::create($validated);

            return response()->json([
                "status" => 200,
                "message" => 'Utilisateur enregistré avec succès',
                "user" => $user,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur lors de l\'enregistrement',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
