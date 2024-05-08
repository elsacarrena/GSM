<?php

namespace App\Http\Controllers;
// // use App\Models\Stagiaires;
// use Illuminate\Http\Request;
use App\Models\Stagiaires;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilstagiaires;
use App\Http\Middleware\Stagiaire;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    // Fonction pour afficher le formulaire pour ajouter un nouveau profil de stagiaire
   public function profilForm()
   {
       return view('stagiaires.profilForm');
   }
    //Fonction pour enregistrer un nouveau profil de stagiaire
   public function storeProfil(Request $request)
   {
       $request->validate([
           'nom' => 'required|string|max:255',
           'numero' => 'required|string|max:255',
           'domaine' => 'required|string|max:255',
           'groupe_sanguin' => 'required|string|max:255',
           'maladie' => 'required|string|max:255',
           'localisation' => 'required|string|max:255',
           'nom_pere' => 'required|string|max:255',
           'nom_mere' => 'required|string|max:255',
           'numero_pere' => 'required|string|max:255',
           'numero_mere' => 'required|string|max:255',
           'numero_urgence' => 'required|string|max:255',
       ]);

       Profilstagiaires::create($request->all());

       return redirect()->route('stagiaires.profilListe')->with('success', 'Profil de stagiaire ajouté avec succès!');

   }

   // Fonction pour afficher la liste des profils de stagiaires
   public function profilListe()
   {
       $profils = Profilstagiaires::all();
       return view('stagiaires.profilListe', compact('profils'));
   }

   // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
   public function profilEdit($id)
   {
       $profil = Profilstagiaires::findOrFail($id);
       return view('stagiaires.profilEdit', compact('profil'));
   }

   // Fonction pour mettre à jour un profil de stagiaire
   public function profilUpdate(Request $request, $id)
   {
       $request->validate([
           'nom' => 'required|string|max:255',
           'numero' => 'required|string|max:255',
           'domaine' => 'required|string|max:255',
           'type' => 'required|string|max:255',
           'groupe_sanguin' => 'required|string|max:255',
           'maladie' => 'required|string|max:255',
           'localisation' => 'required|string|max:255',
           'nom_pere' => 'required|string|max:255',
           'nom_mere' => 'required|string|max:255',
           'numero_pere' => 'required|string|max:255',
           'numero_mere' => 'required|string|max:255',
           'numero_urgence' => 'required|string|max:255',
       ]);

       $profil = Profilstagiaires::findOrFail($id);
       $profil->update($request->all());

       return redirect()->route('stagiaires.profilListe')->with('success', 'Profil de stagiaire mis à jour avec succès!');
   }
   // Fonction pour supprimer un profil de stagiaire
   public function profilDestroy($id)
   {
       $personnel = Profilstagiaires::findOrFail($id);
       $personnel->delete();

       return redirect()->route('stagiaires.profilListe')->with('success', 'Profil de stagiaire supprimé avec succès');
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




// protected function create(array $data)
// {
//     return Stagiaires::create([
//         'name' => $data['name'],
//         'email' => $data['email'],
//         'password' => Hash::make($data['password']),
//         'confirmation_token' => Str::random(32),
//     ]);
// }
}