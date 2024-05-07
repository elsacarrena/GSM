 <?php
/*use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StagiaireController;


use App\Http\Controllers\DepartementController;
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

//Route::get('/', function () {
  //  return view('welcome');
//});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





//Route::get('/home', function () {
  //  return view('auth/login');
  //});


  //Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



  //Route::get('/register', function(){
    //return view('auth/register');
  //})->name('register');
  //Route::post('/register', 'Auth\RegisterController@register')->name('register');
//   Route:: post('auth/register', [RegisterController::class, 'register'])->name('register');





/*Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');
  Route::middleware(['auth'])->group(function () {});    // web.php
    Route::get('/personnel', [PersonnelController::class, 'create'])->name('personnel.index');
     Route::get('/departements', [DepartementController::class, 'create'])->name('departements.index');



Route::prefix('personnel')->middleware(['auth', 'personnel'])->group(function (){
    Route::get('/personnel/index', [PersonnelController::class, 'index'])->name('personnel.index');



     Afficher le formulaire pour créer un nouvel étudiant
    Route::get('/personnel/create', [PersonnelController::class, 'create'])->name('personnel.create');
     Routes pour les vues spécifiques des employés et des stagiaires


    Stocker les données d'un nouvel étudiant
     Route::post('/personnel/store', [PersonnelController::class, 'store'])->name('personnel.store');

    Route::get('/personnel/{id}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');

   // Mettre à jour les informations d'un étudiant
    Route::put('/personnel/{id}/update', [PersonnelController::class, 'update'])->name('personnel.update');

    // Supprimer un étudiant
   Route::delete('/personnel/{id}/destroy', [PersonnelController::class, 'destroy'])->name('personnel.destroy');

   });
   Route::prefix('stagiaires')->middleware(['auth', 'stagiaire'])->group(function (){
    Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');

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
    Route::get('/employe/create', [App\Http\Controllers\EmployeController::class, 'employe.create'])->name('employe.create');

  });
  Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaire.home');
    Route::post('/stagiaires/store', [StagiaireController::class, 'store'])->name('stagiaires.store');
    Route::get('/stagiaires/index', [StagiaireController::class, 'index'])->name('stagiaires.index');

    //Route::get('/stagiaires/create', [App\Http\Controllers\StagiaireController::class, 'create'])->name('stagiaires.create');
    //Route::get('/stagiaires/index', [App\Http\Controllers\StagiaireController::class, 'index'])->name('stagiaires.index');

  });



  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Auth::routes();



 */
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



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





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
 Route::get('/employe/profilform', [EmployeController::class, 'profilform'])->name('employe.profilform');

 // Ajout d'un nouveau profil de stagiaire
 Route::post('/employe/profilstore', [EmployeController::class, 'storeProfil'])->name('employe.profilStore');

 // Affichage de la liste des profils de stagiaires
 Route::get('/employe/profilliste', [EmployeController::class, 'profilliste'])->name('employe.profilliste');

 // Affichage du formulaire de modification d'un profil de stagiaire
 Route::get('/employe/profil/{profil}/edit', [EmployeController::class, 'profiledit'])->name('employe.profiledit');

 // Mise à jour des informations d'un profil de stagiaire
 Route::put('/employe/profil/{profil}', [EmployeController::class, 'profilUpdate'])->name('employe.profilUpdate');

 // Suppression d'un profil de stagiaire
 Route::delete('/employe/profil/{profil}', [EmployeController::class, 'profilDestroy'])->name('employe.profilDestroy');
 Route::get('/employe/accueil', [EmployeController::class, 'accueil'])->name('employe.accueil');

});

Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaire.home');
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
 Route::get('/stagiaires/profilform', [StagiaireController::class, 'profilform'])->name('stagiaires.profilform');

 // Ajout d'un nouveau profil de stagiaire
 Route::post('/stagiaires/profilstore', [StagiaireController::class, 'storeProfil'])->name('stagiaires.profilStore');

 // Affichage de la liste des profils de stagiaires
 Route::get('/stagiaires/profilliste', [StagiaireController::class, 'profilliste'])->name('stagiaires.profilliste');

 // Affichage du formulaire de modification d'un profil de stagiaire
 Route::get('/stagiaires/profil/{profil}/edit', [StagiaireController::class, 'profiledit'])->name('stagiaires.profiledit');

 // Mise à jour des informations d'un profil de stagiaire
 Route::put('/stagiaires/profil/{profil}', [StagiaireController::class, 'profilUpdate'])->name('stagiaires.profilUpdate');

 // Suppression d'un profil de stagiaire
 Route::delete('/stagiaires/profil/{profil}', [StagiaireController::class, 'profilDestroy'])->name('stagiaires.profilDestroy');
 Route::get('/stagiaires/accueil', [StagiaireController::class, 'accueil'])->name('stagiaires.accueil');

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
 Route::get('/chef_service/profilform', [ChefserviceController::class, 'profilform'])->name('chef_service.profilform');

 // Ajout d'un nouveau profil de stagiaire
 Route::post('/chef_service/profilstore', [ChefserviceController::class, 'storeProfil'])->name('chef_service.profilStore');

 // Affichage de la liste des profils de stagiaires
 Route::get('/chef_service/profilliste', [ChefserviceController::class, 'profilliste'])->name('chef_service.profilliste');

 // Affichage du formulaire de modification d'un profil de stagiaire
 Route::get('/chef_service/profil/{profil}/edit', [ChefserviceController::class, 'profiledit'])->name('chef_service.profiledit');

 // Mise à jour des informations d'un profil de stagiaire
 Route::put('/chef_service/profil/{profil}', [ChefserviceController::class, 'profilUpdate'])->name('chef_service.profilUpdate');

 // Suppression d'un profil de stagiaire
 Route::delete('/chef_service/profil/{profil}', [ChefserviceController::class, 'profilDestroy'])->name('chef_service.profilDestroy');

 Route::get('/chef_service/accueil', [ChefserviceController::class, 'accueil'])->name('chef_service.accueil');


  });



  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Auth::routes();
