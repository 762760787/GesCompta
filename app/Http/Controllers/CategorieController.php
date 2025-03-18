<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Budgets;
use App\Models\suivi_budgets;
use Illuminate\Http\Request;

class CategorieController extends Controller
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
        $categories = Categorie::all();
        $budgets = Budgets::all(); // Récupérer les budgets pour le tableau
        return view('pages/Categories.categorieFrais', compact('categories', 'budgets'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'montantbudget' => 'required|numeric',
            'type' => 'required|string',
        ]);
    
        // 1. Récupérer le budget global
        $budgetSuivi = suivi_budgets::first(); // Récupère le premier budget disponible
    
        // Vérifier si un budget existe avant d'accéder à 'montant'
        if (!$budgetSuivi) {
            return redirect()->back()->with('error', 'Aucun budget de suivi trouvé. Veuillez d\'abord en créer un.');
        }
    
        $budgetGlobal = $budgetSuivi->montant; // Maintenant, on est sûr que l'objet existe
    
        // 2. Calculer la somme des montants budgétisés existants pour les dépenses
        $sommeMontantsExistants = Categorie::where('type', 'Depense')->sum('montantbudget');
    
        // 3. Vérifier si l'ajout dépasse le budget global
        // if ($validatedData['type'] == 'Depense' && ($sommeMontantsExistants + $validatedData['montantbudget']) > $budgetGlobal) {
        //     return redirect()->back()->with('error', 'Le montant total budgétisé dépasse le budget global.');
        // }
    
        // // 4. Vérifier si le montant de la catégorie dépasse le budget global
        // if ($validatedData['type'] == 'Depense' && $validatedData['montantbudget'] > $budgetGlobal) {
        //     return redirect()->back()->with('error', 'Le montant de cette catégorie dépasse le budget global.');
        // }
    
        // 5. Ajouter la catégorie
        Categorie::create([
            'description' => $validatedData['description'],
            'montantbudget' => $validatedData['montantbudget'],
            'idbudget' => $budgetSuivi->id, // On utilise l'ID du budget réel
            'type' => $validatedData['type'],
        ]);
    
        return redirect()->back()->with('success', 'Catégorie ajoutée avec succès.');
    }
    

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $category)
    {
        return view('pages/Categories.categorieEdit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);

        $request->validate([
            'description' => 'required',
            'montantbudget' => 'required|numeric',
            'type' => 'required',
        ]);

        $category->description = $request->description;
        $category->montantbudget = $request->montantbudget;
        $category->type = $request->type;
        $category->save();

        return redirect()->route('categories.create')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categorie::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }

        // Vérifie si la catégorie est utilisée ailleurs
        if ($category->transaction()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cette catégorie car elle est utilisée.');
        }

        $category->delete();
        return redirect()->route('categories.create')->with('success', 'Catégorie supprimée avec succès.');
    }
}
