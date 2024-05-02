<?php

namespace App\Http\Controllers;
use App\Models\Stagiaires;
use Illuminate\Http\Request;
use App\Http\Middleware\Stagiaire;

class stagiaireController extends Controller
{
    public function create(){
        return view('stagiaires/create');
    }
    public function index()
    {
        $stagiaire =Stagiaire::all();
        return view('stagiaires/index', compact('stagiaire'));

    }

    // Ajout d'un nouvel étudiant
    public function store(Request $request)
    {
        $request->validate([

            'nom' => 'required',
            'numero' => 'required',
            'domaine' => 'required',
            'localisation' => 'required',
            'numero_urgence' => 'required',
        ]);
        // Vérifier si un étudiant avec le même numéro de téléphone existe déjà

        // Créer un nouvel étudiant s'il n'existe pas déjà
                     Stagiaire::create([
                        'nom' => $request ->nom,
                        'numero' => $request ->numero,
                        'domaine' => $request ->domaine,
                        'localisation' => $request ->localisation,
                        'numero_urgence' => $request ->numero_urgence,
                    ]);


            if ($request->input('role') === 'employe') {
                return redirect()->route('employe-home')->with('success', 'Employé ajouté avec succès!');
            } elseif ($request->input('role') === 'stagiaire') {
                return redirect()->route('stagiaire-home')->with('success', 'Stagiaire ajouté avec succès!');
            } else {
                return redirect()->route('personnel.index')->with('success', 'Membre ajouté avec succès!');
            }


        }



    // Méthode pour afficher le formulaire de modification d'un étudiant
    public function edit($id){
        $stagiaire =Stagiaire::findOrFail($id);
        return view('stagiaires.edit', compact('stagiaire'));
    }


    // Méthode pour mettre à jour les informations d'un étudiant dans la base de données
    public function update(Request $request, $id)
    {


        // Validation des données
        $request->validate([
        'nom' => 'required|string',
        'numero' => 'required |string',
        'domaine' => 'required |string',
        'localisation' => 'required |string',
        'numero_urgence' => 'required |string',
        ]);

        // Recherche du personnel à mettre à jour
        $personnel = Stagiaire::findOrFail($id);
        // Mise à jour des informations de l'étudiant
        $personnel->update($request->all());

        // Redirection vers la liste des personnels avec un message de succès
        // return redirect()->route('personnel/index')->with('success', 'Membre modifié avec succès');
        return redirect()->route('stagiaire.index')->with('success', 'Membre ajouté avec succès!');

    }

    // Méthode pour supprimer un  personnel de la base de données
    public function destroy($id)
    {

        // Recherche de l'étudiant à supprimer
        $personnel =Stagiaire::findOrFail($id);
        // Suppression de l'étudiant
        $personnel->delete();

        // Redirection vers la liste du personnel avec un message de succès
        // return redirect()->route('personnel/index')->with('success', 'Membre supprimé avec succès');
        return redirect()->route('stagiaires.index')->with('success', 'Membre supprimé avec succès');

    }
}

