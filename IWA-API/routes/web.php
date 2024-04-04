<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\testdbController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\AddStationController;

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
Route::get('/medewerkersinstellingen', [EmployeesSettingsController::class, 'show']);
Route::get('/logsmederwerkers', [logsMederwerkersController::class, 'show']);
Route::get('medewerkerstoevoegen', [medewerkersToevoegenController::class, 'show']);


/*
 * routes voor de de algemene mederwerks
 */
Route::get('/machinetoevoegen', [AddMachineController::class, 'show']);
Route::get('/machinepage', [MachineController::class, 'show'])-> name('machinepage');



/*
 * routes voor de administief mederwerks
 */

Route::get('/facaturen', [InvoicesController::class, 'show']);
Route::get('/lopendecontracten', [ContractsController::class, 'show']);




Route::get('/machinePage', [MachineController::class, 'show']);
Route::get('/add-station', [AddStationController::class, 'show']);
Route::post('/add-station', [AddStationController::class, 'handleStationData'])->name('add-station');

Route::get('/testdb', [testdbController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
