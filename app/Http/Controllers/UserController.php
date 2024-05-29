<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\Employe;
use App\Models\Stagiaires;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Profilemployes;
use App\Mail\EmployeMailActiver;
use App\Models\ResetCodePassword;
use App\Mail\SuperieurMailActiver;
use App\Mail\StagiairesMailActiver;
use App\Mail\ChefserviceMailActiver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use App\Mail\ComfirmemployeMailActiver;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\submitDefineAccessRequest;
use App\Notifications\SendEmailToEmployeAfterRegistrationNotification;

class UserController extends Controller
{
    public function registerEmploye(Request $request)
    {
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
            // dd('ssss');

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 4,
            'confirmation_token' => Str::random(32),
        ]);

        $findUserByEmail= User::where('email',$request->email )->first();
        // dd($findUserByEmail);
        $id=$findUserByEmail->id;
        $userName=$findUserByEmail->name;
        Mail::to($request->email)->send(new EmployeMailActiver($id,$userName));
        // Notification de l'utilisateur inscrit
        // event(new Registered($employe));
        // $employe->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
    }


    public function registerStagiaire(Request $request)
    {
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
        // dd('ssss');

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 5,
                'confirmation_token' => Str::random(32),
            ]);


            $findUserByEmail= User::where('email',$request->email )->first();
            // dd($findUserByEmail);
            $id=$findUserByEmail->id;
            $userName=$findUserByEmail->name;
            Mail::to($request->email)->send(new StagiairesMailActiver($id,$userName));
            // Notification de l'utilisateur inscrit
            // event(new Registered($employe));
            // $employe->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
    }

    public function registerChefservice(Request $request)
    {
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
            // dd('ssss');

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 3,
            'confirmation_token' => Str::random(32),
        ]);

        $findUserByEmail= User::where('email',$request->email )->first();
        $id=$findUserByEmail->id;
        $userName=$findUserByEmail->name;
        // dd($findUserByEmail);
        Mail::to($request->email)->send(new ChefserviceMailActiver(  $id,$userName));
        // Notification de l'utilisateur inscrit
        // event(new Registered($employe));
        // $employe->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
    }

    public function registerSuperieur(Request $request)
    {
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
        // dd('ssss');

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 2,
                'confirmation_token' => Str::random(32),
            ]);

            $findUserByEmail= User::where('email',$request->email )->first();
            $id=$findUserByEmail->id;
            $userName=$findUserByEmail->name;
            // dd($findUserByEmail);
            Mail::to($request->email)->send(new SuperieurMailActiver( $id,$userName));
    // Notification de l'utilisateur inscrit
    // event(new Registered($employe));
    // $employe->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
    }

    public function activerCompte($id)
    {
        $findUserById= User::where('id',$id)->first();
        $findUserById->update(['etat_compte' =>1]);

        return redirect('/login')->with('success', 'Votre compte a été bien activé');

    }
    public function defineAccessStagiaire($email)
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

 public function submitDefineAccessStagiaire(submitDefineAccessRequest $request)
{
 try {
     // Recherche de l'utilisateur dans la table users avec le rôle d'organisateur
     $user = User::where('email', $request->email)->where('is_admin', 5)->first();

     if ($user) {
         // Mise à jour du mot de passe et de la date de vérification de l'email
         $user->password = Hash::make($request->password);
         $user->email_verified_at = now();
         $user->save();
         $findUserById= User::where('email',$user->email)->first();
         $findUserById->update(['etat_compte' =>1]);
         // Suppression du code de réinitialisation s'il existe
         ResetCodePassword::where('email', $user->email)->delete();

         // Redirection vers la page de connexion avec un message de succès
         return redirect()->route('login')->with('success', 'Vos accès ont correctement été définis.');
     } else {
         // Redirection vers la page de connexion avec un message d'erreur
         return redirect()->route('login')->with('error', 'Aucun organisateur trouvé avec cet email.');
     }
 } catch (Exception $e) {
     // Gestion des erreurs
     return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
 }
}

public function defineAccess($email)
{
    // Vérifier si l'email existe dans la table des utilisateurs avec le rôle d'organisateur
    $user = User::where('email', $email)->where('is_admin', 4)->first();

    if($user) {
        // Si l'utilisateur est trouvé, afficher la vue pour valider le compte
        return view('auth.validate-account', compact('email'));
    } else {
        // Rediriger vers la page de connexion
        return redirect()->route('login');
    }
}

public function submitDefineAccess(submitDefineAccessRequest $request)
{
try {
    // Recherche de l'utilisateur dans la table users avec le rôle d'organisateur
    $user = User::where('email', $request->email)->where('is_admin', 4)->first();

    if ($user) {
        // Mise à jour du mot de passe et de la date de vérification de l'email
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        //dd('$findUserById');
        $findUserById= User::where('email',$user->email)->first();
        $findUserById->update(['etat_compte' =>1]);
        // Suppression du code de réinitialisation s'il existe
        ResetCodePassword::where('email', $user->email)->delete();

        // Redirection vers la page de connexion avec un message de succès
        return redirect()->route('login')->with('success', 'Vos accès ont correctement été définis.');
    } else {
        // Redirection vers la page de connexion avec un message d'erreur
        return redirect()->route('login')->with('error', 'Aucun organisateur trouvé avec cet email.');
    }
} catch (Exception $e) {
    // Gestion des erreurs
    return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
}
}


}
