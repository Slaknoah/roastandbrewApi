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

    public function store( User $user )
    {
        if ( $user->permission == 'admin' ) {
            return true;
        } else {
            return false;
        }
    }

    public function update( User $user, Company $company )
    {
        if ( $user->permission == 'admin' ) {
            return true;
        } elseif ( $user->companies->contains( $company->id ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete( User $user, Company $company )
    {
        if ( $user->permission == 'admin' ) {
            return true;
        } elseif ( $user->companies->contains( $company->id ) ) {
            return true;
        } else {
            return false;
        }
    }
}
