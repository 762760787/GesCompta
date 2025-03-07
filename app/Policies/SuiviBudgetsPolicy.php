<?php

namespace App\Policies;

use App\Models\User;
use App\Models\suivi_budgets;
use Illuminate\Auth\Access\Response;

class SuiviBudgetsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, suivi_budgets $suiviBudgets): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, suivi_budgets $suiviBudgets): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, suivi_budgets $suiviBudgets): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, suivi_budgets $suiviBudgets): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, suivi_budgets $suiviBudgets): bool
    {
        return false;
    }
}
