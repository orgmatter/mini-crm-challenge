<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Company\CompanyLoginFormRequest;
use App\Http\Requests\Company\EmployeeFormRequest;
use Illuminate\Support\Facades\View;
use App\Role;
use App\Privilege;
use App\Employee;

class CompanyController extends Controller
{

    protected function guard()
    {
        return Auth::guard('company');
    }

    public function __construct()
    {
        $this->middleware('guest:employee');
        $this->middleware('guest');
    }

    // set the authenticated user
    protected function setUser() {
        if (Auth::guard('company')->check()) { 
            return Auth::guard('company')->user(); 
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
     * Show the application company dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if($this->setUser()) {
            $user_role_id = $this->setUser()->role_id;

            $role = Role::find($user_role_id);

            $roles = Role::all();

            $role_name = $role->name;

            $privileges = Privilege::where('role_id', $user_role_id)->get();

            return view('dashboard.company', compact(['roles','role_name','privileges']));
        }else {

            return redirect(route('company.show.login'));
        }
    }

    public function show_login() {

        return view('auth.login.company');
    }

    public function login (CompanyLoginFormRequest $request) {

        $validated = $request->validated();

        // extract($validated);

        if(Auth::guard('company')->attempt($request->only(['email', 'password']))) {

            return redirect(route('company.index'));
        }else {

            return redirect()->back()->with('create_alert_message','Oops! Username or password is incorrect!.');
        }
    }

    public function logout () {

        Auth::guard('company')->logout();

        return redirect(route('company.show.login'));

    }

    public function update_company(Request $request, Company $company) {

        $company_result = Company::find($company);

        if($company_result->update($request)) {

            return redirect(route('company.index'))->with('create_alert_message','Great! You have created a new employee!!');
        
        }else{

            return redirect(route('company.index'))->with('create_alert_message','Oops! Something went wrong, try again.');
        }
    }

    public function create_employee(EmployeeFormRequest $request) {

        $validated = $request->validated();
        extract($validated);

        if($this->isRole() == 'Admin') {
            
            $validated = $request->validated();
            extract($validated);

            $employees = $this->setUser()->employees()->create([
                'role_id' => $role,
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'fake_password' => $password
            ]);
            if(isset($employees)) {
                return redirect(route('company.index'))->with('create_alert_message','Great! You have created a new employee!!');
            }else {
                return redirect(route('company.index'))->with('create_alert_message','Oops! Something went wrong, try again.');
            }
        }else {
            return redirect(route('company.index'))->with('create_alert_message', 'You are not allowed to perform this action!');

        }
    }

    public function show_employees() {

        $employees = $this->setUser()->employees;

        if(isset($employees)) {
            return view('dashboard.company', compact(['employees']));
        }else {
            return redirect('company.index')->with('create_alert_message','Oops! Something went wrong, try again.');
        }
    }
}