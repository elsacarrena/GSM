<?php

namespace App\Http\Controllers;
// // use App\Models\Stagiaires;
// use Illuminate\Http\Request;
use App\Models\Stagiaires;


use Illuminate\Http\Request;



use App\Models\Profilstagiaires;


use App\Http\Middleware\Stagiaire;

class stagiaireController extends Controller
{
    // Ajout du middleware 'stagiaire' au constructeur
    public function __construct()
    {
        $this->middleware('stagiaire');
    }

    public function create(){
        return view('stagiaires.create');
    }

    public function index()
    {
        $stagiaires = Stagiaires::all();
        return view('stagiaires.index', compact('stagiaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'numero' => 'required',
            'domaine' => 'required',
            'localisation' => 'required',
            'numero_urgence' => 'required',
        ]);

        Stagiaires::create([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'domaine' => $request->domaine,
            'localisation' => $request->localisation,
            'numero_urgence' => $request->numero_urgence,
        ]);


            return redirect()->route('stagiaires.index')->with('success', 'Stagiaire ajouté avec succès!');

    }

    public function edit($id){
        $stagiaire = Stagiaires::findOrFail($id);
        return view('stagiaires.edit', compact('stagiaire'));
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

        $stagiaire = Stagiaires::findOrFail($id);
        $stagiaire->update($request->all());

        return redirect()->route('stagiaires.index')->with('success', 'Membre modifié avec succès!');
    }

    public function destroy($id)
    {
        $stagiaire = Stagiaires::findOrFail($id);
        $stagiaire->delete();

        return redirect()->route('stagiaires.index')->with('success', 'Membre supprimé avec succès');
    }
}
