<?php

namespace App\Http\Controllers;
use App\Models\Departements;

use Illuminate\Http\Request;

class DepartementController extends Controller
{
    //
    public function create(){
        return view('departements/create');
    }
    public function index()
    {
        $departements = Departements::all();
       return view('departements/index', compact('departements'));
        //return view('students.index', ['students' =>$students]);
    }

    // Ajout d'un nouvel étudiant
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',

        ]);

        // Créer un nouvel étudiant s'il n'existe pas déjà
                    Departements::create([
                        'nom' =>$request->nom,
                        'description' => $request->description,
                    ]);

        // Création de l'étudiant à l'aide du modèle Student
        //Student::create($request->all());


            return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès');
        }



    // Méthode pour afficher le formulaire de modification d'un étudiant
    public function edit($id){
        $departement = Departements::findOrFail($id);
        return view('departements.edit', compact('departement'));
    }


    // Méthode pour mettre à jour les informations d'un étudiant dans la base de données
    public function update(Request $request, $id)
    {


        // Validation des données
        $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
        ]);

        // Recherche de l'étudiant à mettre à jour
        $departement = Departements::findOrFail($id);
        // Mise à jour des informations de l'étudiant
        $departement->update($request->all());

        // Redirection vers la liste des étudiants avec un message de succès
        return redirect()->route('departements/index')->with('success', 'Département modifié avec succès');
    }

    // Méthode pour supprimer un étudiant de la base de données
    public function destroy($id)
    {

        // Recherche de l'étudiant à supprimer
        $departement = Departements::findOrFail($id);
        // Suppression de l'étudiant
        $departement->delete();

        // Redirection vers la liste des étudiants avec un message de succès
        return redirect()->route('departements/index')->with('success', 'Département supprimé avec succès');
    }
}
