<?php

use App\Http\Controllers\AddMachineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeesSettingsController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\LogsMedewerkersController;
use App\Http\Controllers\AddEmployeesController;
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

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');


/*
 * routes voor de admin
 */

Route::get('/admin', [AdminController::class, 'show'])->name('admin');
Route::get('/medewerkersinstellingen', [EmployeesSettingsController::class, 'show']) ->name('medewerkersinstellingen');
Route::get('/logsmedewerkers', [LogsMedewerkersController::class, 'show']) ->name('logsmedewerkers');
Route::get('/medewerkerstoevoegen', [AddEmployeesController::class, 'show']) ->name('addemployees');
Route::post('/medewerkerstoevoegen', [AddEmployeesController::class, 'addemployee']) ->name('addemployee');


/*
 * routes voor de de algemene mederwerks
 */

Route::get('/machinepage', [MachineController::class, 'show'])-> name('machinepage');
Route::get('/machinetoevoegen', [AddMachineController::class, 'show'])-> name('machinetoevoegen');



/*
 * routes voor de administief mederwerks
 */

Route::get('/facaturen', [InvoicesController::class, 'show']);
Route::get('/lopendecontracten', [ContractsController::class, 'show']);




Route::get('/machinePage', [MachineController::class, 'show']);

Route::get('/testdb', [testdbController::class, 'index']);
