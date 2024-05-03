<?php

namespace App\Http\Controllers;
use App\Models\Chefservice;
use Illuminate\Http\Request;

class ChefserviceController extends Controller
{
     // Ajout du middleware 'employe' au constructeur
 public function __construct()
 {
     $this->middleware('chefservice');
 }

 public function create(){
     return view('chef_service.create');
 }

 public function index()
 {
     $chefservice = Chefservice::all(); // Utilisation de Employes::all() pour récupérer tous les employés
     return view('chef_service.index', compact('chefservice'));
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

     Chefservice::create([ // Utilisation de Employes::create() pour créer un nouvel employé
         'nom' => $request->nom,
         'numero' => $request->numero,
         'domaine' => $request->domaine,
         'localisation' => $request->localisation,
         'numero_urgence' => $request->numero_urgence,
     ]);

     return redirect()->route('chef_service.index')->with('success', 'Chef de service ajouté avec succès!');
 }

 public function edit($id)
 {
     $chefservice = Chefservice::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     return view('chef_service.edit', compact('chefservice'));
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

     $chefservice = Chefservice::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     $chefservice->update($request->all());

     return redirect()->route('chef_service.index')->with('success', 'Chef de service modifié avec succès!');
 }

 public function destroy($id)
 {
     $chefservice = Chefservice::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     $chefservice->delete();

     return redirect()->route('chef_service.index')->with('success', 'Chef de service supprimé avec succès');
 }
}



