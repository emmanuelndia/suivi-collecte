<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonneCollecte;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // ==> SECTION GESTION DES PERSONNES COLLECTEES <== //

    // Page d'accueil admin : afficher 10 personnes et quelques utilisateurs
    public function index()
    {
        $user = Auth::user();
        $personnecollecte = PersonneCollecte::latest()->take(10)->get();
        $users = User::latest()->take(10)->get();

        $totalCollectes = PersonneCollecte::count();
        $totalUsers = User::count();

        return view('admin.index', compact('personnecollecte', 'users', 'totalCollectes', 'totalUsers'));
    }

    // Liste complète avec pagination
    public function allCollected(Request $request)
    {

        $query = PersonneCollecte::query();

        if ($request->has('query') && $request->query('query') != '') {
            $search = $request->query('query');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                ->orWhere('prenom', 'like', "%{$search}%")
                ->orWhere('contact', 'like', "%{$search}%")
                ->orWhere('lieu_residence', 'like', "%{$search}%")
                ->orWhere('lieu_vote', 'like', "%{$search}%");
            });
        }

        $personnecollecte = $query->orderBy('created_at', 'desc')->paginate(10); // pagine par 20, tu peux changer

        return view('admin.tous-les-collectes', compact('personnecollecte'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $collectes = PersonneCollecte::query()
            ->where('nom', 'like', "%{$query}%")
            ->orWhere('prenom', 'like', "%{$query}%")
            ->orWhere('contact', 'like', "%{$query}%")
            ->orWhere('lieu_residence', 'like', "%{$query}%")
            ->orWhere('lieu_vote', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('partials.admin-collecte-rows', ['personnecollecte' => $collectes]);
    }

    // ==> SECTION GESTION DES UTILISATEURS <== //

    // Liste complète des utilisateurs avec pagination
    public function usersList()
    {
        \Log::info('usersList called');
    $users = User::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.tous-les-utilisateurs', compact('users'));
    }

    // Enregistrer un nouvel utilisateur (depuis formulaire modal)
    public function storeUser(Request $request)
{
    \Log::info('storeUser called');
    \Log::info('Data reçue:', $request->all());

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'login' => 'required|string|unique:users,login',
        'email' => 'nullable|email|unique:users,email',
        'role' => 'required|in:admin,user',
        'password' => 'required|string|min:6|confirmed',
    ]);

    /* $validated['password'] = \Hash::make($validated['password']); */
    $validated['is_admin'] = $validated['role'] === 'admin' ? 1 : 0;

    $user = User::create($validated);


    return redirect()->route('admin.tous-les-utilisateurs')->with('success_message', 'Utilisateur ajouté avec succès.');
}


     // Mettre à jour un utilisateur
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // ne pas modifier le mot de passe s'il est vide
        }

        $user->update($validated);

        return redirect()->route('admin.tous-les-utilisateurs')->with('success_message', 'Utilisateur modifié avec succès.');
    }

    // Supprimer un utilisateur
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.tous-les-utilisateurs')->with('success_message', 'Utilisateur supprimé avec succès.');
    }

    public function searchUsers(Request $request)
    {
        $query = $request->get('query');

        $users = User::where('nom', 'like', "%{$query}%")
            ->orWhere('prenom', 'like', "%{$query}%")
            ->orWhere('login', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('partials.utilisateur-rows', compact('users'));
    }

}
