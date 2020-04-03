<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Employee\EmployeeLoginFormRequest;
use Illuminate\Support\Facades\View;
use App\Role;
use App\Privilege;

class EmployeeController extends Controller
{

    protected function guard()
    {
        return Auth::guard('employee');
    }

    public function __construct()
    {
        $this->middleware('guest:company');
        $this->middleware('guest');
    }

    // set the authenticated user
    protected function setUser() {
        if (Auth::guard('employee')->check()) { 
            return Auth::guard('employee')->user(); 
        }
    }

    // get the role for the authenticated user
    protected function isRole() {
        if ($this->setUser()) {
            $role = Role::find($this->setUser()->role_id);
            $role_name = $role->name;
            return $role_name ;
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application employee dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if($this->setUser()) {
            // $user_role_id = $this->setUser()->role_id;

            // $role = Role::find($user_role_id);

            // $roles = Role::all();

            // $role_name = $role->name;

            // $privileges = Privilege::where('role_id', $user_role_id)->get();

            return view('dashboard.employee');
        }else {

            return redirect(route('employee.show.login'));
        }
    }

    public function show_login() {

        return view('auth.login.employee');
    }

    public function login (EmployeeLoginFormRequest $request) {

        $validated = $request->validated();

        // extract($validated);

        if(Auth::guard('employee')->attempt($request->only(['email', 'password']))) {

            return redirect(route('employee.index'));
        }
    }

    public function logout() {

        Auth::guard('employee')->logout();

        return redirect(route('employee.show.login'));
    }

    public function update_employee(Request $request, Company $employee) {

        $employee_result = Employee::find($employee);

        if($employee_result->update($request)) {

            return redirect(route('employee.index'))->with('create_alert_message','Great! You have created a new employee!!');
        
        }else{

            return redirect(route('employee.index'))->with('create_alert_message','Oops! Something went wrong, try again.');
        }
    }
}