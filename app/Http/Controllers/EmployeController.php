<?php

namespace App\Http\Controllers;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    // Ajout du middleware 'employe' au constructeur
 public function __construct()
 {
     $this->middleware('employe');
 }

 public function create(){
     return view('employe.create');
 }

 public function index()
 {
     $employes = Employe::all(); // Utilisation de Employes::all() pour récupérer tous les employés
     return view('employe.index', compact('employes'));
 }

 public function store(Request $request)
 {
     $request->validate([
         'nom' => 'required|string',
         'numero' => 'required|string',
         'domaine' => 'required|string',
         'localisation' => 'required|string',
         'numero_urgence' => 'required|string',
     ]);

     Employe::create([ // Utilisation de Employes::create() pour créer un nouvel employé
         'nom' => $request->nom,
         'numero' => $request->numero,
         'domaine' => $request->domaine,
         'localisation' => $request->localisation,
         'numero_urgence' => $request->numero_urgence,
     ]);

     return redirect()->route('employe.index')->with('success', 'Employé ajouté avec succès!');
 }

 public function edit($id)
 {
     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     return view('employe.edit', compact('employe'));
 }

 public function update(Request $request, $id)
 {
     $request->validate([
         'nom' => 'required|string',
         'numero' => 'required|string',
         'domaine' => 'required|string',
         'localisation' => 'required|string',
         'numero_urgence' => 'required|string',
     ]);

     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     $employe->update($request->all());

     return redirect()->route('employe.index')->with('success', 'Employé modifié avec succès!');
 }

 public function destroy($id)
 {
     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     $employe->delete();

     return redirect()->route('employe.index')->with('success', 'Employé supprimé avec succès');
 }
}

