<?php

// namespace App\Http\Controllers;
// use App\Models\User;
// use App\Models\Superieur;

// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Notifications\RegisteredUser;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Employe;
use App\Models\Superieur;
use App\Models\Stagiaires;
use App\Models\Chefservice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\ConfirmemployeMail;
use App\Models\Profilstagiaires;
use App\Models\Profilchefservice;
use App\Models\ResetCodePassword;
// use Illuminate\Support\Facades\Log;
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
use App\Notifications\SendEmailToChefserviceAfterRegistrationNotification;

class SuperieurController extends Controller
{
   // Ajout du middleware 'stagiaire' au constructeur
    public function __construct()
    {
        $this->middleware('superieur');
    }

    public function accueil(){
        return view('superieur.accueil');
     }

// Méthode pour ajouter les informations personnelles d'un employé
// public function ajouterInfoEmploye(Request $request)
// {
//     $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required',
//         'domaine' => 'required|string',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required',
//     ]);

//     Employe::create($request->all());

//     return redirect()->route('superieur.accueil')->with('success', 'Informations de l\'employé ajoutées avec succès');
// }

// Méthode pour modifier les informations personnelles d'un employé
// public function modifierInfoEmploye(Request $request, $id)
// {
//     $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required',
//         'domaine' => 'required|string',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required',
//     ]);

//     $employe = Employe::findOrFail($id);
//     $employe->update($request->all());

//     return redirect()->route('superieur.accueil')->with('success', 'Informations de l\'employé mises à jour avec succès');
// }

// Méthode pour supprimer les informations personnelles d'un employé
// public function supprimerInfoEmploye($id)
// {
//     $employe = Employe::findOrFail($id);
//     $employe->delete();

//     return redirect()->route('superieur.accueil')->with('success', 'Informations de l\'employé supprimées avec succès');
// }
// public function create(){
//     return view('superieur.create');
// }

// public function index()
// {
//     $employes = Employe::all(); // Utilisation de Employes::all() pour récupérer tous les employés
//     return view('superieur.index', compact('employes'));
// }

// public function store(Request $request)
// {
//     $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required|string',
//         'domaine' => 'required|string',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required|string',
//     ]);

//     Employe::create([ // Utilisation de Employes::create() pour créer un nouvel employé
//         'nom' => $request->nom,
//         'numero' => $request->numero,
//         'domaine' => $request->domaine,
//         'localisation' => $request->localisation,
//         'numero_urgence' => $request->numero_urgence,
//     ]);

//     return redirect()->route('employe.index')->with('success', 'Employé ajouté avec succès!');
// }

// public function edit($id)
// {
//     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
//     return view('superieur.edit', compact('employe'));
// }

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required|string',
//         'domaine' => 'required|string',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required|string',
//     ]);

//     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
//     $employe->update($request->all());

//     return redirect()->route('superieur.index')->with('success', 'Employé modifié avec succès!');
// }

// public function destroy($id)
// {
//     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
//     $employe->delete();

//     return redirect()->route('superieur.index')->with('success', 'Employé supprimé avec succès');
// }



public function profilForm()
{
    return view('superieur.create');
}

// Fonction pour enregistrer un nouveau profil demploye
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

    Profilemployes::create([
        'nom' => $request->nom,
        'date_naissance' => $request->date_naissance,
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
    return redirect()->route('superieur.index')->with('success', 'Profil de stagiaire ajouté avec succès!');
}

// Fonction pour afficher la liste des profils demploye
public function profilListe()
{
    $profils = Profilemployes::all();
    return view('superieur.index', compact('profils'));
}

// Fonction pour afficher le formulaire de modification d'un profil demploye
public function profilEdit($id)
{
    $profil = Profilemployes::findOrFail($id);
    return view('superieur.edit', compact('profil'));
}

// Fonction pour mettre à jour un profil demploye
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

    $profil = Profilemployes::findOrFail($id);
    $profil->update($request->all());

    return redirect()->route('superieur.index')->with('success', 'Profil employe à jour avec succès!');
}

// Fonction pour supprimer un profil  demploye
public function profilDestroy($id)
{
    $profil = Profilemployes::findOrFail($id);
    $profil->delete();

    return redirect()->route('superieur.index')->with('success', 'Profil employé supprimé avec succès');
}
// public function accueil(){
//     return view('superieur.accueil');
//  }

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




// protected function validator(array $data)
// {
//     return Validator::make($data, [
//         'name' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//         'password' => ['required', 'string', 'min:8', 'confirmed'],
//     ], [
//         'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
//         'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.'
//     ]);
// }




