<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employe;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\EmployeMailActiver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
       // Fonction pour afficher le formulaire pour ajouter un nouveau profil de stagiaire
    public function profilForm()
    {
        return view('employe.profilform');
    }

    // Fonction pour enregistrer un nouveau profil de stagiaire
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

        Profilemployes::create($request->all());

        return redirect()->route('employe.profilliste')->with('success', 'Profil de stagiaire ajouté avec succès!');
    }

    // Fonction pour afficher la liste des profils de stagiaires
    public function profilListe()
    {
        $profils = Profilemployes::all();
        return view('employe.profilliste', compact('profils'));
    }

    // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
    public function profilEdit($id)
    {
        $profil = Profilemployes::findOrFail($id);
        return view('employe.profiledit', compact('profil'));
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

        $profil = Profilemployes::findOrFail($id);
        $profil->update($request->all());

        return redirect()->route('employe.profilliste')->with('success', 'Profil de stagiaire mis à jour avec succès!');
    }

    // Fonction pour supprimer un profil de stagiaire
    public function profilDestroy($id)
    {
        $profil = Profilemployes::findOrFail($id);
        $profil->delete();

        return redirect()->route('employe.profilliste')->with('success', 'Profil de stagiaire supprimé avec succès');
    }
    public function accueil(){
        return view('employe.accueil');
     }

    //  public function __construct()
    // {
    //     $this->middleware('guest');
    // }
     public function confirm($id, $token) {
        $user = User::where('id', $id)->where('confirmation_token', $token)->first();

        if ($user) {
            $user->update(['confirmation_token' => null]);
            // $this->guard()->login($user);
            return redirect('/login')->with('success', 'Votre compte est activé. Vous pouvez à présent vous connecter.');
        } else {
            return redirect('/login')->with('error', 'Ce lien ne semble plus valide.');
        }
    }


   

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.'
        ]);
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'confirmation_token' => Str::random(32),
    //     ]);
    // }
}
