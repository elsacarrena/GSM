<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employe;
use App\Models\Stagiaires;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\EmployeMailActiver;
use App\Mail\SuperieurMailActiver;
use App\Mail\StagiairesMailActiver;
use App\Mail\ChefserviceMailActiver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

}