   public function accueill(){
    return view('superieur.accueil');
 }

//  public function registerEmployee(Request $request)
//  {
//      // Validez les données reçues depuis le formulaire
//      $validatedData = $request->validate([
//          'name' => 'required|string',
//          'email' => 'required|email|unique:users,email',
//          'password' => 'required|min:8|confirmed',
//      ]);

//      // Générez un code aléatoire
//      $code = mt_rand(100000, 999999);

//      // Enregistrez l'employé dans la base de données (utilisant le modèle User)
//      $user = new User;
//      $user->name = $validatedData['name'];
//      $user->email = $validatedData['email'];
//      $user->password = Hash::make($validatedData['password']);
//      $user->confirmation_code = $code;
//      $user->save();

//      // Envoyez un email avec le code de confirmation
//      Mail::to($validatedData['email'])->send(new  ComfirmemployeMailActiver($code));

//      // Redirigez l'utilisateur ou effectuez toute autre action nécessaire
//      return redirect()->route('confirmation_required')->with('success', 'Un email de confirmation a été envoyé à votre adresse. Veuillez vérifier votre boîte de réception.');
//  }

//Affichage du formulaire dajout dun employe
 public function createEmploye()
 {
     return view('employe.ajout');
 }
 //Affichage du formulaire dajout du stagiaire
 public function createstagiaire()
 {
     return view('stagiaires.ajout_stagiaire');
 }
//Affichage du formulaire dajout dun chefservice
 public function createchefservice()
 {
     return view('chef_service.ajout_chefservice');
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
         return redirect()->route('superieur.IndexEmploye')->with('success_message', 'Employé ajouté');
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
    $user->is_admin = 5; // Rôle de stagiaire
    $user->save();

    // Envoyer un email pour que le stagiaire puisse confirmer son compte

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

        // return redirect()->route('superieur.index')->with('success_message', 'Stagiaire ajouté');
        return redirect()->route('superieur.IndexStagiaire')->with('success_message', 'Stagiaire ajouté');
    }
}

//Validation ^pour le stagiaire
public function defineAcces($email)
    {
        // Vérifier si l'email existe dans la table des utilisateurs avec le rôle d'organisateur
        $user = User::where('email', $email)->where('is_admin', 5)->first();

        if($user) {
            // Si l'utilisateur est trouvé, afficher la vue pour valider le compte
            return view('auth.validation-account', compact('email'));
        } else {
            // Rediriger vers la page de connexion
            return redirect()->route('login');
        }
    }

    public function submitDefineAcces(submitDefineAccessRequest $request)
{
    try {
        // Recherche de l'utilisateur dans la table users avec le rôle d'organisateur
        $user = User::where('email', $request->email)->where('is_admin',5)->first();

        if ($user) {
            // Mise à jour du mot de passe et de la date de vérification de l'email
            $user->password = Hash::make($request->password);
            $user->email_verified_at = now();
            $user->save();
      // Rôle d'organisateur
      dd('rrttr');
            $findUserById= User::where('email',$user->email)->first();
            $findUserById->update(['etat_compte' =>1]);

            // Suppression du code de réinitialisation s'il existe
            ResetCodePassword::where('email', $user->email)->delete();

            // Redirection vers la page de connexion avec un message de succès
            return redirect()->route('login')->with('success_message', 'Vos accès ont correctement été définis.');
        } else {
            // Redirection vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with('error_message', 'Aucun organisateur trouvé avec cet email.');
        }
    } catch (Exception $e) {
        // Gestion des erreurs
        return redirect()->back()->with('error_message', 'Une erreur est survenue. Veuillez réessayer.');
}
}


 // Fonction pour afficher le formulaire pour ajouter un nouveau profil de stagiaire
 public function profilFormStagiaire()
 {
     return view('superieur.profilFormStagiaire');
 }
  //Fonction pour enregistrer un nouveau profil de stagiaire
 public function storeProfilStagiaire(Request $request)
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
      'date_naissance' => $request->date_naissance,
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


     return redirect()->route('superieur.profilListeStagiaire')->with('success', 'Profil de stagiaire ajouté avec succès!');

 }

 // Fonction pour afficher la liste des profils de stagiaires
 public function profilListeStagiaire()
 {
     $profils = Profilstagiaires::all();
     return view('superieur.profilListeStagiaire', compact('profils'));
 }

 // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
 public function profilEditStagiaire($id)
 {
     $profil = Profilstagiaires::findOrFail($id);
     return view('superieur.profilEditStagiaire', compact('profil'));
 }

 // Fonction pour mettre à jour un profil de stagiaire
 public function profilUpdateStagiaire(Request $request, $id)
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

     $profil = Profilstagiaires::findOrFail($id);
     $profil->update($request->all());

     return redirect()->route('superieur.profilListeStagiaire')->with('success', 'Profil de stagiaire mis à jour avec succès!');
 }
 // Fonction pour supprimer un profil de stagiaire
 public function profilDestroyStagiaire($id)
 {
     $personnel = Profilstagiaires::findOrFail($id);
     $personnel->delete();

     return redirect()->route('superieur.profilListeStagiaire')->with('success', 'Profil de stagiaire supprimé avec succès');
 }

