<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Http\Requests\StoretransactionRequest;
use App\Http\Requests\UpdatetransactionRequest;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Carbon\Carbon;
use App\Models\comptes;
use Illuminate\Support\Facades\DB;
use App\Models\suivi_budgets;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = DB::SELECT("SELECT 
                                        comptes.nom AS nom_compte,
                                        comptes.solde AS solde_compte,
                                        transactions.id As id,
                                        transactions.description AS description_transaction,
                                        transactions.montant AS montant_transaction,
                                        transactions.date AS date_transaction,
                                        categories.description AS description_categorie
                                    FROM 
                                        comptes
                                    JOIN 
                                        transactions ON comptes.id = transactions.idcompte
                                    JOIN 
                                        categories ON transactions.idcategorie = categories.id
                                    WHERE
                                        categories.type = 'Depense'");
                                        
       return view('pages/Transactions.listingTransaction', compact('transactions'));
    }

    public function listeRevenu() {
        $transactions = DB::SELECT("SELECT 
                                        transactions.description AS description_transaction,
                                        transactions.montant AS montant_transaction,
                                        transactions.date AS date_transaction,
                                        transactions.id AS id,
                                        categories.description AS description_categorie
                                    FROM 
                                        transactions
                                    JOIN 
                                        categories ON transactions.idcategorie = categories.id
                                    WHERE
                                        categories.type = 'Revenu'");
            // dd($transactions);                            
       return view('pages/Transactions.listingTransactionRevenu', compact('transactions'));
    
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
    
        $transactionDate = Carbon::parse($validatedData['date']);
        $currentDate = Carbon::now()->startOfDay();
        $compte = Comptes::find($validatedData['idcompte']);
        $categorie = Categorie::find($validatedData['idcategorie']); // Récupérer la catégorie
    
        if ($validatedData['montant'] > $compte->solde && $categorie->type === 'Depense') {
            return redirect()->back()->with('error', 'Le montant de la dépense est supérieur au solde du compte.');
        }
    
        if ($transactionDate->lt($currentDate)) {
            return redirect()->back()->with('error', 'La date de la transaction ne peut pas être antérieure à la date actuelle.');
        }
    
        DB::beginTransaction();
    
        $transaction = Transaction::create([
            'idcategorie' => $validatedData['idcategorie'],
            'description' => $validatedData['description'],
            'montant' => $validatedData['montant'],
            'date' => $validatedData['date'],
            'idcompte' => $validatedData['idcompte'],
            'idbudget' => 1,
        ]);
    
        if ($categorie->type === 'Revenu') {
            $suiviBudget = suivi_budgets::where('idbudget', 1)->first();
    
            if ($suiviBudget) {
                $suiviBudget->montant_budget += $validatedData['montant'];
                $suiviBudget->save();
            } else {
                // Gérer le cas où le suivi du budget n'existe pas
            }
        } else {
            $compte->save();
        }
    
        DB::commit();
    
        return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');
    }

    public function storeRevenu(Request $request)
    {
        $validatedData = $request->validate([
            'idcategorie' => 'required|exists:categories,id',
            'description' => 'required|string',
            'montant' => 'required|numeric',
            'date' => 'required|date',
            
        ]);
    
        $transactionDate = Carbon::parse($validatedData['date']);
        $currentDate = Carbon::now()->startOfDay();
        
        $categorie = Categorie::find($validatedData['idcategorie']); // Récupérer la catégorie
    
    
        if ($transactionDate->lt($currentDate)) {
            return redirect()->back()->with('error', 'La date de la transaction ne peut pas être antérieure à la date actuelle.');
        }
    
        DB::beginTransaction();
    
        $transaction = Transaction::create([
            'idcategorie' => $validatedData['idcategorie'],
            'description' => $validatedData['description'],
            'montant' => $validatedData['montant'],
            'date' => $validatedData['date'],
            'idbudget' => 1,
        ]);
    
        if ($categorie->type === 'Revenu') {
            $suiviBudget = suivi_budgets::where('idbudget', 1)->first();
    
            if ($suiviBudget) {
                $suiviBudget->montant_budget += $validatedData['montant'];
                $suiviBudget->save();
            } else {
                // Gérer le cas où le suivi du budget n'existe pas
            }
        } else {
            
        }
    
        DB::commit();
    
        return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');
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

        return redirect()->route('transactions.index')->with('success', 'Transaction supprimée avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    
    
}
