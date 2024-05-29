<?php





use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\SuperieurController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChefServiceController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EnregistrerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
|
| C'est ici que vous pouvez enregistrer les routes web pour votre application.
| Ces routes sont chargées par le RouteServiceProvider et toutes seront
| affectées au groupe middleware "web". Faisons quelque chose de génial !
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
 Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('auth/login');
});

//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/activer_compte/{id}', [UserController::class, 'activerCompte'])->name('activation.compte');

Route::get('/registeremploye', function(){
    return view('auth/registeremploye');
})->name('registeremploye');

Route::post('/register_employe', [UserController::class, 'registerEmploye'])->name('registeremploye_post');

Route::get('/confirm/{id}/{token}', [EmployeController::class, 'confirm']);

Route::get('/registerstagiaires', function(){
    return view('auth/registerstagiaires');
})->name('registerstagiaires');
Route::post('/register_stagiaires', [UserController::class, 'registerStagiaire'])->name('registerstagiaires');

Route::get('/inscription_chefservice', function(){
    return view('auth/inscription_chefservice');
})->name('inscription_chefservice');
Route::post('/inscription_chefservice', [UserController::class, 'registerChefservice'])->name('inscription_chefservice');

Route::get('/inscription_superieur', function(){
    return view('auth/inscription_superieur');
})->name('inscription_superieur');
Route::post('/inscription_superieur', [UserController::class, 'registerSuperieur'])->name('inscription_superieur');

Route::get('/confirm/{id}/{token}', [StagiaireController::class, 'confirm']);

Route::middleware(['auth'])->group(function () {
    // Les routes authentifiées communes peuvent être placées ici
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
});

Route::prefix('superieur')->middleware(['auth', 'superieur'])->group(function () {
    Route::get('/superieur/home', [App\Http\Controllers\HomeController::class, 'superieurHome'])->name('superieur.home');
    Route::get('/superieur/accueil', [SuperieurController::class, 'accueil'])->name('superieur.accueil');
    Route::get('/superieur/index_appreciation', [SuperieurController::class, 'index_appreciation'])->name('superieur.index_appreciation');
    Route::get('/superieur/appreciation', [SuperieurController::class, 'appreciation'])->name('superieur.appreciation');
    Route::post('/superieur/storeAppreciation', [SuperieurController::class, 'storeAppreciation'])->name('superieur.storeAppreciation');
    Route::get('/superieur/{superieur}/edit', [SuperieurController::class, 'edit_appreciation'])->name('superieur.edit_appreciation');
    Route::put('/{superieur}', [SuperieurController::class, 'update_appreciation'])->name('superieur.update_appreciation');
    Route::delete('/{superieur}', [SuperieurController::class, 'destroy_appreciation'])->name('superieur.destroy_appreciation');
});

Route::prefix('employe')->middleware(['auth', 'employe'])->group(function () {
    Route::get('/employe/home', [App\Http\Controllers\HomeController::class, 'employeHome'])->name('employe.home');
    Route::get('/employe/index', [EmployeController::class, 'index'])->name('employe.index');
    Route::get('/employe/create', [EmployeController::class, 'create'])->name('employe.create');
    Route::post('/employe/store', [EmployeController::class, 'store'])->name('employe.store');
    Route::get('/{employe}/edit', [EmployeController::class, 'edit'])->name('employe.edit');
    Route::put('/{employe}', [EmployeController::class, 'update'])->name('employe.update');
    Route::delete('/{employe}', [EmployeController::class, 'destroy'])->name('employe.destroy');
    Route::get('/employe/profilform', [EmployeController::class, 'profilform'])->name('employe.profilform');
    Route::post('/employe/storeProfil', [EmployeController::class, 'storeProfil'])->name('employe.storeProfil');
    Route::get('/employe/profilliste', [EmployeController::class, 'profilListe'])->name('employe.profilliste');
    Route::get('/employe/profil/{profil}/edit', [EmployeController::class, 'profilEdit'])->name('employe.profiledit');
    Route::put('/employe/profil/{profil}', [EmployeController::class, 'profilUpdate'])->name('employe.profilUpdate');
    Route::delete('/employe/profil/{profil}', [EmployeController::class, 'profilDestroy'])->name('employe.profildestroy');
    Route::get('/employe/accueil', [EmployeController::class, 'accueil'])->name('employe.accueil');
});

