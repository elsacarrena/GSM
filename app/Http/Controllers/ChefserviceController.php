<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Employe;
use App\Models\Stagiaire;
use App\Models\Superieur;
use App\Models\Chefservice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\ConfirmemployeMail;
use App\Models\Profilstagiaires;
use App\Models\Profilchefservice;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use App\Mail\ComfirmemployeMailActiver;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailToEmployeAfterRegistrationNotification;


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

 public function profilForm()
 {
     return view('chef_service.profilForm');
 }

 // Fonction pour enregistrer un nouveau profil de stagiaire
 public function storeProfil(Request $request)
 {
     $request->validate([
        'nom' => 'required|string|max:255',
     'date_naissance' => 'required|date-time|max:255',
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
     Profilchefservice::create([ // Utilisation de  Profilchefservice::create() pour créer un nouvel  chefservice
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

     return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service ajouté avec succès!');
 }

 // Fonction pour afficher la liste des profils de chefs de service
 public function profilListe()
 {
     $profils = Profilchefservice::all();
     return view('chef_service.profilListe', compact('profils'));
 }

 // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
 public function profilEdit($id)
 {
    //dd($id);
    $profil = Profilchefservice::where('id', $id)->first();
     //$profil = Profilchefservice::findOrFail(3);
     return view('chef_service.profilEdit', compact('profil'));
 }

 // Fonction pour mettre à jour un profil de stagiaire
 public function profilUpdate(Request $request, $id)
 {
     $request->validate([
        'nom' => 'required|string|max:255',
        'date_naissance' => 'required|date-time|max:255',
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

     $profil = Profilchefservice::findOrFail($id);
     $profil->update($request->all());

     return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service mis à jour avec succès!');
 }

 // Fonction pour supprimer un profil de stagiaire
 public function profilDestroy($id)
 {
     $profil = Profilchefservice::findOrFail($id);
     $profil->delete();

     return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service supprimé avec succès');
 }

 public function accueil(){
    return view('chef_service.accueil');
 }

public function ajoutstagiaire(){
    return view('stagiaires.ajoutstagiaire');
}
public function ajoutemploye(){
    return view('employe.ajoutemploye');
}
public function storeEmploye(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);
//dd($request);
    try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('default');
        $user->is_admin = 4; // Rôle d'organisateur
        $user->save();

        // Envoyer un email pour que l'organisateur puisse confirmer son compte

        // Envoyer un code par email pour vérification
        if ($user) {
            try {
                ResetCodePassword::where('email', $user->email)->delete();
                $code = rand(1000, 4000);
                $data = [
                    'code' => $code,
                    'email' => $user->email
                ];
                ResetCodePassword::create($data);
                Notification::route('mail', $user->email)->notify(new SendEmailToEmployeAfterRegistrationNotification($code, $user->email));

                return redirect()->route('chef_service.index')->with('success_message', 'Employé ajouté');
            } catch (Exception $e) {
                throw new Exception('Une erreur est survenue lors de l\'envoi du mail');
            }
        }
    } catch (Exception $e) {
        throw new Exception('Une erreur est survenue lors de la création de cet employé');
    }
}
}



