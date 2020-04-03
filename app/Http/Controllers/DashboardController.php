<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\CompanyFormRequest;
use App\Role;
use App\Privilege;
use App\User;

class DashboardController extends Controller
{

    // set the authenticated user
    protected function setUser() {
        if (Auth::check()) { 
            return Auth::user(); 
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::check()) {
            $user_role_id = Auth::user()->role_id;

            $role = Role::find($user_role_id);

            $roles = Role::all();

            $role_name = $role->name;

            $privileges = Privilege::where('role_id', $user_role_id)->get();

            return view('dashboard', compact(['roles','role_name','privileges']));
        }else {

            return redirect()->to('/login');
        }
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
                return redirect('dashboard')->with('create_user_alert_message','Great! You have created a new user!!');
            }else {
                return redirect('dashboard')->with('create_user_alert_message','Oops! Something went wrong, try again.');;
            }
        }else {
            return redirect('dashboard')->with('create_user_alert_message', 'You are not allowed to perform this action!');

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
                    return redirect('dashboard')->with('create_alert_message','Great! You have created a new company!!');
                }else {
                    return redirect('dashboard')->with('create_alert_message','Oops! Something went wrong, try again.');;
                }
            }

        }else {
            return redirect('dashboard')->with('create_alert_message', 'You are not allowed to perform this action!');

        }
    }
}