Route::prefix('stagiaire')->middleware(['auth', 'stagiaire'])->group(function () {
    Route::get('/stagiaire/home', [App\Http\Controllers\HomeController::class, 'stagiaireHome'])->name('stagiaires.home');
    Route::get('/stagiaires/accueil', [StagiaireController::class, 'accueil'])->name('stagiaires.accueil');
    Route::get('/stagiaires/index', [StagiaireController::class, 'index'])->name('stagiaires.index');
    Route::get('/stagiaires/create', [StagiaireController::class, 'create'])->name('stagiaires.create');
    Route::post('/stagiaires/store', [StagiaireController::class, 'store'])->name('stagiaires.store');
    Route::get('/stagiaires/{stagiaire}/edit', [StagiaireController::class, 'edit'])->name('stagiaires.edit');
    Route::put('/{stagiaire}', [StagiaireController::class, 'update'])->name('stagiaires.update');
    Route::delete('/{stagiaire}', [StagiaireController::class, 'destroy'])->name('stagiaires.destroy');
    Route::get('/stagiaires/profilform', [StagiaireController::class, 'profilForm'])->name('stagiaires.profilform');
    Route::post('/stagiaires/profilstore', [StagiaireController::class, 'profilstore'])->name('stagiaires.profilstore');
    Route::get('/stagiaires/profilliste', [StagiaireController::class, 'profilListe'])->name('stagiaires.profilliste');
    Route::get('/stagiaires/profil/{profil}/edit', [StagiaireController::class, 'profilEdit'])->name('stagiaires.profiledit');
    Route::put('/stagiaires/profil/{profil}', [StagiaireController::class, 'profilUpdate'])->name('stagiaires.profilUpdate');
    Route::delete('/stagiaires/profil/{profil}', [StagiaireController::class, 'profilDestroy'])->name('stagiaires.profildestroy');
});




