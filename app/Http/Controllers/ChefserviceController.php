<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Employe;
use App\Models\Stagiaires;
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
use App\Http\Requests\submitDefineAccessRequest;
use App\Notifications\SendEmailToEmployeAfterRegistrationNotification;






use App\Notifications\SendEmailToStagiaireAfterRegistrationNotification;

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
    // dd('fgf');
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
     $user = Auth::user();
     $id = $user->id;
     Chefservice::create([ // Utilisation de Employes::create() pour créer un nouvel employé
         'nom' => $request->nom,
         'numero' => $request->numero,
         'domaine' => $request->domaine,
         'date_debut' => $request->date_debut,
         'date_fin' => $request->date_fin,
         'date_additionnelle' => $request->date_additionnelle,
         'localisation' => $request->localisation,
         'numero_urgence' => $request->numero_urgence,
         'users_id'=>$id,
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
         'date_debut' => 'required|date',
         'date_fin' => 'required|date',
         'date_additionnelle' => 'required|date',
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
         'date_naissance' => 'required|date|max:255',
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
     $user = Auth::user();
     $id = $user->id;
     Profilchefservice::create([ // Utilisation de  Profilchefservice::create() pour créer un nouvel  chef service
        'nom' => $request->nom,
        'date_naissance' => $request->date_naissance,
        'numero' => $request->numero,
        'domaine' => $request->domaine,
        'groupe_sanguin' => $request->groupe_sanguin,
        'maladie' => $request->maladie,
        'localisation' => $request->localisation,
        'nom_pere' => $request->nom_pere,
        'nom_mere' => $request->nom_mere,
        'numero_pere' => $request->numero_pere,
        'numero_mere' => $request->numero_mere,
        'numero_urgence' => $request->numero_urgence,
        'users_id'=>$id,
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
     $profil = Profilchefservice::findOrFail($id);
     return view('chef_service.profilEdit', compact('profil'));
 }

 // Fonction pour mettre à jour un profil de stagiaire
 public function profilUpdate(Request $request, $id)
 {
     $request->validate([
         'nom' => 'required|string|max:255',
         'date_naissance' => 'required|date|max:255',
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


public function appreciation(){
    return view('chef_service.appreciation');
}

public function index_appreciation()
{
    $chefservices = Chefservice::all(); // Récupère toutes les appréciations
    return view('chef_service.index_appreciation', compact('chefservices'));
}


public function edit_appreciation($id)
{
    $chefservice = Chefservice::findOrFail($id);
    return view('chef_service.edit_appreciation', compact('chefservice'));
}

// Mettre à jour une appréciation
public function update_appreciation(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string',
        'domaine' => 'required|string',
        'ponctualite' => 'required|int',
        'assiduite' => 'required|int',
        'creativite' => 'required|int',
        'engagement' => 'required|int',
        'motivation' => 'required|int',
        'initiative' => 'required|int',
        'sociabilite' => 'required|int',
        'gout_risque' => 'required|int',
        'autres_appreciations' => 'required|int',
    ]);

    $chefservice = Chefservice::findOrFail($id);
    $chefservice->update($request->all());

    return redirect()->route('chef_service.index_appreciation')->with('success', 'Appréciation modifiée avec succès!');
}



// Supprimer une appréciation
public function destroy_appreciation($id)
{
    $chefservice = Chefservice::findOrFail($id);
    $chefservice->delete();

    return redirect()->route('chef_service.index_appreciation')->with('success', 'Appréciation supprimée avec succès.');
}



public function storeEmploye(Request $request)
 {
     $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
     ]);

     $user = new User();
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make('default');
     $user->is_admin = 4; // Rôle d'organisateur
     $user->save();

     // Envoyer un email pour que l'organisateur puisse confirmer son compte

     // Envoyer un code par email pour vérification
     if ($user) {
         ResetCodePassword::where('email', $user->email)->delete();
         $code = rand(1000, 4000);
         $data = [
             'code' => $code,
             'email' => $user->email
         ];
         ResetCodePassword::create($data);
         Notification::route('mail', $user->email)->notify(new SendEmailToEmployeAfterRegistrationNotification($code, $user->email));

         // return redirect()->route('superieur.index')->with('success_message', 'Employé ajouté');
         return redirect()->route('chef_service.indexEmploye')->with('success_message', 'Employé ajouté');
     }
 }






public function storeStagiaire(Request $request)
 {
     $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
     ]);

     $user = new User();
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make('default');
     $user->is_admin = 5; // Rôle d'organisateur
     $user->save();

     // Envoyer un email pour que l'organisateur puisse confirmer son compte

     // Envoyer un code par email pour vérification
     if ($user) {
         ResetCodePassword::where('email', $user->email)->delete();
         $code = rand(1000, 4000);
         $data = [
             'code' => $code,
             'email' => $user->email
         ];
         ResetCodePassword::create($data);
         Notification::route('mail', $user->email)->notify(new SendEmailToStagiaireAfterRegistrationNotification($code, $user->email));


         return redirect()->route('chef_service.indexStagiaires')->with('success_message', 'Employé ajouté');
     }
 }




