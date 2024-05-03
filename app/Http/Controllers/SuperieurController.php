<?php

namespace App\Http\Controllers;

use App\Models\Superieur;
use Illuminate\Http\Request;

class SuperieurController extends Controller
{
    // Ajout du middleware 'stagiaire' au constructeur
    public function __construct()
    {
        $this->middleware('superieur');
    }

    public function create(){
        return view('superieur.create');
    }

    public function index()
    {
        $superieur = Superieur::all();
        return view('superieur.index', compact('superieur'));
    }



}
