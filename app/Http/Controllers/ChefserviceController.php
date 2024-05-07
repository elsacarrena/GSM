<?php
namespace App\Http\Controllers;
// namespace App\Http\Controllers;
// use App\Models\Chefservice;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chefservice;
// // use App\Models\Stagiaires;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;
// use App\Notifications\RegisteredUser;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Request

// use Illuminate\Support\Facades\Validator;





// use App\Http\Middleware\chefservice;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilchefservice;

// use App\Http\Middleware\chefservice;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Support\Facades\Validator;







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

// Fonction pour afficher le formulaire pour ajouter un nouvel employé
public function profilForm()
{
    return view('chef_service.profilform');
}

// Fonction pour enregistrer un nouvel employé
public function storeProfil(Request $request)
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

    Profilchefservice::create($request->all());

    return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service ajouté avec succès!');


}

// Fonction pour afficher la liste des profils d'employés
public function profilListe()
{
    $profils = Profilchefservice::all();
    return view('chef_service.profilliste', compact('profils'));
}

// Fonction pour afficher le formulaire de modification d'un profil d'employé
public function profilEdit($id)
{
    $profil = Profilchefservice::findOrFail($id);
    return view('chef_service.profiledit', compact('profil'));
}

// Fonction pour mettre à jour un profil d'employé
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

    $profil = Profilchefservice::findOrFail($id);
    $profil->update($request->all());

    return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service ajouté avec succès!');

}

// Fonction pour supprimer un profil d'employé
public function profilDestroy($id)
{
    $personnel = Profilchefservice::findOrFail($id);
    $personnel->delete();

    return redirect()->route('chef_service.profilListe')->with('success', 'Profil de chef de service ajouté avec succès!');

}
public function accueil(){
    return view('stagiaires.accueil');
 }

 public function confirm($id, $token) {
    $chefservice =Chefservice::where('id', $id)->where('confirmation_token', $token)->first();

    if ($chefservice) {
        $chefservice->update(['confirmation_token' => null]);
        // $this->guard()->login($user);
        return redirect('/login')->with('success', 'Votre compte est activé. Vous pouvez à présent vous connecter.');
    } else {
        return redirect('/login')->with('error', 'Ce lien ne semble plus valide.');
    }
}

public function register(Request $request)
{
    dd('dd');
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]
    , [
        'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.'
    ]
);

    // Création de l'utilisateur
    $User =User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_admin'=>3,
        'confirmation_token' => Str::random(32),
    ]);

    // $findUserByEmail= User::where('email',$request->email )->first();
    //     dd($findUserByEmail);
    //     Mail::to($request->email)->send(new Chef_serviceMailActiver($id));

    return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
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
//     return Stagiaires::create([
//         'name' => $data['name'],
//         'email' => $data['email'],
//         'password' => Hash::make($data['password']),
//         'confirmation_token' => Str::random(32),
//     ]);
// }
}


