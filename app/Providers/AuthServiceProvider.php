<?php

namespace App\Providers;

use App\Policies\CompanyPolicy;
use App\Policies\EmployeePolicy;
use App\Company;
use App\Employee;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Employee::class => EmployeePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // defining a gates and methods on company policy
        Gate::define('view-companies', 'App\Policies\CompanyPolicy@viewAny');
        Gate::define('view-company', 'App\Policies\CompanyPolicy@view');
        Gate::define('create-company', 'App\Policies\CompanyPolicy@create');
        Gate::define('delete-company', 'App\Policies\CompanyPolicy@delete');

        // defining a gates and methods on employee policy
        Gate::define('view-employees', 'App\Policies\EmployeePolicy@viewAny');
        Gate::define('view-employee', 'App\Policies\EmployeePolicy@view');
        Gate::define('create-employee', 'App\Policies\EmployeePolicy@create');
        Gate::define('delete-employee', 'App\Policies\EmployeePolicy@delete');
        
    }
}
