<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suivi_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idbudget')->nullable(); 
            $table->integer('montant_budget');
            $table->unsignedBigInteger('idtransaction')->nullable(); // Modification ici
            $table->timestamps();
        
            $table->foreign('idbudget')->references('id')->on('budgets');
            $table->foreign('idtransaction')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_budgets');
    }
};
