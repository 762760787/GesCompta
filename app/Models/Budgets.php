<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetsFactory> */
    use HasFactory;
    protected $guarded=[''];
}
