<?php

namespace App\Http\Controllers;

use App\Models\transaction;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Carbon\Carbon;
use App\Models\comptes;
use Illuminate\Support\Facades\DB;
use App\Models\suivi_budgets;
use App\Models\Budgets;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $transactionsQuery = DB::table('transactions')
            ->join('comptes', 'comptes.id', '=', 'transactions.idcompte')
            ->join('categories', 'transactions.idcategorie', '=', 'categories.id')
            ->where('categories.type', 'Depense')
            ->select(
                'comptes.nom as nom_compte',
                'comptes.solde as solde_compte',
                'transactions.id as id',
                'transactions.description as description_transaction',
                'transactions.montant as montant_transaction',
                'transactions.date as date_transaction',
                'categories.description as description_categorie'
            );
    
        if ($search) {
            $transactionsQuery->where(function ($query) use ($search) {
                $query->where('transactions.description', 'like', '%' . $search . '%')
                      ->orWhere('comptes.nom', 'like', '%' . $search . '%')
                      ->orWhere('categories.description', 'like', '%' . $search . '%');
            });
        }
    
        $transactions = $transactionsQuery->get();
        
        return view('pages/Transactions.listingTransaction', compact('transactions', 'search'));
    }
    

    public function listeRevenu(Request $request)
    {
        $search = $request->input('search');
    
        $transactionsQuery = DB::table('transactions')
            ->join('categories', 'transactions.idcategorie', '=', 'categories.id')
            ->where('categories.type', 'Revenu')
            ->select(
                'transactions.id as id',
                'transactions.description as description_transaction',
                'transactions.montant as montant_transaction',
                'transactions.date as date_transaction',
                'categories.description as description_categorie'
            );
    
        if ($search) {
            $transactionsQuery->where(function ($query) use ($search) {
                $query->where('transactions.description', 'like', '%' . $search . '%')
                      ->orWhere('categories.description', 'like', '%' . $search . '%');
            });
        }
    
        $transactions = $transactionsQuery->get();
        
        return view('pages/Transactions.listingTransactionRevenu', compact('transactions', 'search'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::where('type', 'Depense')->get();
        $comptes = Comptes::all();
        return view('pages/Transactions.AddTransaction', compact('categories', 'comptes'));
    }

    public function createRevenu()
    {
        $categories = Categorie::where('type', 'Revenu')->get();
        $comptes = Comptes::all();

        return view('pages/Transactions.AddTransactionRevenue', compact('categories', 'comptes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idcategorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'idcompte' => 'required|exists:comptes,id',
        ]);

        // Vérifier si la catégorie existe
        $categorie = Categorie::find($validatedData['idcategorie']);
        if (!$categorie) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }

        // Vérifier si le compte existe
        $compte = Comptes::find($validatedData['idcompte']);
        if (!$compte) {
            return redirect()->back()->with('error', 'Compte non trouvé.');
        }

        // Vérifier si un budget existe
        $budget = Budgets::first(); // Récupérer un budget existant
        if (!$budget) {
            return redirect()->back()->with('error', 'Aucun budget trouvé. Veuillez en créer un avant d’ajouter une transaction.');
        }

        DB::beginTransaction();

        try {
            // Créer la transaction avec l'ID du budget valide
            $transaction = Transaction::create([
                'idcategorie' => $validatedData['idcategorie'],
                'description' => $validatedData['description'],
                'montant' => $validatedData['montant'],
                'date' => $validatedData['date'],
                'idcompte' => $validatedData['idcompte'],
                'idbudget' => $budget->id, // Utiliser un budget valide
            ]);

            // Mettre à jour le solde du compte si c'est une dépense
            if ($categorie->type === 'Depense') {
                if ($compte->solde < $validatedData['montant']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Le solde du compte est insuffisant.');
                }
                $compte->solde -= $validatedData['montant'];
                $compte->save();

                // Mettre à jour le suivi budgétaire
                $suiviBudget = suivi_budgets::where('idbudget', $budget->id)->first();
                if ($suiviBudget) {
                    $suiviBudget->montant_budget -= $validatedData['montant'];
                    $suiviBudget->save();
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Aucun suivi budgétaire trouvé.');
                }
            }

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la transaction : ' . $e->getMessage());
        }
    }


    public function storeRevenu(Request $request)
    {
        $validatedData = $request->validate([
            'idcategorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'montant' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Vérifier si la catégorie existe
        $categorie = Categorie::find($validatedData['idcategorie']);
        if (!$categorie) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }

        // Vérifier si un budget existe
        $budget = Budgets::first(); // Récupérer un budget existant
        if (!$budget) {
            return redirect()->back()->with('error', 'Aucun budget trouvé. Veuillez en créer un avant d’ajouter une transaction.');
        }

        DB::beginTransaction();

        try {
            // Créer la transaction avec l'ID du budget valide
            $transaction = Transaction::create([
                'idcategorie' => $validatedData['idcategorie'],
                'description' => $validatedData['description'],
                'montant' => $validatedData['montant'],
                'date' => $validatedData['date'],
                'idbudget' => $budget->id, // On utilise un budget existant
            ]);

            // Si c'est un revenu, mettre à jour le suivi du budget
            if ($categorie->type === 'Revenu') {
                $suiviBudget = suivi_budgets::where('idbudget', $budget->id)->first();

                if ($suiviBudget) {
                    $suiviBudget->montant_budget += $validatedData['montant'];
                    $suiviBudget->save();
                } else {
                    return redirect()->back()->with('error', 'Aucun suivi de budget trouvé pour ce budget.');
                }
            }

            DB::commit();
            return redirect()->route('transactions.revenu')->with('success', 'Transaction ajoutée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la transaction : ' . $e->getMessage());
        }
    }

    public function edit(Transaction $transaction)
    {
        $categories = Categorie::where('type', 'Depense')->get();
        $comptes = Comptes::all();
        return view('pages/Transactions.editDepense', compact('transaction', 'categories', 'comptes'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'idcategorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'idcompte' => 'required|exists:comptes,id',
        ]);

        $transaction->idcategorie = $request->idcategorie;
        $transaction->description = $request->description;
        $transaction->montant = $request->montant;
        $transaction->date = $request->date;
        $transaction->idcompte = $request->idcompte;
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction supprimée avec succès.');
    }

    //============================================================== Revenus=================================================//
    public function editRevenu(Transaction $transaction)
    {
        $categories = Categorie::where('type', 'Revenu')->get();
        $comptes = Comptes::all();
        return view('pages/Transactions.editRevenu', compact('transaction', 'categories', 'comptes'));
    }

    public function updateRevenu(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'idcategorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'idcompte' => 'required|exists:comptes,id',
        ]);

        $transaction->idcategorie = $request->idcategorie;
        $transaction->description = $request->description;
        $transaction->montant = $request->montant;
        $transaction->date = $request->date;
        $transaction->idcompte = $request->idcompte;
        $transaction->save();

        return redirect()->route('transactions.revenu')->with('success', 'Transaction mise à jour avec succès.');
    }

    public function destroyRevenu($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.revenu')->with('success', 'Transaction supprimée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
}