//pour le chef service
public function storeChefservice(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('default');
    $user->is_admin = 3; // Rôle de chef de service
    $user->save();

    // Envoyer un email pour que le chef de service puisse confirmer son compte

    // Envoyer un code par email pour vérification
    if ($user) {
        ResetCodePassword::where('email', $user->email)->delete();
        $code = rand(1000, 4000);
        $data = [
            'code' => $code,
            'email' => $user->email
        ];
        ResetCodePassword::create($data);
        Notification::route('mail', $user->email)->notify(new SendEmailToChefserviceAfterRegistrationNotification($code, $user->email));

        // return redirect()->route('superieur.index')->with('success_message', 'Employé ajouté');
        return redirect()->route('superieur.IndexChefservice')->with('success_message', 'Chef de service ajouté');
    }
}

//pour chef service
public function definiAcces($email)
 {
     // Vérifier si l'email existe dans la table des utilisateurs avec le rôle d'organisateur
     $user = User::where('email', $email)->where('is_admin', 3)->first();

     if($user) {
         // Si l'utilisateur est trouvé, afficher la vue pour valider le compte
         return view('auth.validation-compte', compact('email'));
     } else {
         // Rediriger vers la page de connexion
         return redirect()->route('login');
     }
 }

 public function submitDefiniAcces(submitDefineAccessRequest $request)
{
 try {
     // Recherche de l'utilisateur dans la table users avec le rôle d'organisateur
     $user = User::where('email', $request->email)->where('is_admin', 3)->first();

     if ($user) {
         // Mise à jour du mot de passe et de la date de vérification de l'email
         $user->password = Hash::make($request->password);
         $user->email_verified_at = now();
         $user->save();

         // Suppression du code de réinitialisation s'il existe
         ResetCodePassword::where('email', $user->email)->delete();

         // Redirection vers la page de connexion avec un message de succès
         return redirect()->route('login')->with('success_message', 'Vos accès ont correctement été définis.');
     } else {
         // Redirection vers la page de connexion avec un message d'erreur
         return redirect()->route('login')->with('error_message', 'Aucun organisateur trouvé avec cet email.');
     }
 } catch (Exception $e) {
     // Gestion des erreurs
     return redirect()->back()->with('error_message', 'Une erreur est survenue. Veuillez réessayer.');
 }
}

 // Fonction pour afficher le formulaire pour ajouter un nouveau profil de chefservice
 public function profilFormChefservice()
 {
     return view('superieur.profilFormChefservice');
 }

 // Fonction pour enregistrer un nouveau profil de stagiaire
 public function storeProfilChefservice(Request $request)
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
     Profilchefservice::create([
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

     return redirect()->route('superieur.profilListeChefservice')->with('success', 'Profil de chef de service ajouté avec succès!');
 }

 // Fonction pour afficher la liste des profils de chefs de service
 public function profilListeChefservice()
 {
     $profils = Profilchefservice::all();
     return view('superieur.profilListeChefservice', compact('profils'));
 }

 // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
 public function profilEditChefservice($id)
 {
     $profil = Profilchefservice::findOrFail($id);
     return view('superieur.profilEditChefservice', compact('profil'));
 }

 // Fonction pour mettre à jour un profil de stagiaire
 public function profilUpdateChefservice(Request $request, $id)
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

     return redirect()->route('superieur.profilListeChefservice')->with('success', 'Profil de chef de service mis à jour avec succès!');
 }

 // Fonction pour supprimer un profil de chefservice
 public function profilDestroyChefservice($id)
 {
     $profil = Profilchefservice::findOrFail($id);
     $profil->delete();

     return redirect()->route('superieur.profilListeChefservice')->with('success', 'Profil de chef de service supprimé avec succès');
 }


//Information moins personnelles de lemploye

public function  EmployeForm(){
    return view('superieur.EmployeFormulaire');
}

public function IndexEmploye()
{
    $employes = Employe::all(); // Utilisation de Employes::all() pour récupérer tous les employés
    return view('superieur.IndexEmploye', compact('employes'));
}

public function storeEmp(Request $request)
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

    Employe::create([ // Utilisation de Employes::create() pour créer un nouvel employé
        'nom' => $request->nom,
        'numero' => $request->numero,
        'domaine' => $request->domaine,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'date_additionnelle' => $request->date_additionnelle,
        'localisation' => $request->localisation,
        'numero_urgence' => $request->numero_urgence,
    ]);

    return redirect()->route('superieur.IndexEmploye')->with('success', 'Employé ajouté avec succès!');
}

