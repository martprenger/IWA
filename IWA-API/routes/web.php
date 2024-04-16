<?php

use App\Http\Controllers\AddMachineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LogsMedewerkersController;
use Illuminate\Support\Facades\Auth;
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

/*
 * routes voor de login
 */

Auth::routes();

/*
 * routes voor de dashboard
 */

Route::get('/', [DashboardController::class, 'show'])->name('dashboard');

/*
 * routes voor de admin
 */

Route::get('/admin', [AdminController::class, 'show'])->name('admin')->middleware('role:admin');

Route::get('/logsmedewerkers', [LogsMedewerkersController::class, 'show']) ->name('logsmedewerkers');


/*
 * routes voor de medewerkers
 */

Route::get('/medewerkers', [EmployeesController::class, 'employeesShow']) ->name('medewerkers')->middleware('role:admin');
Route::post('/medewerkers', [EmployeesController::class, 'employeesShow']) ->name('medewerkers')->middleware('role:admin');

Route::get('/medewerkerstoevoegen', [EmployeesController::class, 'addEmployeeShow']) ->name('addemployees')->middleware('role:admin');
Route::get('/medewerkerwijzigen/{id}', [EmployeesController::class, 'editEmployeeShow']) ->name('editemployees')->middleware('role:admin');
Route::post('/medewerkerstoevoegen', [EmployeesController::class, 'addEmployee']) ->name('addemployee')->middleware('role:admin');
Route::post('/deleteemployee', [EmployeesController::class, 'deleteEmployee']) ->name('deleteemployee')->middleware('role:admin');
Route::post('/medewerkerwijzigen', [EmployeesController::class, 'editEmployee']) ->name('editemployee')->middleware('role:admin');



/*
 * routes voor de de algemene mederwerks
 */

Route::get('/machinepage', [MachineController::class, 'show'])-> name('machinepage');
Route::get('/machinetoevoegen', [AddMachineController::class, 'show'])-> name('machinetoevoegen');


/*
 * routes voor de administief mederwerks
 */

Route::get('/facaturen', [InvoicesController::class, 'show']) ->name('Invoices');


Route::get('/APIManagement', [APIController::class, 'show']) ->name('APIManagement');
Route::post('/APIManagement', [APIController::class, 'show']) ->name('APIManagements');
Route::get('/addAPI', [APIController::class, 'addAPIkeyShow']) ->name('addAPI');
Route::post('/addAPI', [APIController::class, 'addAPIkey']) ->name('addAPI');
Route::get('/editAPI/{id}', [APIController::class, 'editAPIShow']) ->name('editAPIs');
Route::post('/editAPI', [APIController::class, 'editAPI']) ->name('editAPI');
Route::post('/deleteAPI', [APIController::class, 'deleteAPI']) ->name('deleteAPI');




Route::get('/machinePage', [MachineController::class, 'show']);
Route::get('/add-station', [AddStationController::class, 'show']);
Route::post('/add-station', [AddStationController::class, 'handleStationData'])->name('add-station');

Route::get('/testdb', [testdbController::class, 'index']);



