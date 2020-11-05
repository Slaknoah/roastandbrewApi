<?php

namespace App\Policies;

use App\Models\Cafe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CafePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before( User $user )
    {
        if ( $user->permission === 'admin' ) {
            return true;
        }

        return null;
    }

    public function store( User $user )
    {
        return false;
    }

    public function update( User $user, Cafe $cafe )
    {
        if ( $user->companies->contains( $cafe->company_id ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user, Cafe $cafe )
    {
        if ( $user->companies->contains( $cafe->company_id ) ) {
            return true;
        } else {
            return false;
        }
    }
}
