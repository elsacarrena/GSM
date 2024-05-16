<?php

use App\Http\Controllers\Chefservice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\SuperieurController;
use App\Http\Controllers\ChefserviceController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EnregistrerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});


Route::get('/home', function () {
    return view('auth/login');
});


Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/activer_compte/{id}', [UserController::class, 'activerCompte'])->name('activation.compte');

Route::get('/registeremploye', function(){
    return view('auth/registeremploye');
})->name('registeremploye');

Route::post('/register_employe', [UserController::class, 'registerEmploye'])->name('registeremploye_post');


// Route de confirmation de l'inscription
Route::get('/confirm/{id}/{token}', [EmployeController::class, 'confirm']);


Route::get('/registerstagiaires', function(){
    return view('auth/registerstagiaires');
})->name('registerstagiaires');
Route::post('/register_stagiaires', [UserController::class, 'registerStagiaire'])->name('registerstagiaires');

Route::get('/inscription_chefservice', function(){
    return view('auth/inscription_chefservice');
  })->name(' inscription_chefservice');
Route::post('/inscription_chefservice', [UserController::class, 'registerChefservice'])->name('inscription_chefservice');


Route::get('/inscription_superieur', function(){
    return view('auth/inscription_superieur');
    })->name('inscription_superieur ');
Route::post('/inscription_superieur', [UserController::class, 'registerSuperieur'])->name('inscription_superieur');



// Route de confirmation de l'inscription
Route::get('/confirm/{id}/{token}', [StagiaireController::class, 'confirm']);

Route::middleware(['auth'])->group(function () {

});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
});
Route::prefix('superieur')->middleware(['auth', 'superieur'])->group(function () {
    Route::get('/superieur/home', [App\Http\Controllers\HomeController::class, 'superieurHome'])->name('superieur.home');
    Route::get('/superieur/accueil', [SuperieurController::class, 'accueil'])->name('superieur.accueil');




});

Route::prefix('employe')->middleware(['auth', 'employe'])->group(function () {
    Route::get('/employe/home', [App\Http\Controllers\HomeController::class, 'employeHome'])->name('employe.home');

        // Affichage de la liste des employés
        Route::get('/employe/index', [EmployeController::class, 'index'])->name('employe.index');

        // Formulaire pour ajouter un nouvel employé
        Route::get('/employe/create', [EmployeController::class, 'create'])->name('employe.create');


        // Ajout d'un nouvel employé
        Route::post('/employe/store', [EmployeController::class, 'store'])->name('employe.store');

        // Formulaire pour modifier les informations d'un employé
        Route::get('/{employe}/edit', [EmployeController::class, 'edit'])->name('employe.edit');

        // Mise à jour des informations d'un employé
        Route::put('/{employe}',  [EmployeController::class, 'update'])->name('employe.update');

        // Suppression d'un employé
        Route::delete('/{employe}', [EmployeController::class, 'destroy'])->name('employe.destroy');

                    // Affichage du formulaire pour ajouter un nouveau profil de stagiaire
        Route::get('/employe/profilForm', [EmployeController::class, 'profilForm'])->name('employe.profilForm');

        // Ajout d'un nouveau profil de stagiaire
        Route::post('/employe/profilstore', [EmployeController::class, 'storeProfil'])->name('employe.profilStore');

        // Affichage de la liste des profils de stagiaires
        Route::get('/employe/profilListe', [EmployeController::class, 'profilListe'])->name('employe.profilListe');

        // Affichage du formulaire de modification d'un profil de stagiaire
        Route::get('/employe/profil/{profil}/edit', [EmployeController::class, 'profilEdit'])->name('employe.profilEdit');

        // Mise à jour des informations d'un profil de stagiaire
        Route::put('/employe/profil/{profil}', [EmployeController::class, 'profilUpdate'])->name('employe.profilUpdate');

        // Suppression d'un profil de stagiaire
        Route::delete('/employe/profil/{profil}', [EmployeController::class, 'profilDestroy'])->name('employe.profilDestroy');
        Route::get('/employe/accueil', [EmployeController::class, 'accueil'])->name('employe.accueil');
        Route::get('/employe/ajoutchefservice', [EmployeController::class, 'ajoutchefservice'])->name('employe.ajoutchefservice');

});

Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaires/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaires.home');
    // Affichage de la liste des   stagiaires
   Route::get('/stagiaires/index', [StagiaireController ::class, 'index'])->name('stagiaires.index');

   // Formulaire pour ajouter un nouvel stagiaire


   Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');

   // Ajout d'un nouvel  Personnel
   Route::post('/stagiaires/store', [StagiaireController::class, 'store'])->name('stagiaires.store');


   Route::get('/stagiaires/{stagiaire}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');

   // Mise à jour des informations d'un Personnel
   Route::put('/stagiaires/{stagiaire}',  [StagiaireController::class, 'update'])->name('stagiaires.update');
   // Suppression d'un    Personnels
   Route::delete('/stagiaires/{stagiaire}', [StagiaireController::class, 'destroy'])->name('stagiaires.destroy');


   // Affichage du formulaire pour ajouter un nouveau profil de stagiaire
    Route::get('/stagiaires/profilForm', [StagiaireController::class, 'profilForm'])->name('stagiaires.profilForm');

    // Ajout d'un nouveau profil de stagiaire
    Route::post('/stagiaires/profilstore', [StagiaireController::class, 'storeProfil'])->name('stagiaires.profilStore');

    // Affichage de la liste des profils de stagiaires
    Route::get('/stagiaires/profilListe', [StagiaireController::class, 'profilListe'])->name('stagiaires.profilListe');

    // Affichage du formulaire de modification d'un profil de stagiaire
    Route::get('/stagiaires/profil/{id}/edit', [StagiaireController::class, 'profilEdit'])->name('stagiaires.profilEdit');

    // Mise à jour des informations d'un profil de stagiaire
    Route::put('/stagiaires/profil/{id}', [StagiaireController::class, 'profilUpdate'])->name('stagiaires.profilUpdate');

    // Suppression d'un profil de stagiaire
    Route::delete('/stagiaires/profil/{id}', [StagiaireController::class, 'profilDestroy'])->name('stagiaires.profilDestroy');
    Route::get('/stagiaires/accueil', [StagiaireController::class, 'accueil'])->name('stagiaires.accueil');

   // Route::get('/stagiaires/ajoutchefservice', [StagiaireController::class, 'ajoutchefservice'])->name('stagiaires.ajoutchefservice');
    //Route::post('/employe/store', [SuperieurController::class, 'storeEmploye'])->name('employe.store');
    //Route::put('/update/{employe}',[SuperieurController::class,"updateEmploye"])->name('employe.updatee') ;
    //Route::get('/delete/{employe}',[SuperieurController::class,"deleteEmploye"])->name(' employe.delete') ;

});


