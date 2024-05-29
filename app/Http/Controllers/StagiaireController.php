<?php

namespace App\Http\Controllers;
// // use App\Models\Stagiaires;
// use Illuminate\Http\Request;
use App\Models\Stagiaires;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilstagiaires;
use App\Http\Middleware\Stagiaire;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class StagiaireController extends Controller
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
            'nom' => 'required|string',
            'numero' => 'required|string',
            'domaine' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'date_additionnelle' => 'required|date',
            'localisation' => 'required|string',
            'numero_urgence' => 'required|string',
        ]);

        Stagiaires::create([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'domaine' => $request->domaine,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'date_additionnelle' => $request->date_additionnelle,
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
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'date_additionnelle' => 'required|date',
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
    // Fonction pour afficher le formulaire pour ajouter un nouveau profil de stagiaire
   public function profilForm()
   {
       return view('stagiaires.profilForm');
   }
    //Fonction pour enregistrer un nouveau profil de stagiaire
   public function profilstore(Request $request)
   {
       $request->validate([
        'nom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'numero' => 'required|string|max:255',
        'domaine' => 'required|string|max:255',
        'groupe_sanguin' => 'required|string|max:255',
        'maladie' => 'required|string|max:255',
        'situation_matrimoniale' => 'required|string|max:255',
        'localisation' => 'required|string|max:255',
        'nom_pere' => 'required|string|max:255',
        'nom_mere' => 'required|string|max:255',
        'numero_pere' => 'required|string|max:255',
        'numero_mere' => 'required|string|max:255',
        'numero_urgence' => 'required|string|max:255',
       ]);
       $user = Auth::user();
       $id = $user->id;
       //dd($id);
       Profilstagiaires::create([
            'nom' => $request->nom,
            'date_naissance' => $request->date_naissance,
            'numero' => $request->numero,
            'domaine' => $request->domaine,
            'groupe_sanguin'=>$request->groupe_sanguin,
            'maladie'=>$request->maladie,
            'situation_matrimoniale' => $request->situation_matrimoniale,
            'localisation' => $request->localisation,
            'nom_pere'=> $request->nom_pere,
            'nom_mere'=> $request->nom_mere,
            'numero_pere'=> $request->numero_pere,
            'numero_mere'=> $request->numero_mere,
            'numero_urgence' => $request->numero_urgence,
            'users_id' =>$id,

    ]);


       return redirect()->route('stagiaires.profilliste')->with('success', 'Profil de stagiaire ajouté avec succès!');

   }

   // Fonction pour afficher la liste des profils de stagiaires
   public function profilListe()
   {
       $profils = Profilstagiaires::all();
       return view('stagiaires.profilliste', compact('profils'));
   }

   // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
   public function profilEdit($id)
   {
       $profil = Profilstagiaires::findOrFail($id);
       return view('stagiaires.profiledit', compact('profil'));
   }

   // Fonction pour mettre à jour un profil de stagiaire
   public function profilUpdate(Request $request, $id)
   {
       $request->validate([
        'nom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'numero' => 'required|string|max:255',
        'domaine' => 'required|string|max:255',
        'groupe_sanguin' => 'required|string|max:255',
        'maladie' => 'required|string|max:255',
        'situation_matrimoniale' => 'required|string|max:255',
        'localisation' => 'required|string|max:255',
        'nom_pere' => 'required|string|max:255',
        'nom_mere' => 'required|string|max:255',
        'numero_pere' => 'required|string|max:255',
        'numero_mere' => 'required|string|max:255',
        'numero_urgence' => 'required|string|max:255',
       ]);

       $profil = Profilstagiaires::findOrFail($id);
       $profil->update($request->all());

       return redirect()->route('stagiaires.profilliste')->with('success', 'Profil de stagiaire mis à jour avec succès!');
   }
   // Fonction pour supprimer un profil de stagiaire
   public function profilDestroy($id)
   {
       $profil = Profilstagiaires::findOrFail($id);
       $profil->delete();

       return redirect()->route('stagiaires.profilliste')->with('success', 'Profil de stagiaire supprimé avec succès');
   }
   public function accueil(){
    return view('stagiaires.accueil');
 }

 public function confirm($id, $token) {
    $stagiaires = Stagiaires::where('id', $id)->where('confirmation_token', $token)->first();

    if ($stagiaires) {
        $stagiaires->update(['confirmation_token' => null]);
        // $this->guard()->login($user);
        return redirect('/login')->with('success', 'Votre compte est activé. Vous pouvez à présent vous connecter.');
    } else {
        return redirect('/login')->with('error', 'Ce lien ne semble plus valide.');
    }
}





}
