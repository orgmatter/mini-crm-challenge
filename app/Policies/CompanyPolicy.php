<?php

namespace App\Policies;

use App\Company;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // a user that is referrenced in the company table by id is an admin and can view all records
        $role = Role::find($user->role_id);
        return $role->name === 'Admin';
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
        // a user that is referrenced in the company table by id is an admin and can view that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $company->user_id;
        }
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // a user that is referrenced in the company table by id is an admin and can create that record
        $role = Role::find($user->role_id);
        return $role->name === 'Admin';
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        // a user that is referrenced in the company table by id is an admin and can delete that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $company->user_id;
        }
    }

    /**
     * Determine whether the user can restore the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function restore(User $user, Company $company)
    {
        // a user that is referrenced in the company table by id is an admin and can restore that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $company->user_id;
        }
    }

    /**
     * Determine whether the user can permanently delete the company.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function forceDelete(User $user, Company $company)
    {
        // a user that is referrenced in the company table by id is an admin and can force delete that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $company->user_id;
        }
    }
}
