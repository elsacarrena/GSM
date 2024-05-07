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

use App\Models\User;
use App\Models\Superieur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SuperieurController extends Controller
{
    // Ajout du middleware 'stagiaire' au constructeur
    // public function __construct()
    // {
    //     $this->middleware('superieur');
    // }

    // public function create(){
    //     return view('superieur.create');
    // }

    // public function index()
    // {
    //     $superieur = Superieur::all();
    //     return view('superieur.index', compact('superieur'));
    // }

    public function accueil(){
        return view('superieur.accueil');

    }

    // public function inscription_superieur(){
    //     return view('inscription_superieur');
    // }


    public function confirm($id, $token) {
        $superieur= Superieur::where('id', $id)->where('confirmation_token', $token)->first();

        if ($superieur) {
            $superieur->update(['confirmation_token' => null]);
            // $this->guard()->login($user);
            return redirect('/login')->with('success', 'Votre compte est activé. Vous pouvez à présent vous connecter.');
        } else {
            return redirect('/login')->with('error', 'Ce lien ne semble plus valide.');
        }
    }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     // Création de l'utilisateur
    //     $superieur=Superieur::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'confirmation_token' => Str::random(32),
    //     ]);
    //     // Notification de l'utilisateur inscrit
    //     event(new Registered($superieur));
    //     $superieur->notify(new RegisteredUser());

    //     return redirect('/login')->with('success', 'Votre compte a été bien créé. Un mail d\'activation vous a été envoyé dans votre adresse mail.');
    // }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirmation_token' => Str::random(32),
        ]);
        // Notification de l'utilisateur inscrit
        event(new Registered($user));
        $user->notify(new RegisteredUser());

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

