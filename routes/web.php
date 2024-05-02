<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\stagiaireController;

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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::get('/home', function () {
    return view('auth/login');
  });


  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



  Route::get('/register', function(){
    return view('register');
  })->name('register');
  Route:: post('registrer', [RegisterController::class, 'registrer'])->name('registrer');


  Auth::routes();


Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');
  Route::middleware(['auth'])->group(function () {


     Route::get('/personnel/index', [PersonnelController::class, 'index'])->name('personnel.index');


       // Afficher le formulaire pour créer un nouvel étudiant
       Route::get('/personnel/create', [PersonnelController::class, 'create'])->name('personnel.create');
       // Routes pour les vues spécifiques des employés et des stagiaires
       Route::post('/personnel/store', [PersonnelController::class, 'store'])->name('personnel.store');
<<<<<<< HEAD


=======
    //    Route::get('/employe', function () {
    //     return view('/employe/home');
    //     })->name('employe.home');

    // Route::get('/stagiaire/home', function () {
    //     return view('stagiaire/home');
    // })->name('stagiaire.home');
>>>>>>> bc0b862602472d9fa8a25254f11b139298523e23

      // Afficher le formulaire de modification d'un étudiant
       Route::get('/personnel/{id}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');

      // Mettre à jour les informations d'un étudiant
       Route::put('/personnel/{id}/update', [PersonnelController::class, 'update'])->name('personnel.update');

       // Supprimer un étudiant
      Route::delete('/personnel/{id}/destroy', [PersonnelController::class, 'destroy'])->name('personnel.destroy');

  });


  Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

});
Route::prefix('superieur')->middleware(['auth', 'superieur'])->group(function () {
    Route::get('/superieur/home', [App\Http\Controllers\HomeController::class, 'superieurHome'])->name('superieur.home');

});
Route::prefix('chefservice')->middleware(['auth', 'chefservice'])->group(function () {
  Route::get('/chefservice/home', [App\Http\Controllers\HomeController::class, 'chefserviceHome'])->name('chefservice.home');

});
Route::prefix('employe')->middleware(['auth', 'employe'])->group(function () {
    Route::get('/employe/home', [App\Http\Controllers\HomeController::class, 'employeHome'])->name('employe.home');
  });
  Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaire.home');
  });

  Auth::routes();

  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



  Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

});
Route::prefix('superieur')->middleware(['auth', 'superieur'])->group(function () {
    Route::get('/superieur/home', [App\Http\Controllers\HomeController::class, 'superieurHome'])->name('superieur.home');

});
Route::prefix('chefservice')->middleware(['auth', 'chefservice'])->group(function () {
  Route::get('/chefservice/home', [App\Http\Controllers\HomeController::class, 'chefserviceHome'])->name('chefservice.home');

});
Route::prefix('employe')->middleware(['auth', 'employe'])->group(function () {
    Route::get('/employe/home', [App\Http\Controllers\HomeController::class, 'employeHome'])->name('employe.home');
  });
//   Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
//     Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaire.home');
    Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
        // Page d'accueil des stagiaires
        Route::get('/home', [StagiaireController::class, 'index'])->name('home');

        // Affichage de la liste des stagiaires
        Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');

        // Ajout d'un nouveau stagiaire
        Route::post('/stagiaires', [StagiaireController::class, 'store'])->name('stagiaires.store');

        // Formulaire pour modifier les informations d'un stagiaire
        Route::get('/stagiaires/{stagiaire}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');

        // Mise à jour des informations d'un stagiaire
        Route::put('/stagiaires/{stagiaire}',  [StagiaireController::class, 'update'])->name('stagiaires.update');

        // Suppression d'un stagiaire
        Route::delete('/stagiaires/{stagiaire}', [StagiaireController::class, 'destroy'])->name('stagiaires.destroy');
    });

   









