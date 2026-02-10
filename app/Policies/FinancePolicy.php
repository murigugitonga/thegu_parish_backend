<?php

namespace App\Policies;

use App\Models\Finance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FinancePolicy
{
    use HandlesAuthorization;

    /**
     * Super-admin bypass
    */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    }
    /**
     * Determining if a user can view finance records.
     * 
     */
    public function vie(User $user, Finance $finance)
    {
        // Finance admin can view all finances
        if($user->hasRole('finance-admin')){
            return true;
        }
        // Group leaders can only view the finances of their members
        if ($user->hasRole('pg-leader')) {
            return $finance->member->group_leader_id === $user->id;
        }

        return false;
    }
    /**
     * Determining if a user can update a finance record
     */
    public function update(User $user, Finance $finance)
    {
        if ($user->hasRole('finance-admin')) {
            // Can update all finances
            return true;
        }
        return false;
    }
    /**
     * Other CRUD actions
     */
    public function delete(User $user, Finance $finance)
    {
        return false;
    }
    public function create(User $user)
    {
        // Super-admin can create finance records directly
        return false;
    }
}
