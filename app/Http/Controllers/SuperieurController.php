<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employe;
use App\Models\Superieur;
use App\Models\Chefservice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Models\Profilstagiaires;
use App\Models\Profilchefservice;
use App\Http\Middleware\Stagiaire;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SuperieurController extends Controller
{
    // Ajout du middleware 'stagiaire' au constructeur
    // public function __construct()
    // {
    //     $this->middleware('superieur');
    // }

    public function accueil(){
        return view('superieur.accueil');
     }

    

}
