<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('includes.modals.forms.crm.user_form', 'userFormModal');
        Blade::include('includes.modals.forms.crm.company_form', 'companyFormModal');
        Blade::include('includes.modals.forms.company.employee_form', 'employeeFormModal');
        Blade::include('includes.modals.alerts.crm.create_alert', 'crmCreateAlertModal');
        Blade::include('includes.modals.alerts.company.create_alert', 'companyCreateAlertModal');
    }
}
