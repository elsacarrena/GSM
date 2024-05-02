<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class EnregistrerController extends Controller
{
    //
    public function afficheEnregistrer()
    {
        return view('enregistrer');
    }
    /**
     * Gère la soumission du formulaire d'enregistrement personnalisé.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enregistrer(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],


        ]);
        if($request->password == $request->password_confirmation){
            // dd($request->password);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return view('auth/login')->with( 'success','Votre compte a été bien créé, vous devez le confirmer avec le mail que vous recevrez');
        }
        else{
        return redirect()->route('register')->with('erreur', 'Veuillez réessayer.');
        }
    }
}


