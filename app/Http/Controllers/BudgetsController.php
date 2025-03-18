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
        // Récupérer le budget initial (si existe)
        $budget = Budgets::first();
        $budgetInitial = $budget ? $budget->montant : 0;
    
        // Récupérer le budget provisoire (si existe)
        $budgetprovisoir = suivi_budgets::first();
        $budgetprovisoir = $budgetprovisoir ? $budgetprovisoir->montant_budget : 0;
    
        // Calculer le total des dépenses
        $totalDepenses = Transaction::whereHas('categorie', function ($query) {
            $query->where('type', 'Depense');
        })->sum('montant');
    
        // Calculer le total des revenus
        $totalRevenus = Transaction::whereHas('categorie', function ($query) {
            $query->where('type', 'Revenu');
        })->sum('montant');
    
        // Calculer le solde actuel
        $soldeActuel = $budgetprovisoir - $totalDepenses;
    
        // Calculer le pourcentage des dépenses
        $pourcentageDepenses = ($budgetprovisoir > 0) ? ($totalDepenses / $budgetprovisoir) * 100 : 0;
    
        // Calculer les budgets pour les catégories de dépenses
        $categoriesDepense = Categorie::where('type', 'Depense')->get();
    
        foreach ($categoriesDepense as $categorie) {
            $categorie->budgetPrevus = $categorie->montantbudget;
            $categorie->budgetDepense = Transaction::where('idcategorie', $categorie->id)->sum('montant');
            $categorie->budgetRestant = $categorie->budgetPrevus - $categorie->budgetDepense;
        }
    
        // Récupérer les revenus nets (transactions)
        $revenuNet = DB::SELECT("SELECT
                                    transactions.description AS description_transaction,
                                    transactions.montant AS montant_transaction,
                                    transactions.date AS date_transaction,
                                    categories.description AS description_categorie
                                FROM 
                                    transactions
                                JOIN 
                                    categories ON transactions.idcategorie = categories.id
                                WHERE
                                    categories.type = 'Revenu'");
    
        // Regrouper les revenus par description et calculer leur budget prévu + revenu réel
        $categoriesRevenu = Categorie::where('type', 'Revenu')
            ->select('description', DB::raw('SUM(montantbudget) as budgetTotal'))
            ->groupBy('description')
            ->get();
    
        foreach ($categoriesRevenu as $categorie) {
            // Total des revenus pour cette catégorie (toutes les transactions liées)
            $totalRevenu = Transaction::whereHas('categorie', function ($query) use ($categorie) {
                $query->where('description', $categorie->description);
            })->sum('montant');
    
            // Calculer la différence entre le budget prévu et les revenus réels
            $categorie->budgetReel = $totalRevenu;
            $categorie->budgetRestant = $categorie->budgetTotal - $categorie->budgetReel;
        }
    
        return view('pages.index', compact(
            'budgetInitial',
            'totalDepenses',
            'totalRevenus',
            'soldeActuel',
            'pourcentageDepenses',
            'categoriesDepense',
            'revenuNet',
            'budgetprovisoir',
            'categoriesRevenu'
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

        // Mettre à jour le budget
        $budget->update($validatedData);

        // Mettre à jour le suivi du budget si une entrée existe, sinon en créer une
        $suiviBudget = suivi_budgets::where('idbudget', $budget->id)->first();

        if ($suiviBudget) {
            // Mise à jour de l'entrée existante
            $suiviBudget->update([
                'montant_budget' => $budget->montant,
            ]);
        } else {
            // Création d'une nouvelle entrée si elle n'existe pas
            suivi_budgets::create([
                'idbudget' => $budget->id,
                'montant_budget' => $budget->montant,
            ]);
        }

        return redirect()->route('budgets.create')->with('success', 'Budget mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $budget = Budgets::findOrFail($id);

        // Supprimer les enregistrements liés dans suivi_budgets
        suivi_budgets::where('idbudget', $budget->id)->delete();

        // Supprimer le budget
        $budget->delete();

        return redirect()->back()->with('success', 'Budget supprimé avec succès.');
    }
}
