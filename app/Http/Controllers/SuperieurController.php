<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\Employe;
use App\Models\Superieur;
use App\Models\Chefservice;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Profilemployes;
use App\Mail\ConfirmemployeMail;
use App\Models\Profilstagiaires;
use App\Models\Profilchefservice;
use App\Models\ResetCodePassword;
use App\Http\Middleware\Stagiaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Notifications\RegisteredUser;
use Illuminate\Auth\Events\Registered;
use App\Mail\ComfirmemployeMailActiver;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\submitDefineAccessRequest;
use App\Notifications\SendEmailToChefserviceAfterRegistrationNotification;

class SuperieurController extends Controller
{
    // Ajout du middleware 'stagiaire' au constructeur
    // public function __construct()
    // {
    //     $this->middleware('superieur');
    // }

    public function accueil(){
        return view('superieur.accueil');
     }
     public function appreciation(){
        return view('superieur.appreciation');
     }
     public function index_appreciation()
     {
         $superieurs = Superieur::all(); // Récupère toutes les appréciations
         return view('superieur.index_appreciation', compact('superieurs'));
     }

     public function storeAppreciation(Request $request)
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

         Superieur::create([
             'nom' => $request->nom,
             'domaine' => $request->domaine,
             'ponctualite' => $request->ponctualite,
             'assiduite' => $request->assiduite,
             'creativite' => $request->creativite,
             'engagement' => $request->engagement,
             'motivation' => $request->motivation,
             'initiative' => $request->initiative,
             'sociabilite' => $request->sociabilite,
             'gout_risque' => $request->gout_risque,
             'autres_appreciations' => $request->autres_appreciations,
         ]);

         return redirect()->route('superieur.index_appreciation')->with('success', 'Appréciation ajoutée avec succès!');
     }

     public function edit_appreciation($id)
     {
         $superieur = Superieur::findOrFail($id); // Utilisation de Superieur::findOrFail() pour trouver un supérieur par son ID
         return view('superieur.edit_appreciation', compact('superieur'));
     }

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

         $superieur = Superieur::findOrFail($id);
         $superieur->update($request->all());

         return redirect()->route('superieur.index_appreciation')->with('success', 'Appréciation modifiée avec succès!');
     }

     public function destroy_appreciation($id)
     {
         $superieur = Superieur::findOrFail($id); // Utilisation de Superieur::findOrFail() pour trouver un supérieur par son ID
         $superieur->delete();

         return redirect()->route('superieur.index_appreciation')->with('success', 'Appréciation supprimée avec succès');
     }




}