public function profilEmployeform()
{
    return view('chef_service.profilEmployeform');
}

// Fonction pour enregistrer un nouveau profil de stagiaire
public function storeProfilEmploye(Request $request)
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
    $user = Auth::user();
    $id = $user->id;

    Profilemployes::create([
        'nom' => $request->nom,
        'numero' => $request->numero,
        'domaine' => $request->domaine,
        'groupe_sanguin'=>$request->groupe_sanguin,
        'maladie'=>$request->maladie,
        'localisation' => $request->localisation,
        'nom_pere'=> $request->nom_pere,
        'nom_mere'=> $request->nom_mere,
        'numero_pere' => $request->numero_pere,
        'numero_mere' => $request->numero_mere,
        'numero_urgence' => $request->numero_urgence,
        'users_id' =>$id,
    ]);
    return redirect()->route('chef_service.profilEmployeliste')->with('success', 'Profil de stagiaire ajouté avec succès!');
}

// Fonction pour afficher la liste des profils de stagiaires
public function profilEmployeliste()
{
    $profils = Profilemployes::all();
    return view('chef_service.profilEmployeliste', compact('profils'));
}

// Fonction pour afficher le formulaire de modification d'un profil de stagiaire
public function profilEmployeEdit($id)
{
    $profil = Profilemployes::findOrFail($id);
    return view('chef_service.profilEmployeedit', compact('profil'));
}

// Fonction pour mettre à jour un profil de stagiaire
public function profilEmployeUpdate(Request $request, $id)
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

    $profil = Profilemployes::findOrFail($id);
    $profil->update($request->all());

    return redirect()->route('chef_service.profilEmployeliste')->with('success', 'Profil de stagiaire mis à jour avec succès!');
}

// Fonction pour supprimer un profil de stagiaire
public function profilEmployeDestroy($id)
{
    $profil = Profilemployes::findOrFail($id);
    $profil->delete();

    return redirect()->route('chef_service.profilEmployeliste')->with('success', 'Profil de stagiaire supprimé avec succès');
}
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






// Méthodes similaires pour les stagiaires...
public function profilStagiairesForm()
   {
       return view('chef_service.profilStagiairesForm');
   }
    //Fonction pour enregistrer un nouveau profil de stagiaire
   public function storeProfilStagiaires(Request $request)
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
       $user = Auth::user();
       $id = $user->id;
       //dd($id);
       Profilstagiaires::create([
        'nom' => $request->nom,
        'numero' => $request->numero,
        'domaine' => $request->domaine,
        'groupe_sanguin'=>$request->groupe_sanguin,
        'maladie'=>$request->maladie,
        'localisation' => $request->localisation,
        'nom_pere'=> $request->nom_pere,
        'nom_mere'=> $request->nom_mere,
        'numero_pere' => $request->numero_urgence,
        'numero_mere' => $request->numero_urgence,
        'numero_urgence' => $request->numero_urgence,
        'users_id' =>$id,

    ]);


       return redirect()->route('chef_service.profilStagiairesListe')->with('success', 'Profil de stagiaire ajouté avec succès!');

   }

   // Fonction pour afficher la liste des profils de stagiaires
   public function profilStagiairesListe()
   {
       $profils = Profilstagiaires::all();
       return view('chef_service.profilStagiairesliste', compact('profils'));
   }

   // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
   public function profilStagiairesEdit($id)
   {
       $profil = Profilstagiaires::findOrFail($id);
       return view('chef_service.profilStagiairesedit', compact('profil'));
   }

   // Fonction pour mettre à jour un profil de stagiaire
   public function profilStagiairesUpdate(Request $request, $id)
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

       $profil = Profilstagiaires::findOrFail($id);
       $profil->update($request->all());

       return redirect()->route('chef_service.profilStagiairesliste')->with('success', 'Profil de stagiaire mis à jour avec succès!');
   }
   // Fonction pour supprimer un profil de stagiaire
   public function profilStagiairesDestroy($id)
   {
       $personnel = Profilstagiaires::findOrFail($id);
       $personnel->delete();

       return redirect()->route('chef_service.profilStagiairesliste')->with('success', 'Profil de stagiaire supprimé avec succès');
   }




//Affichage du formulaire dajout dun employe
 public function ajoutemploye()
 {
     return view('employe.ajoutemploye');
 }
 //Affichage du formulaire dajout du stagiaire
 public function ajoutstagiaire()
 {
     return view('stagiaires.ajoutstagiaire');
 }

 public function indexEmploye()
 {
     $employes = Employe::all(); // Utilisation de Employes::all() pour récupérer tous les employés
     return view('chef_service.indexEmploye', compact('employes'));
 }
 public function indexStagiaires()
 {
     $stagiaires = Stagiaires::all();
     return view('chef_service.indexStagiaires', compact('stagiaires'));
 }
}
