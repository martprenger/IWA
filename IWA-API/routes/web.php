<?php

use App\Http\Controllers\AddMachineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeesController;
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
Route::get('/login', [EmployeesController::class, 'loginShow'])->name('login');
Route::post('/custom-login', [EmployeesController::class, 'customLogin'])->name('custom-login');

/*
 * routes voor de dashboard
 */

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');


/*
 * routes voor de admin
 */

Route::get('/admin', [AdminController::class, 'show'])->name('admin');

Route::get('/logsmedewerkers', [LogsMedewerkersController::class, 'show']) ->name('logsmedewerkers');

Route::get('/medewerkersinstellingen', [EmployeesController::class, 'employeesSettingShow']) ->name('medewerkersinstellingen');
Route::get('/medewerkerstoevoegen', [EmployeesController::class, 'addEmployeeShow']) ->name('addemployees');
Route::post('/medewerkerstoevoegen', [EmployeesController::class, 'addEmployee']) ->name('addemployee');
Route::post('/deleteemployee', [EmployeesController::class, 'deleteEmployee']) ->name('deleteemployee');


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
