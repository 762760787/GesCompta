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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idcategorie')->constrained('categories');
            $table->string('description');
            $table->decimal('montant', 10, 2);
            $table->date('date');
            $table->unsignedBigInteger('idbudget');
            $table->unsignedBigInteger('idcompte')->nullable(); // Modification ici
            $table->timestamps();
            $table->foreign('idcompte')->references('id')->on('comptes');
            $table->foreign('idbudget')->references('id')->on('budgets');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
