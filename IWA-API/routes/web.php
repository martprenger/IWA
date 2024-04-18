<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\LogsMedewerkersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StationController;

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

Route::get('/stationpage', [StationController::class, 'show'])-> name('stations');
Route::post('/stationpage', [StationController::class, 'show'])-> name('station');
Route::get('/addstation', [StationController::class, 'addStationShow'])-> name('addstations');
Route::post('/addstation', [StationController::class, 'addStation'])-> name('addstation');
Route::get('/editstation/{name}', [StationController::class, 'editStationShow'])->name('editstations');
Route::post('/editstation', [StationController::class, 'editStation'])-> name('editstation');
Route::post('/deletestation', [StationController::class, 'deleteStation'])-> name('deletestation');

/*
 * routes voor de facturen
 */

Route::get('/contracten', [ContractController::class, 'show']) ->name('contracten')->middleware('role:admin,administratief');
Route::post('/contracten', [ContractController::class, 'show']) ->name('contract')->middleware('role:admin,administratief');
Route::get('/addcontract', [ContractController::class, 'addContractShow']) ->name('addcontract')->middleware('role:admin,administratief');
Route::post('/addcontract', [ContractController::class, 'addContract']) ->name('addcontracts')->middleware('role:admin,administratief');
Route::get('/editcontract/{id}', [ContractController::class, 'editContractShow']) ->name('editcontract')->middleware('role:admin,administratief');
Route::post('/editcontract', [ContractController::class, 'editContract']) ->name('editcontracts')->middleware('role:admin,administratief');
Route::post('/deletecontract', [ContractController::class, 'deleteContract']) ->name('deletecontract')->middleware('role:admin,administratief');


Route::get('/stationlocation', [ContractController::class, 'locationstations'])->middleware('role:admin,administratief');


Route::get('/addcustomer', [CustomerController::class, 'show']) ->name('customer')->middleware('role:admin,administratief');
Route::post('/addcustomer', [CustomerController::class, 'addCostumer']) ->name('addcustomer')->middleware('role:admin,administratief');
Route::get('/customerlist', [CustomerController::class, 'costumerlist']) ->name('customerlist')->middleware('role:admin,administratief');
/*
 * routes voor de API keys
 */

Route::get('/APIManagement', [APIController::class, 'show']) ->name('APIManagement')->middleware('role:admin,administratief,wetenschappelijk');
Route::post('/APIManagement', [APIController::class, 'show']) ->name('APIManagements')->middleware('role:admin,administratief,wetenschappelijk');
Route::get('/addAPI', [APIController::class, 'addAPIkeyShow']) ->name('addAPI')->middleware('role:admin,administratief,wetenschappelijk');
Route::post('/addAPI', [APIController::class, 'addAPIkey']) ->name('addAPI')->middleware('role:admin,administratief,wetenschappelijk');
Route::get('/editAPI/{id}', [APIController::class, 'editAPIShow']) ->name('editAPIs')->middleware('role:admin,administratief,wetenschappelijk');
Route::post('/editAPI', [APIController::class, 'editAPI']) ->name('editAPI')->middleware('role:admin,administratief,wetenschappelijk');
Route::post('/deleteAPI', [APIController::class, 'deleteAPI']) ->name('deleteAPI')->middleware('role:admin,administratief,wetenschappelijk');



/*
 * routes voor de station errors
 */

Route::get('/stationerrors', [ErrorController::class, 'show']) ->name('stationerrors')->middleware('role:admin,wetenschappelijk');
Route::post('/deletestationerror', [ErrorController::class, 'deleteError']) ->name('deletestationerror')->middleware('role:admin,wetenschappelijk');
