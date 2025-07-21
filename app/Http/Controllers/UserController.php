<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonneCollecte;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // ==> Pour utilisateur normal (role = user) <== //
    public function index(){
        $user = Auth::user();
        $totalCollectes = PersonneCollecte::where('user_id', auth()->id())->count();
        
        $personnecollecte = PersonneCollecte::where('user_id', $user->id)
                            ->latest()
                            ->take(10)
                            ->get();
        return view('user.index', compact('personnecollecte', 'totalCollectes'));
    }


    public function mescollectes(Request $request)
    {
        $query = PersonneCollecte::where('user_id', auth()->id());

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

        return view('user.mes-collectes', compact('personnecollecte'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');

        $personnecollecte = PersonneCollecte::where('user_id', $user->id)
            ->where(function ($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                    ->orWhere('prenom', 'like', "%{$query}%")
                    ->orWhere('contact', 'like', "%{$query}%")
                    ->orWhere('lieu_residence', 'like', "%{$query}%")
                    ->orWhere('lieu_vote', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('partials.user-collecte-rows', compact('personnecollecte'))->render();
    }


}
