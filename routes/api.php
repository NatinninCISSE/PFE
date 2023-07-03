<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
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


Route::get('liste-culture', [CultureController::class, 'liste_culture_api']);


Route::get('/liste-poste', [PosteController::class, 'liste_poste_api']);
Route::post('/creer-poste', [PosteController::class, 'creer_poste_api']);


// Route::post('/postes', [PosteController::class, 'store']);
// Route::get('/postes/{id}/details_poste', [PosteController::class, 'details_poste_api']);
// Route::get('/postes/{id}/modifier_poste', [PosteController::class, 'modifier_poste_api']);
// Route::post('/postes/{id}/modifier_poste_traitement', [PosteController::class, 'modifier_poste_traitement_api']);
// Route::delete('/postes/{id}', [PosteController::class, 'destroy']);