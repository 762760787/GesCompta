<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SuiviBudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    public function listeCompte()
    {
        $users = User::all();
        //dd($users);
        return view('Auth.listing', compact('users'));
    }

    public function edituser(User $user)
    {
        //dd($user);
        return view('Auth.edit', compact('user'));
    }

    public function updateuser(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Le mot de passe est facultatif
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Récupérer l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Mettre à jour les champs
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Mettre à jour le mot de passe si fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Enregistrer les modifications
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('listeCompte')->with('success', 'Utilisateur mis à jour avec succès.');
    }


    public function destroyuser(User $user)
    {
        $user->delete();

        return redirect()->route('listeCompte')->with('success', 'Utilisateur supprimé avec succès.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Le champ nom est obligatoire.',
            'name.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->Route('listeCompte')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
    }

    /**
     * Display the specified resource.
     */
    public function handleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentification réussie
            $request->session()->regenerate();

            return redirect()->intended('/accueil'); // Redirige vers le tableau de bord
        }

        // Authentification échouée
        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies sont incorrectes.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}
