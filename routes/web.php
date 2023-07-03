<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\PoissonController;
use App\Http\Controllers\DispositifController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\PosteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('inscription', [AdministrateurController::class, 'formulaire']);

Route::post('inscription', [AdministrateurController::class, 'inscription'])->name('inscription');


Route::get('/cultures', [CultureController::class, 'liste_culture'])->name('cultures');
Route::get('/cultures/creer_culture', [CultureController::class, 'creer_culture'])->name('cultures.creer_culture');
Route::post('/cultures', [CultureController::class, 'store'])->name('cultures.store');
Route::get('/cultures/{id}/details_culture', [CultureController::class, 'details_culture'])->name('cultures.details_culture');
Route::get('/cultures/{id}/modifier_culture', [CultureController::class, 'modifier_culture'])->name('cultures.modifier_culture');
Route::post('/cultures/{id}/modifier_culture_traitement', [CultureController::class, 'modifier_culture_traitement'])->name('cultures.modifier_culture_traitement');
Route::delete('/cultures/{id}', [CultureController::class, 'destroy'])->name('cultures.destroy');


Route::get('/taches', [TacheController::class, 'liste_tache'])->name('taches');
Route::get('/taches/{id}/creer_tache', [TacheController::class, 'creer_tache'])->name('taches.creer_tache');
Route::post('/taches', [TacheController::class, 'store'])->name('taches.store');
Route::get('/taches/{id}/details_tache', [TacheController::class, 'details_tache'])->name('taches.details_tache');
Route::get('/taches/{id}/modifier_tache', [TacheController::class, 'modifier_tache'])->name('taches.modifier_tache');
Route::post('/taches/{id}/modifier_tache_traitement', [TacheController::class, 'modifier_tache_traitement'])->name('taches.modifier_tache_traitement');
Route::delete('/taches/{id}', [TacheController::class, 'destroy'])->name('taches.destroy');



Route::get('/tasks', [TaskController::class, 'liste_task'])->name('tasks');
Route::get('/tasks/{id}/creer_task', [TaskController::class, 'creer_task'])->name('tasks.creer_task');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/details_task', [TaskController::class, 'details_task'])->name('tasks.details_task');
Route::get('/tasks/{id}/modifier_task', [TaskController::class, 'modifier_task'])->name('tasks.modifier_task');
Route::post('/tasks/{id}/modifier_task_traitement', [TaskController::class, 'modifier_task_traitement'])->name('tasks.modifier_task_traitement');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');



Route::get('/etapes', [EtapeController::class, 'liste_etape'])->name('etapes');
Route::get('/etapes/{id}/creer_etape', [EtapeController::class, 'creer_etape'])->name('etapes.creer_etape');
Route::post('/etapes', [EtapeController::class, 'store'])->name('etapes.store');
Route::get('/etapes/{id}/details_etape', [EtapeController::class, 'details_etape'])->name('etapes.details_etape');
Route::get('/etapes/{id}/modifier_etape', [EtapeController::class, 'modifier_etape'])->name('etapes.modifier_etape');
Route::post('/etapes/{id}/modifier_etape_traitement', [EtapeController::class, 'modifier_etape_traitement'])->name('etapes.modifier_etape_traitement');
Route::delete('/etapes/{id}', [EtapeController::class, 'destroy'])->name('etapes.destroy');



Route::get('/steps', [StepController::class, 'liste_step'])->name('steps');
Route::get('/steps/{id}/creer_step', [StepController::class, 'creer_step'])->name('steps.creer_step');
Route::post('/steps', [StepController::class, 'store'])->name('steps.store');
Route::get('/steps/{id}/details_step', [StepController::class, 'details_step'])->name('steps.details_step');
Route::get('/steps/{id}/modifier_step', [StepController::class, 'modifier_step'])->name('steps.modifier_step');
Route::post('/steps/{id}/modifier_step_traitement', [StepController::class, 'modifier_step_traitement'])->name('steps.modifier_step_traitement');
Route::delete('/steps/{id}', [StepController::class, 'destroy'])->name('steps.destroy');



