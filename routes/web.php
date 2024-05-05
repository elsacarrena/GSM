<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;

use App\Http\Controllers\stagiaireController;
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



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::get('/home', function () {
    return view('auth/login');
  });


  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



  Route::get('/register', function(){
    return view('register');
  })->name('register');
  Route:: post('registrer', [RegisterController::class, 'registrer'])->name('registrer');





Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');
  Route::middleware(['auth'])->group(function () {
//     // web.php
//     Route::get('/personnel', [PersonnelController::class, 'create'])->name('personnel.index');
//     Route::get('/departements', [DepartementController::class, 'create'])->name('departements.index');




     Route::get('/personnel/index', [PersonnelController::class, 'index'])->name('personnel.index');

    // Routes pour les étudiants
     //Route::resource('personnel', PersonnelController::class)->except('index');

       // Afficher le formulaire pour créer un nouvel étudiant
       Route::get('/personnel/create', [PersonnelController::class, 'create'])->name('personnel.create');
       // Routes pour les vues spécifiques des employés et des stagiaires


      // Stocker les données d'un nouvel étudiant
       Route::post('/personnel/store', [PersonnelController::class, 'store'])->name('personnel.store');
    //    Route::get('/employe', function () {
    //     return view('/employe/home');
    //     })->name('employe.home');

    // Route::get('/stagiaire/home', function () {
    //     return view('stagiaire/home');
    // })->name('stagiaire.home');

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

   // Affichage de la liste des    chefservices
   Route::get('/home', [ChefserviceController ::class, 'index'])->name('chef_service.index');

   // Formulaire pour ajouter un nouvel stagiaire
//    Route::get('/chef_service/create', function () {
//       return view('chef_service.create');
//    })->name('chef_service.create');
   Route::get('/chef_service/create', [ChefserviceController::class, 'create'])->name('chef_service.create');
   // Ajout d'un nouvel  Personnel
   Route::post('/chef_service/store', [ChefserviceController::class, 'store'])->name('chef_service.store');

   // Formulaire pour modifier les informations d'un   Employe

   // Route::get('/Personnels/{personnnel}/edit', [PersonnelController::class, 'edit'])->name('Personnels.edit');

   // // Mise à jour des informations d'un    Personnel
   // Route::put('/Personnels/{personnnel}',  [PersonnelController::class, 'update'])->name('Personnels.update');
   Route::get('/chef_service/{chef}/edit', [ChefserviceController::class, 'edit'])->name('chef_service.edit');

   // Mise à jour des informations d'un Personnel
   Route::put('/chef_service/{chef}',  [ChefserviceController::class, 'update'])->name('chef_service.update');
   // Suppression d'un    Personnels
   Route::delete('/chef_service/{chef}', [ChefserviceController::class, 'destroy'])->name('chef_service.destroy');

});
Route::prefix('employe')->middleware(['auth', 'employe'])->group(function () {
    Route::get('/employe/home', [App\Http\Controllers\HomeController::class, 'employeHome'])->name('employe.home');

        // Affichage de la liste des employés
        Route::get('/home', [EmployeController::class, 'index'])->name('employe.index');

        // Formulaire pour ajouter un nouvel employé
        Route::get('/create', function () {
            return view('employe.create');
        })->name('employe.create');

        // Ajout d'un nouvel employé
        Route::post('/employe.store', [EmployeController::class, 'store'])->name('employe.store');

        // Formulaire pour modifier les informations d'un employé
        Route::get('/{employe}/edit', [EmployeController::class, 'edit'])->name('employe.edit');

        // Mise à jour des informations d'un employé
        Route::put('/{employe}',  [EmployeController::class, 'update'])->name('employe.update');

        // Suppression d'un employé
        Route::delete('/{employe}', [EmployeController::class, 'destroy'])->name('employe.destroy');
    });

  Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaire.home');
    // Affichage de la liste des   stagiaires
   Route::get('/home', [stagiaireController ::class, 'index'])->name('stagiaires.index');

   // Formulaire pour ajouter un nouvel stagiaire


   Route::get('/stagiaires/create', [stagiaireController::class, 'create'])->name('stagiaires.create');

   // Ajout d'un nouvel  Personnel
   Route::post('/stagiaires/store', [stagiaireController::class, 'store'])->name('stagiaires.store');

   // Formulaire pour modifier les informations d'un   Employe

   // Route::get('/Personnels/{personnnel}/edit', [PersonnelController::class, 'edit'])->name('Personnels.edit');

   // // Mise à jour des informations d'un    Personnel
   // Route::put('/Personnels/{personnnel}',  [PersonnelController::class, 'update'])->name('Personnels.update');
   Route::get('/stagiaires/{stagiaire}/edit', [stagiaireController::class, 'edit'])->name('stagiaires.edit');

   // Mise à jour des informations d'un Personnel
   Route::put('/stagiaires/{stagiaire}',  [stagiaireController::class, 'update'])->name('stagiaires.update');
   // Suppression d'un    Personnels
   Route::delete('/stagiaires/{stagiaire}', [stagiaireController::class, 'destroy'])->name('stagiaires.destroy');

  });



  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Auth::routes();
