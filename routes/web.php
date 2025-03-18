<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\ComptesController;
use App\Http\Controllers\SuiviBudgetsController;


Route::middleware(['guest'])->group(function () {
    // Route pour la page de connexion (index) .
    Route::get('/', [SuiviBudgetsController::class, 'index'])->name('login');

    // Route pour la gestion de la connexion (login) via une requête POST.
    Route::post('/login', [SuiviBudgetsController::class, 'handleLogin'])->name('login.handleLogin');

  });


// Groupe de routes protégées par le middleware 'auth', nécessitant une authentification.
Route::middleware(['auth'])->group(function () {
    
    Route::get('/listeCompte', [SuiviBudgetsController::class, 'listeCompte'])->name('listeCompte');

      // Route pour afficher le formulaire d'inscription (register).
    Route::get('/register', [SuiviBudgetsController::class, 'create'])->name('auth.register');
   // Route pour traiter la soumission du formulaire d'inscription via une requête POST.
   Route::post('/register', [SuiviBudgetsController::class, 'store'])->name('register.store');
  
    Route::get('/editUser/{user}', [SuiviBudgetsController::class, 'edituser'])->name('edit.user');

    Route::put('/users/{id}', [SuiviBudgetsController::class, 'updateuser'])->name('users.update');

    Route::delete('/destroyuser/{user}', [SuiviBudgetsController::class, 'destroyuser'])->name('destroy.user');

   
    // Route pour la déconnexion (logout) via une requête POST.
    Route::post('/logout', [SuiviBudgetsController::class, 'logout'])->name('logout');

    // Route pour la page d'accueil après connexion, affichant le dashbord.
    Route::get('/accueil', [BudgetsController::class, 'index']);

    // Route pour afficher le formulaire de création d'un nouveau budget et la liste des budgets.
    Route::get('/create', [BudgetsController::class, 'create'])->name('budgets.create');

    // Route pour traiter la soumission du formulaire de création d'un budget via une requête POST.
    Route::post('/budgets', [BudgetsController::class, 'store'])->name('budgets.store');

    // Route pour afficher le formulaire de modification d'un budget spécifique.
    Route::get('/budgets/{budget}/edit', [BudgetsController::class, 'edit'])->name('budgets.edit');

    // Route pour traiter la mise à jour d'un budget spécifique via une requête PUT.
    Route::put('/budgets/{budget}', [BudgetsController::class, 'update'])->name('budgets.update');

    // Route pour supprimer un budget spécifique via une requête DELETE.
    Route::delete('/budgets/{budget}', [BudgetsController::class, 'destroy'])->name('budgets.destroy');

    // Route pour afficher le formulaire de création d'un nouveau compte.
    Route::get('/comptes', [ComptesController::class, 'create'])->name('comptes.create');

    // Route pour traiter la soumission du formulaire de création d'un compte via une requête POST.
    Route::post('/comptes', [ComptesController::class, 'store'])->name('comptes.store');

    // Route pour traiter la mise à jour d'un compte spécifique via une requête PUT.
    Route::put('/comptes/{compte}', [ComptesController::class, 'update'])->name('comptes.update');

    // Route pour supprimer un compte spécifique via une requête DELETE.
    Route::delete('/comptes/{compte}', [ComptesController::class, 'destroy'])->name('comptes.destroy');

    // Route pour afficher le formulaire de modification d'un compte spécifique.
    Route::get('/comptes/{compte}/edit', [ComptesController::class, 'edit'])->name('comptes.edit');

    // Route pour afficher le formulaire de création d'une nouvelle catégorie.
    Route::get('/categories', [CategorieController::class, 'create'])->name('categories.create');

    // Route pour traiter la soumission du formulaire de création d'une catégorie via une requête POST.
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');

    // Route pour traiter la mise à jour d'une catégorie spécifique via une requête PUT.
    Route::put('/categories/{category}', [CategorieController::class, 'update'])->name('categories.update');

    // Route pour afficher le formulaire de modification d'une catégorie spécifique.
    Route::get('/categories/{category}/edit', [CategorieController::class, 'edit'])->name('categories.edit');

    // Route pour supprimer une catégorie spécifique via une requête DELETE.
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Route pour afficher la liste des transactions.
    Route::get('/listing', [TransactionController::class, 'index'])->name('transactions.index');

    // Route pour afficher le formulaire de création d'une nouvelle transaction.
    Route::get('/transactions', [TransactionController::class, 'create'])->name('transactions.create');

    // Route pour traiter la soumission du formulaire de création d'une transaction via une requête POST.
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/transactionsRevenu', [TransactionController::class, 'storeRevenu'])->name('transactionsRevenu.store');

    // Route pour afficher le formulaire de modification d'une transaction spécifique.
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

    // Route pour traiter la mise à jour d'une transaction spécifique aux depenses via une requête PUT.
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');

    // Route pour supprimer une transaction spécifique aux depenses via une requête DELETE.
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    // Route pour afficher la liste des revenus.
    Route::get('/listeRevenu', [TransactionController::class, 'listeRevenu'])->name('transactions.revenu');

    // Route pour afficher le formulaire de création d'un nouveau revenu.
    Route::get('/transactionsRevenu', [TransactionController::class, 'createRevenu'])->name('transactions.createRevenu');

    // Route pour afficher le formulaire de modification d'une transaction spécifique aux Revenus.
    Route::get('/transactionsRevenu/{transaction}/edit', [TransactionController::class, 'editRevenu'])->name('transactionsRevenu.edit');

    // Route pour traiter la mise à jour d'une transaction spécifique aux Revenus via une requête PUT.
    Route::put('/transactionsRevenu/{transaction}', [TransactionController::class, 'updateRevenu'])->name('transactionsRevenu.update');

    // Route pour supprimer une transaction spécifique aux Revenus via une requête DELETE.
    Route::delete('/transactionsRevenu/{transaction}', [TransactionController::class, 'destroyRevenu'])->name('transactionsRevenu.destroy');

});