Route::get('/conseils', [ConseilController::class, 'liste_conseil'])->name('conseils');
Route::get('/conseils/{id}/creer_conseil', [ConseilController::class, 'creer_conseil'])->name('conseils.creer_conseil');
Route::post('/conseils', [ConseilController::class, 'store'])->name('conseils.store');
Route::get('/conseils/{id}/details_conseil', [ConseilController::class, 'details_conseil'])->name('conseils.details_conseil');
Route::get('/conseils/{id}/modifier_conseil', [ConseilController::class, 'modifier_conseil'])->name('conseils.modifier_conseil');
Route::post('/conseils/{id}/modifier_conseil_traitement', [ConseilController::class, 'modifier_conseil_traitement'])->name('conseils.modifier_conseil_traitement');
Route::delete('/conseils/{id}', [ConseilController::class, 'destroy'])->name('conseils.destroy');



Route::get('/reclamations', [ReclamationController::class, 'liste_reclamation'])->name('reclamations');
Route::get('/reclamations/creer_reclamation', [ReclamationController::class, 'creer_reclamation'])->name('reclamations.creer_reclamation');
Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
Route::get('/reclamations/{id}/details_reclamation', [ReclamationController::class, 'details_reclamation'])->name('reclamations.details_reclamation');
Route::get('/reclamations/{id}/modifier_reclamation', [ReclamationController::class, 'modifier_reclamation'])->name('reclamations.modifier_reclamation');
Route::post('/reclamations/{id}/modifier_reclamation_traitement', [ReclamationController::class, 'modifier_reclamation_traitement'])->name('reclamations.modifier_reclamation_traitement');
Route::delete('/reclamations/{id}', [ReclamationController::class, 'destroy'])->name('reclamations.destroy');



Route::get('/postes', [PosteController::class, 'liste_poste'])->name('postes');
Route::get('/postes/creer_poste', [PosteController::class, 'creer_poste'])->name('postes.creer_poste');
Route::post('/postes', [PosteController::class, 'store'])->name('postes.store');
Route::get('/postes/{id}/details_poste', [PosteController::class, 'details_poste'])->name('postes.details_poste');
Route::get('/postes/{id}/modifier_poste', [PosteController::class, 'modifier_poste'])->name('postes.modifier_poste');
Route::post('/postes/{id}/modifier_poste_traitement', [PosteController::class, 'modifier_poste_traitement'])->name('postes.modifier_poste_traitement');
Route::delete('/postes/{id}', [PosteController::class, 'destroy'])->name('postes.destroy');




Route::get('/poissons', [PoissonController::class, 'liste_poisson'])->name('poissons');
Route::get('/poissons/creer_poisson', [PoissonController::class, 'creer_poisson'])->name('poissons.creer_poisson');
Route::post('/poissons', [PoissonController::class, 'store'])->name('poissons.store');
Route::get('/poissons/{id}/details_poisson', [PoissonController::class, 'details_poisson'])->name('poissons.details_poisson');
Route::get('/poissons/{id}/modifier_poisson', [PoissonController::class, 'modifier_poisson'])->name('poissons.modifier_poisson');
Route::post('/poissons/{id}/modifier_poisson_traitement', [PoissonController::class, 'modifier_poisson_traitement'])->name('poissons.modifier_poisson_traitement');
Route::delete('/poissons/{id}', [PoissonController::class, 'destroy'])->name('poissons.destroy');



Route::get('/clients', [ClientController::class, 'liste_client'])->name('clients');
Route::get('/clients/creer_client', [ClientController::class, 'creer_client'])->name('clients.creer_client');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}/details_client', [ClientController::class, 'details_client'])->name('clients.details_client');
Route::get('/clients/{id}/modifier_client', [ClientController::class, 'modifier_client'])->name('clients.modifier_client');
Route::post('/clients/{id}/modifier_client_traitement', [ClientController::class, 'modifier_client_traitement'])->name('clients.modifier_client_traitement');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');



Route::get('/dispositifs', [DispositifController::class, 'liste_dispositif'])->name('dispositifs');
Route::get('/dispositifs/creer_dispositif', [DispositifController::class, 'creer_dispositif'])->name('dispositifs.creer_dispositif');
Route::post('/dispositifs', [DispositifController::class, 'store'])->name('dispositifs.store');
Route::get('/dispositifs/{id}/details_dispositif', [DispositifController::class, 'details_dispositif'])->name('dispositifs.details_dispositif');
Route::get('/dispositifs/{id}/modifier_dispositif', [DispositifController::class, 'modifier_dispositif'])->name('dispositifs.modifier_dispositif');
Route::post('/dispositifs/{id}/modifier_dispositif_traitement', [DispositifController::class, 'modifier_dispositif_traitement'])->name('dispositifs.modifier_dispositif_traitement');
Route::delete('/dispositifs/{id}', [DispositifController::class, 'destroy'])->name('dispositifs.destroy');