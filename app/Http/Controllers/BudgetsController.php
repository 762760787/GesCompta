<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\Budgets;
use App\Models\Categorie;
use App\Models\suivi_budgets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetsController extends Controller
{
   
    public function index()
{
    // Récupérer le budget (si existe)
    $budget = Budgets::first();
    $budgetInitial = $budget ? $budget->montant : 0;

    // Récupérer le budget provisoire (si existe)
    $budgetprovisoir = suivi_budgets::first();
    $budgetprovisoir = $budgetprovisoir ? $budgetprovisoir->montant_budget : 0;

    // Calculer le total des dépenses (si existent)
    $totalDepenses = Transaction::where('montant', '>', 0)
        ->whereHas('categorie', function ($query) {
            $query->where('type', 'Depense');
        })
        ->sum('montant');

    // Calculer le total des revenus (si existent)
    $totalRevenus = Transaction::where('montant', '>', 0)
        ->whereHas('categorie', function ($query) {
            $query->where('type', 'Revenu');
        })
        ->sum('montant');

    // Calculer le solde actuel (si budget provisoire existe)
    $soldeActuel = $budgetprovisoir + $totalRevenus - $totalDepenses;

    // Calculer le pourcentage des dépenses (si budget provisoire existe et > 0)
    $pourcentageDepenses = ($budgetprovisoir > 0) ? ($totalDepenses / $budgetprovisoir) * 100 : 0;

    // Calculer la somme des budgets des catégories (si existent)
    $sommeBudgetsCat = Categorie::sum('montantbudget');

    // Calculer les budgets pour les catégories de dépenses (si existent)
    $categoriesDepense = Categorie::where('type', 'Depense')->get();

    foreach ($categoriesDepense as $categorie) {
        $categorie->budgetPrevus = $categorie->montantbudget;
        $categorie->budgetDepense = Transaction::where('idcategorie', $categorie->id)->sum('montant');
        $categorie->budgetRestant = $categorie->budgetPrevus - $categorie->budgetDepense;
    }

    // Récupérer les revenus nets (si existent)
    $revenuNet = DB::SELECT("SELECT
                                    transactions.description AS description_transaction,
                                    transactions.montant AS montant_transaction,
                                    transactions.date AS date_transaction,
                                    categories.description AS description_categorie,
                                    categories.montantbudget AS montantbudget
                                FROM 
                                    transactions
                                JOIN 
                                    categories ON transactions.idcategorie = categories.id
                                WHERE
                                    categories.type = 'Revenu'");

    // Calculer les budgets pour les catégories de revenus (si existent)
    $categoriesRevenu = Categorie::where('type', 'Revenu')->get();

    foreach ($categoriesRevenu as $categorie) {
        $categorie->budgetPrevus = $categorie->montantbudget;
        $categorie->budgetRevenu = Transaction::where('idcategorie', $categorie->id)->sum('montant');
        $categorie->budgetRestant = $categorie->budgetPrevus + $categorie->budgetRevenu;
    }

    return view('pages.index', compact(
        'budgetInitial',
        'totalDepenses',
        'totalRevenus',
        'soldeActuel',
        'pourcentageDepenses',
        'sommeBudgetsCat',
        'categoriesDepense',
        'revenuNet',
        'budgetprovisoir'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $budgets = Budgets::all();
        // dd($budgets);
        return view('pages/Budgets.budget', compact('budgets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'datedebut' => 'required|date',
            'datedefin' => 'required|date|after:datedebut',
            'montant' => 'required|numeric',
        ]);
    
        // Créez le budget et récupérez l'instance créée.
        $budget = Budgets::create($validatedData);
    
        // Créez une entrée dans suivi_budgets en utilisant l'ID du budget créé.
        suivi_budgets::create([
            'idbudget' => $budget->id, // Utilisez l'ID du budget créé (sans underscore)
            'montant_budget' => $budget->montant, // Utilisez le montant du budget créé
            // Ajoutez d'autres champs si nécessaire
        ]);
    
        return redirect()->back()->with('success', 'Budget ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Budgets $budgets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budgets $budget)
    {
        //dd($budget);
        return view('pages/Budgets/editBudget', compact('budget')); // Remplacez 'votre_vue' par le nom de votre vue
    }

    public function update(Request $request, Budgets $budget)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'datedebut' => 'required|date',
            'datedefin' => 'required|date|after:datedebut',
            'montant' => 'required|numeric',
        ]);

        $budget->update($validatedData);

        return redirect()->Route('budgets.create')->with('success', 'Budget mis à jour avec succès.');
    }

    public function destroy(Budgets $budget)
    {
        $budget->delete();

        return redirect()->back()->with('success', 'Budget supprimé avec succès.');
    }
}
