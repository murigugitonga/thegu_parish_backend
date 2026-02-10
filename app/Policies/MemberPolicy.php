<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Super-admin bypass: explicit access
     */
    public function before(User $user, $ability)
    {
        if($user->hasRole('super-admin')){
            return true;
        }
    }

    /**
     * determining if user can view a member
     */
    public function view(User $user, Member $member)
    {
        if ($user->hasRole('pg-leader')) {
            // restrict view to members of their group
            return $user->id === $member->group_leader_id; //
        }

        if ($user->hasRole('finance-admin')) {
            // finance admin can view all members to modify their finance records
            return true;
        }
        return false;
    }
    /**
     * Creating and managing members
     */
    public function create(User $user)
    {
        // Currently, only the player group leader can add members
        return $user->hasRole('pg-leader');
    }
    //Update a member
    public function update(User $user, Member $member)
    {
        if ($user->hasRole('pg-leader')) {
            # pg leader can update members in their group
            return $user->id === $member->group_leader_id;
        }
        // Finance admin cannot update member records
        return false;
    }
    // Deleting members
    public function delete(User $user, Member $member)
    {
        // deleting restricted to super-admin
        return false;
    }

}
