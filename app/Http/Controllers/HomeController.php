<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        return view('home');
    }
    public function adminHome(){
        return view('admin-home');
    }
    public function superieurHome(){
        return view('superieur/superieur-home');
    }
    public function chefserviceHome(){
        return view('chef_service/chefservice-home');
    }
    public function employeHome()
{
    $role = 'employe';
    return view('employe/employe-home', compact('role'));
}

public function stagiaireHome()
{
    $role = 'stagiaire';
    return view('stagiaires/stagiaire-home', compact('role'));
}

    // public function employeHome(){
    //     return view('employe-home');
    // }
    // public function stagiaireHome(){
    //     return view('stagiaire-home');
    // }



}
