<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function() {

    Route::get('', 'AdminController@index')->name('dashboard.index');
    Route::post('user', 'AdminController@create_user')->name('dashboard.create.user');
    Route::get('user', 'AdminController@show_users')->name('dashboard.show.users');
    Route::put('update/{user}', 'AdminController@update_users')->name('dashboard.update.user');
    Route::delete('user', 'AdminController@delete_user')->name('dashboard.delete.user');
    Route::post('company', 'AdminController@create_company')->name('dashboard.create.company');
    Route::get('company', 'AdminController@show_companies')->name('dashboard.show.companies');
    Route::delete('company/{company}', 'AdminController@delete_company')->name('dashboard.delete.company');
});

Route::group(['prefix' => 'company', 'namespace' => 'Dashboard'], function() {
    
    Route::get('', 'CompanyController@index')->name('company.index');
    Route::get('company_login', 'CompanyController@show_login')->name('company.show.login');
    Route::post('login', 'CompanyController@login')->name('company.login');
    Route::post('logout', 'CompanyController@logout')->name('company.logout');
    Route::put('update/{company}', 'CompanyController@update_company')->name('company.update');
    Route::delete('employee', 'CompanyController@delete_employee')->name('dashboard.delete.employee');
    Route::post('employee', 'CompanyController@create_employee')->name('company.create.employee');
    Route::get('employee', 'CompanyController@show_employees')->name('company.view.employees');
});

Route::group(['prefix' => 'employee', 'namespace' => 'Dashboard'], function() {
    
    Route::get('', 'EmployeeController@index')->name('employee.index');
    Route::get('employee_login', 'EmployeeController@show_login')->name('employee.show.login');
    Route::post('login', 'EmployeeController@login')->name('employee.login');
    Route::post('logout', 'EmployeeController@logout')->name('employee.logout');
    Route::put('update/{employee}', 'EmployeeController@update_employee')->name('employee.update');
});


