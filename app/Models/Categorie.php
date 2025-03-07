<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;
    protected $guarded=[''];

    // Relation avec les transactions
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'idcategorie'); // Assurez-vous que 'category_id' est la clé étrangère
    }
}
