<?php

namespace App\Policies;

use App\Employee;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any employees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // a user that is referrenced in the Employee table by id is an admin and can view all records
        $role = Role::find($user->role_id);
        return $role->name === 'Admin';
    }

    /**
     * Determine whether the user can view the Employee.
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function view(User $user, Employee $employee)
    {
        // a user that is referrenced in the Employee table by id is an admin and can view that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $employee->user_id;
        }
    }

    /**
     * Determine whether the user can create employees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // a user that is referrenced in the Employee table by id is an admin and can create that record
        $role = Role::find($user->role_id);
        return $role->name === 'Admin';
    }

    /**
     * Determine whether the user can update the Employee.
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function update(User $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can delete the employee.
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function delete(User $user, Employee $employee)
    {
        // a user that is referrenced in the Employee table by id is an admin and can delete that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $employee->user_id;
        }
    }

    /**
     * Determine whether the user can restore the Employee.
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function restore(User $user, Employee $employee)
    {
        // a user that is referrenced in the Employee table by id is an admin and can restore that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $employee->user_id;
        }
    }

    /**
     * Determine whether the user can permanently delete the Employee.
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function forceDelete(User $user, Employee $employee)
    {
        // a user that is referrenced in the Employee table by id is an admin and can force delete that record
        $role = Role::find($user->role_id);
        if($role->name == 'Admin') {
            return $user->id === $employee->user_id;
        }
    }
}
