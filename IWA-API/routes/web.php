<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\testdbController;
use App\Http\Controllers\MachineController;

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

/*
 * voor het inloggen op de website

 */
Route::get('/login', [loginController::class, 'show']);
Route::post('/custom-login', [loginController::class, 'customLogin'])->name('custom-login');

/*
 * routes voor de dashboard
 */

Route::get('/dashboard', [DashboardController::class, 'show']);

/*
 * routes voor de admin
 */

Route::get('/admin', [DashboardController::class, 'show']);
Route::get('/mederwerkersInstellingen', [mederwerkersInstellingenController::class, 'show']);
Route::get('/logsMederwerkers', [logsMederwerkersController::class, 'show']);
Route::get('mederwerksToevoegen', [mederwerksToevoegenController::class, 'show']);


/*
 * routes voor de de algemene mederwerks
 */
Route::get('/machineToevoegen', [machineToevoegenController::class, 'show']);
Route::get('/machinePage', [MachineController::class, 'show']);
Route::get('/machinePage', [MachineController::class, 'getMachines']);

/*
 * routes voor de administief mederwerks
 */

Route::get('/factaturen', [factaturenController::class, 'show']);
Route::get('/lopendeContracten', [lopendeContractenController::class, 'show']);



Route::get('/testdb', [testdbController::class, 'index']);
