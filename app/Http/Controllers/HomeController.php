<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function guard() 
    {
        return Auth::guard('admin');
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::guard('admin')->check()) {
            
            return redirect()->to('/dashboard');

        }else {

            return redirect()->to('/login');
        }
    }
}
