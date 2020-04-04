<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UserFormRequest;
use App\Http\Requests\Admin\CompanyFormRequest;
use App\Http\Requests\Admin\DeleteCompanyFormRequest;
use App\Http\Requests\Admin\AdminLoginFormRequest;
use App\Role;
use App\Privilege;
use App\User;
use App\Company;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    // protected function guard()
    // {
    //     return Auth::guard('auth');
    // }

    // set the authenticated user
    protected function setUser() {
        if (Auth::guard('admin')->check()) { 
            return Auth::guard('admin')->user(); 
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::guard('admin')->check()) {
            $user_role_id = Auth::guard('admin')->user()->role_id;

            $role = Role::find($user_role_id);

            $roles = Role::all();

            $role_name = $role->name;

            $privileges = Privilege::where('role_id', $user_role_id)->get();

            $users = User::where('id', '<>', $this->setUser()->id)->get();

            $companies = $this->setUser()->companies;

            // return view('dashboard.admin', compact(['roles','role_name','privileges', 'users', 'companies']));
            return response()->json($companies);
        }else {

            return redirect()->to('/login');
        }
    }

    public function login(AdminLoginFormRequest $request) {

        $validated = $request->validated();

        if (Auth::guard('admin')->attempt($request->only(['email', 'password']))) {

            return redirect(route('dashboard.index'));
        }else {

            return redirect()->back()->with('create_alert_message','Oops! Seems like login credentials is incorrect!');
        }
    }


    public function delete_company(DeleteCompanyFormRequest $request, Company $company) {

        $validated = $request->validated();

        $company_result = Company::find($company);

        if($company_result->destroy()) {

            return redirect(route('dashboard.index'));
        }else {

            return redirect()->back()->with('create_alert_message','Oops! Seems like something went wrong, try again!'); 
        }
    }

    public function delete_user(Request $request, User $user) {

        $user_result = User::find($user);

        if($user_result->destroy()) {

            return redirect(route('dashboard.index'));
        }else {

            return redirect()->back()->with('create_alert_message','Oops! Seems like something went wrong, try again!'); 
        }
    }

    public function logout () {

        Auth::guard('admin')->logout();

        return redirect(route('login'));
    }

    public function create_user(UserFormRequest $request) {

        if($this->isRole() == 'Admin') {
            
            $validated = $request->validated();
            extract($validated);

            $user = User::create([
                'role_id' => $role,
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'fake_password' => $password
            ]);
            if(isset($user)) {
                return redirect('dashboard.admin')->with('create_alert_message','Great! You have created a new user!!');
            }else {
                return redirect('dashboard.admin')->with('create_alert_message','Oops! Something went wrong, try again.');
            }
        }else {
            return redirect('dashboard.admin')->with('create_alert_message', 'You are not allowed to perform this action!');

        }
    }

    public function create_company(CompanyFormRequest $request) {

        if($this->isRole() == 'Admin') {
            
            $validated = $request->validated();
            extract($validated);

            if($request->hasFile('logo')) {
                $logo_file = $request->file('logo');
                $logo_name = time().'.'.$logo->getClientOriginalExtension();
                // Image::make($logo)->resize(300,300)->save(storage_path('/images/'.$logo_name));
                // $logo_path = storage_path('/images/'.$logo_name);
                $logo_path = Storage::putFileAs('images', $logo_file, $logo_name);


                $company = $this->setUser()->companies()->create([
                    'role_id' => $role,
                    'name' => $name,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'logo' => $logo_path,
                    'url' => $url,
                    'password' => Hash::make($password),
                    'fake_password' => $password
                ]);

                if(isset($company)) {
                    return redirect('dashboard.admin')->with('create_alert_message','Great! You have created a new company!!');
                }else {
                    return redirect('dashboard.admin')->with('create_alert_message','Oops! Something went wrong, try again.');;
                }
            }

        }else {
            return redirect('dashboard.admin')->with('create_alert_message', 'You are not allowed to perform this action!');

        }
    }
}