Route::prefix('chefservice')->middleware(['auth', 'chefservice'])->group(function () {
    Route::get('/chef_service/chefservice-home', [App\Http\Controllers\HomeController::class, 'chefserviceHome'])->name('chef_service.chefservice-home');
    Route::get('/chef_service/accueil', [ChefserviceController::class, 'accueil'])->name('chef_service.accueil');
    Route::get('/chef_service/index', [ChefserviceController::class, 'index'])->name('chef_service.index');
    Route::get('/chef_service/create', [ChefserviceController::class, 'create'])->name('chef_service.create');
    Route::post('/chef_service/store', [ChefserviceController::class, 'store'])->name('chef_service.store');
    Route::get('/chef_service/{chefservice}/edit', [ChefserviceController::class, 'edit'])->name('chef_service.edit');
    Route::put('/{chefservice}', [ChefserviceController::class, 'update'])->name('chef_service.update');
    Route::delete('/{chefservice}', [ChefserviceController::class, 'destroy'])->name('chef_service.destroy');


// Routes pour les employés
Route::get('/chef_service/indexEmploye', [ChefserviceController::class, 'indexEmploye'])->name('chef_service.indexEmploye');

Route::get('/chef_service/profilEmployeform', [ChefserviceController::class, 'profilEmployeform'])->name('chef_service.profilEmployeform');
Route::post('/chef_service/storeProfilEmploye', [ChefserviceController::class, 'storeProfilEmploye'])->name('chef_service.storeProfilEmploye');
Route::get('/chef_service/profilEmployeListe', [ChefserviceController::class, 'profilListe'])->name('chef_service.profilEmployeListe');
Route::get('/chef_service/profilEmployeEdit/{id}', [ChefserviceController::class, 'profilEmployeEdit'])->name('chef_service.profilEmployeEdit');
Route::post('/chef_service/profilEmployeUpdate/{id}', [ChefserviceController::class, 'profilEmployeUpdate'])->name('chef_service.profilEmployeUpdate');
Route::delete('/chef_service/profilEmployeDestroy/{id}', [ChefserviceController::class, 'profilEmployeDestroy'])->name('chef_service.profilEmployeDestroy');

// Route pour la confirmation d'utilisateur
Route::get('/confirm/{id}/{token}', [ChefserviceController::class, 'confirm'])->name('confirm');

// Routes pour les stagiaires
Route::get('/chef_service/indexStagiaires', [ChefserviceController::class, 'indexStagiaires'])->name('chef_service.indexStagiaires');

Route::get('/chef_service/profilStagiairesForm', [ChefserviceController::class, 'profilStagiairesForm'])->name('chef_service.profilStagiairesForm');
Route::post('/chef_service/storeProfilStagiaires', [ChefserviceController::class, 'storeProfilStagiaires'])->name('chef_service.storeProfilStagiaires');
Route::get('/chef_service/profilStagiairesListe', [ChefserviceController::class, 'profilStagiairesListe'])->name('chef_service.profilStagiairesListe');
Route::get('/chef_service/profilStagiairesEdit/{id}', [ChefserviceController::class, 'profilStagiairesEdit'])->name('chef_service.profilStagiairesEdit');
Route::post('/chef_service/profilStagiairesUpdate/{id}', [ChefserviceController::class, 'profilStagiairesUpdate'])->name('chef_service.profilStagiairesUpdate');
Route::delete('/chef_service/profilStagiairesDestroy/{id}', [ChefserviceController::class, 'profilStagiairesDestroy'])->name('chef_service.profilStagiairesDestroy');


Route::get('/chef_service/index_appreciation', [ChefserviceController::class, 'index_appreciation'])->name('chef_service.index_appreciation');
Route::get('/chef_service/appreciation', [ChefserviceController::class, 'appreciation'])->name('chef_service.appreciation');
Route::post('/chef_service/storeAppreciation', [ChefserviceController::class, 'storeAppreciation'])->name('chef_service.storeAppreciation');
Route::get('/chef_service/{chefservice}/edit', [ChefserviceController::class, 'edit_appreciation'])->name('chef_service.edit_appreciation');
Route::put('/{chefservice}', [ChefserviceController::class, 'update_appreciation'])->name('chef_service.update_appreciation');
Route::delete('/{chefservice}', [ChefserviceController::class, 'destroy_appreciation'])->name('chef_service.destroy_appreciation');
// Routes pour afficher les formulaires d'ajout
Route::get('/employe/ajoutemploye', [ChefserviceController::class, 'ajoutemploye'])->name('employe.ajoutemploye');
Route::get('/stagiaires/ajoutstagiaire', [ChefserviceController::class, 'ajoutstagiaire'])->name('stagiaires.ajoutstagiaire');
Route::post('/employe/storeEmploye', [ChefserviceController::class, 'storeEmploye'])->name('employe.storeEmploye');
Route::get('/employe/profilEmployeliste', [ChefserviceController::class, 'profilEmployeliste'])->name('employe.profilEmployeliste');
Route::post('/stagiaires/storeStagiaire', [ChefserviceController::class, 'storeStagiaire'])->name('stagiaires.storeStagiaire');

});




Route::get('/validate-account/{email}',[UserController::class,"defineAccess"]);
 Route::post('/validate-account/{email}',[UserController::class,"submitDefineAccess"])->name('submitDefineAccess');


 //Route::get('/validation-account/{email}',[ChefserviceController::class,"defineAccessStagiaire"]);
Route::post('/validation-account/{email}',[UserController::class,"submitDefineAccessStagiaire"])->name('submitDefineAccessStagiaire');



Route::get('/validation-account/{email}', [UserController::class, 'defineAccessStagiaire'])->name('validation-account');
