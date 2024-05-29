<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\Employe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\EmployeMailActiver;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\submitDefineAccessRequest;
use App\Notifications\SendEmailToEmployeAfterRegistrationNotification;
use App\Notifications\SendEmailToStagiaireAfterRegistrationNotification;
use App\Notifications\SendEmailToChefserviceAfterRegistrationNotification;

class EmployeController extends Controller
{
    // Ajout du middleware 'employe' au constructeur

 public function __construct()
 {

     $this->middleware('employe');
    //  $this->middleware('Chefservice')->only('create');
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
         'date_debut' => 'required|date',
         'localisation' => 'required|string',
         'numero_urgence' => 'required|string',
     ]);

     Employe::create([ // Utilisation de Employes::create() pour créer un nouvel employé
         'nom' => $request->nom,
         'numero' => $request->numero,
         'domaine' => $request->domaine,
         'date_debut' => $request->date_debut,
         'localisation' => $request->localisation,
         'numero_urgence' => $request->numero_urgence,
     ]);

     return redirect()->route('employe.index')->with('success', 'Collaborateur ajouté avec succès!');
 }

 public function edit($id)
 {
     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     return view('employe.edit', compact('employe'));
 }

 public function update(Request $request, $id)
 {

    //  dd($request->all());
     $request->validate([
         'nom' => 'required|string',
         'numero' => 'required|string',
         'domaine' => 'required|string',
         'date_debut' => 'required|date',
         'localisation' => 'required|string',
         'numero_urgence' => 'required|string',
     ]);

     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
    //  dd($employe);
     $employe->update($request->all());
    //  dd($employe);
     //dd($employe); // Pour voir les données de l'employé après mise à jour
     return redirect()->route('employe.index')->with('success', 'Collaborateur modifié avec succès!');
 }

 public function destroy($id)
 {
     $employe = Employe::findOrFail($id); // Utilisation de Employes::findOrFail() pour trouver un employé par son ID
     $employe->delete();

     return redirect()->route('employe.index')->with('success', ' Collaborateur supprimé avec succès');
 }
       // Fonction pour afficher le formulaire pour ajouter un nouveau profil de stagiaire
    public function profilForm()
    {
        return view('employe.profilForm');
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
            'numero_pere' => $request->numero_pere ,
            'numero_mere' =>$request->numero_mere ,
            'numero_urgence' => $request->numero_urgence,
            'users_id' =>$id,
        ]);
        return redirect()->route('employe.profilListe')->with('success', 'Profil de collaborateur ajouté avec succès!');
    }

    // Fonction pour afficher la liste des profils de stagiaires
    public function profilListe()
    {
        $profils = Profilemployes::all();
        return view('employe.profilListe', compact('profils'));
    }

    // Fonction pour afficher le formulaire de modification d'un profil de stagiaire
    public function profilEdit($id)
    {
        $profil = Profilemployes::findOrFail($id);
        return view('employe.profilEdit', compact('profil'));
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

        $profil = Profilemployes::findOrFail($id);
        $profil->update($request->all());

        return redirect()->route('employe.profilListe')->with('success', 'Profil de collaborateur mis à jour avec succès!');
    }

    // Fonction pour supprimer un profil de stagiaire
    public function profilDestroy($id)
    {
        $profil = Profilemployes::findOrFail($id);
        $profil->delete();

        return redirect()->route('employe.profilListe')->with('success', 'Profil de collaborateur supprimé avec succès');
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

    // public function store(StoreOrganisateurRequest $request)
    // {
    //     try {
    //         $user = new User();
    //         $user->nom = $request->nom; // Modifier en fonction de votre schéma
    //         $user->prenom = $request->prenom; // Modifier en fonction de votre schéma
    //         $user->email = $request->email;
    //         $user->password = Hash::make('default');
    //         $user->is_admin = 2; // Rôle d'organisateur
    //         $user->save();

    //         // Envoyer un email pour que l'organisateur puisse confirmer son compte

    //         // Envoyer un code par email pour vérification
    //         if ($user) {
    //             try {
    //                 ResetCodePassword::where('email', $user->email)->delete();
    //                 $code = rand(1000, 4000);
    //                 $data = [
    //                     'code' => $code,
    //                     'email' => $user->email
    //                 ];
    //                 ResetCodePassword::create($data);
    //                 Notification::route('mail', $user->email)->notify(new SendEmailToOrganisateurAfterRegistrationNotification($code, $user->email));

    //                 return redirect()->route('organisateurs')->with('success_message', 'Organisateur ajouté');
    //             } catch (Exception $e) {
    //                 throw new Exception('Une erreur est survenue lors de l\'envoi du mail');
    //             }
    //         }
    //     } catch (Exception $e) {
    //         throw new Exception('Une erreur est survenue lors de la création de cet organisateur');
    //     }
    // }





}
