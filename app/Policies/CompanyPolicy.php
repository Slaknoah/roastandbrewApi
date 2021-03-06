<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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

    /**
     * Authorize all actions for admin
     * @param User $user
     * @return bool
     */
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

    public function update( User $user, Company $company )
    {
        if ( $user->companies->contains( $company->id ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user, Company $company )
    {
        if ( $user->companies->contains( $company->id ) ) {
            return true;
        } else {
            return false;
        }
    }
}
