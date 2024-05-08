<?php

// namespace App\Http\Controllers;
// use App\Models\User;
// use App\Models\Superieur;

// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Notifications\RegisteredUser;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Superieur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