public function editEmploye($id)
{
    $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
    return view('superieur.ModifEmploye', compact('employe'));
}

public function updateEmploye(Request $request, $id)
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

    $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
    $employe->update($request->all());

    return redirect()->route('superieur.IndexEmploye')->with('success', 'Employé modifié avec succès!');
}

public function destroyEmploye($id)
{
    $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
    $employe->delete();

    return redirect()->route('superieur.IndexEmploye')->with('success', 'Employé supprimé avec succès');
}


public function createFormulaire(){
    return view('superieur.StagiaireFormulaire');
}

public function  IndexStagiaire()
{
    $stagiaires = Stagiaires::all();
    return view('superieur.IndexStagiaire', compact('stagiaires'));
}

public function  ModifStagiaire(Request $request)
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


        return redirect()->route('superieur.IndexStagiaire')->with('success', 'Stagiaire ajouté avec succès!');

}

public function  editStagiaire($id){
    $stagiaire = Stagiaires::findOrFail($id);
    return view('superieur.ModifStagiaire', compact('stagiaire'));
}

public function updateStagiaire(Request $request, $id)
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

    return redirect()->route('superieur.IndexStagiaire')->with('success', 'Membre modifié avec succès!');
}

public function destroyStagiaire($id)
{
    $stagiaire = Stagiaires::findOrFail($id);
    $stagiaire->delete();

    return redirect()->route('superieur.IndexStagiaire')->with('success', 'Membre supprimé avec succès');
}

// public function FormulaireChefService(){
//     return view('superieur.ChefServiceFormulaire');
// }

// public function IndexChefservice()
// {
//     $chefservice = Chefservice::all();
//     return view('superieur.IndexChefservice', compact('chefservice'));
// }

// public function ModifChefservice(Request $request)
// {
//    // dd('fgf');
//    $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required|string',
//         'domaine' => 'required|string',
//         'date_debut' => 'required|date',
//         'date_fin' => 'required|date',
//         'date_additionnelle' => 'required|date',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required|string',
//     ]);
//     $user = Auth::user();
//     $id = $user->id;
//     Chefservice::create([ // Utilisation de Employes::create() pour créer un nouvel employé
//         'nom' => $request->nom,
//         'numero' => $request->numero,
//         'domaine' => $request->domaine,
//         'date_debut' => $request->date_debut,
//         'date_fin' => $request->date_fin,
//         'date_additionnelle' => $request->date_additionnelle,
//         'localisation' => $request->localisation,
//         'numero_urgence' => $request->numero_urgence,
//         'users_id'=>$id,
//     ]);

//     return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service ajouté avec succès!');
// }

// public function editChefservice($id)
// {
//     $chefservice = Chefservice::findOrFail($id);
//     return view('superieur.ModifChefservice', compact('chefservice'));
// }

// public function updateChefservice(Request $request, $id)
// {
//     $request->validate([
//         'nom' => 'required|string',
//         'numero' => 'required|string',
//         'domaine' => 'required|string',
//         'date_debut' => 'required|date',
//         'date_fin' => 'required|date',
//         'date_additionnelle' => 'required|date',
//         'localisation' => 'required|string',
//         'numero_urgence' => 'required|string',
//     ]);

//     $chefservice = Chefservice::findOrFail($id);
//     $chefservice->update($request->all());

//     return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service modifié avec succès!');
// }

// public function destroyChefservice($id)
// {
//     $chefservice = Chefservice::findOrFail($id);
//     $chefservice->delete();

//     return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service supprimé avec succès');
// }

public function FormulaireChefService(){
    return view('superieur.ChefServiceFormulaire');
}

public function IndexChefservice()
{
    $chefservice = Chefservice::all();
    return view('superieur.IndexChefservice', compact('chefservice'));
}

public function ModifChefservice(Request $request)
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

    $user = Auth::user();
    $id = $user->id;
    Chefservice::create([
        'nom' => $request->nom,
        'numero' => $request->numero,
        'domaine' => $request->domaine,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'date_additionnelle' => $request->date_additionnelle,
        'localisation' => $request->localisation,
        'numero_urgence' => $request->numero_urgence,
        'users_id' => $id,
    ]);

    return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service ajouté avec succès!');
}

public function editChefservice($id)
{
    $chefservice = Chefservice::findOrFail($id);
    return view('superieur.ModifChefservice', compact('chefservice'));
}

public function updateChefservice(Request $request, $id)
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

    $chefservice = Chefservice::findOrFail($id);
    // dd($chefservice);
    $chefservice->update($request->all());

    return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service modifié avec succès!');
}

public function destroyChefservice($id)
{
    $chefservice = Chefservice::findOrFail($id);
    $chefservice->delete();

    return redirect()->route('superieur.IndexChefservice')->with('success', 'Chef de service supprimé avec succès');
}


}