Route::prefix('chefservice')->middleware(['auth', 'chefservice'])->group(function () {
    Route::get('/chefservice/home', [App\Http\Controllers\HomeController::class, 'chefserviceHome'])->name('chefservice.home');
    // Affichage de la liste des   stagiaires
   Route::get('/chef_service/index', [ChefserviceController ::class, 'index'])->name('chef_service.index');


   Route::get('/chef_service/create', [ChefserviceController::class, 'create'])->name('chef_service.create');

   // Ajout d'un nouvel  Personnel
   Route::post('/chef_service/store', [ChefserviceController::class, 'store'])->name('chef_service.store');


   Route::get('/chef_service/{chefservice}/edit', [ChefserviceController::class, 'edit'])->name('chef_service.edit');

   // Mise à jour des informations d'un Personnel
   Route::put('/chef_service/{chefservice}',  [ChefserviceController::class, 'update'])->name('chef_service.update');
   // Suppression d'un    Personnels
   Route::delete('/chef_service/{chefservice}', [ChefserviceController::class, 'destroy'])->name('chef_service.destroy');

     // Affichage du formulaire pour ajouter un nouveau profil de stagiaire
    Route::get('/chef_service/profilForm', [ChefserviceController::class, 'profilForm'])->name('chef_service.profilForm');

    // Ajout d'un nouveau profil de stagiaire
    Route::post('/chef_service/profilstore', [ChefserviceController::class, 'storeProfil'])->name('chef_service.profilStore');

    // Affichage de la liste des profils de stagiaires
    Route::get('/chef_service/profilListe', [ChefserviceController::class, 'profilListe'])->name('chef_service.profilListe');

    // Affichage du formulaire de modification d'un profil de stagiaire
    Route::get('/chef_service/profil/{id}/edit', [ChefserviceController::class, 'profilEdit'])->name('chef_service.profilEdit');

    // Mise à jour des informations d'un profil de stagiaire
    Route::put('/chef_service/profil/{id}', [ChefserviceController::class, 'profilUpdate'])->name('chef_service.profilUpdate');
    // Suppression d'un profil de stagiaire

    Route::delete('/chef_service/profil/{id}', [ChefserviceController::class, 'profilDestroy'])->name('chef_service.profilDestroy');


    Route::get('/chef_service/accueil', [ChefserviceController::class, 'accueil'])->name('chef_service.accueil');


    Route::get('/stagiaires/ajoutstagiaire', [ChefserviceController::class, 'ajoutstagiaire'])->name('stagiaires.ajoutstagiaire');
    Route::post('/stagiaires/store', [ChefserviceController::class, 'storeStagiaire'])->name('stagiaires.storeStagiaire');
    Route::put('/update/{stagiaire}',[ChefserviceController::class,"updateStagiaire"])->name('stagiaires.updateStagiaire') ;
    Route::get('/delete/{stagiaire}',[ChefserviceController::class,"deleteStagiaire"])->name(' stagiaires.deleteStagiaire') ;

    Route::get('/employe/ajoutemploye', [ChefserviceController::class, 'ajoutemploye'])->name('employe.ajoutemploye');
    Route::post('/employe/store', [ChefserviceController::class, 'storeEmploye'])->name('employe.storeEmploye');

    //Route::get('/chef_service/storeEmploye', [ChefserviceController::class, 'storeEmploye'])->name('chef_service.storeEmploye');
    Route::put('/update/{employe}',[ChefserviceController::class,"updateEmploye"])->name('employe.updateEmploye') ;
    Route::get('/delete/{employe}',[ChefserviceController::class,"deleteEmploye"])->name(' employe.deleteEmploye') ;

  });



//   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Auth::routes();
