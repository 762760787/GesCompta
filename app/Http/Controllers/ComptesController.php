<?php

namespace App\Http\Controllers;
use App\Models\Budgets;
use App\Models\comptes;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatecomptesRequest;

class ComptesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comptes = comptes::all();
        //dd($budgets);
        return view('pages/Accounts.Addaccount', compact('comptes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'solde' => 'required|numeric',
            'numero' => 'required|string',
        ]);

        // Récupérer le budget global
        $budgetGlobal = Budgets::first()->montant;

        // Calculer la somme des soldes initiaux existants
        $sommeSoldesExistants = Comptes::sum('solde');

        // Vérifier si le nouveau solde initial dépasse le budget global
        if ($validatedData['solde'] > $budgetGlobal) {
            return redirect()->back()->with('error', 'Le solde initial de ce compte dépasse le budget global.');
        }

        // Vérifier si la somme totale des soldes dépasse le budget global
        if (($sommeSoldesExistants + $validatedData['solde']) > $budgetGlobal) {
            return redirect()->back()->with('error', 'La somme totale des soldes initiaux dépasse le budget global.');
        }

        Comptes::create([
            'type' => $validatedData['type'],
            'nom' => $validatedData['nom'],
            'solde' => $validatedData['solde'],
            'numero' => $validatedData['numero'],
            'idbudget' => 1, // Assurez-vous d'avoir un budget par défaut ou de gérer cela correctement
        ]);

        return redirect()->back()->with('success', 'Compte ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(comptes $comptes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comptes $compte)
    {
        return view('pages/Accounts.editAccount', compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $compte = Comptes::findOrFail($id);

        $validatedData=$request->validate([
            'type' => 'required|string',
            'nom' => 'required|string',
            'solde' => 'required|numeric',
            'numero' => 'required|string',
        ]);

        // Récupérer le budget global
        $budgetGlobal = Budgets::first()->montant;

        // Calculer la somme des soldes initiaux existants (en excluant le compte en cours de modification)
        $sommeSoldesExistants = Comptes::sum('solde');

        // Vérifier si le nouveau solde initial dépasse le budget global
        if ($validatedData['solde'] > $budgetGlobal) {
            return redirect()->back()->with('error', 'Le solde initial de ce compte dépasse le budget global.');
        }

        // Vérifier si la somme totale des soldes dépasse le budget global
        if (($sommeSoldesExistants + $validatedData['solde']) > $budgetGlobal) {
            return redirect()->back()->with('error', 'La somme totale des soldes initiaux dépasse le budget global.');
        }

        $compte->type = $request->type;
        $compte->nom = $request->nom;
        $compte->solde = $request->solde;
        $compte->numero = $request->numero;
        $compte->save();

        return redirect()->route('comptes.create')->with('success', 'Compte mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $compte = Comptes::findOrFail($id);
        $compte->delete();

        return redirect()->route('comptes.create')->with('success', 'Compte supprimé avec succès.');
    }
}
