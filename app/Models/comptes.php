<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comptes extends Model
{
    /** @use HasFactory<\Database\Factories\ComptesFactory> */
    use HasFactory;
    protected $fillable = [
        'type',
        'nom',
        'solde',
        'numero',
        'idbudget',
    ];
}
