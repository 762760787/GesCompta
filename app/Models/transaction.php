<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $fillable = [
        'idcategorie',
        'description',
        'montant',
        'date',
        'idcompte',
        'idbudget',
    ];
    //relations
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'idcategorie');
    }
}
