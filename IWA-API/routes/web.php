<?php

use App\Http\Controllers\AddMachineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LogsMedewerkersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\testdbController;
use App\Http\Controllers\StationController;
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

Route::get('/stationpage', [StationController::class, 'show'])-> name('stations');
Route::post('/stationpage', [StationController::class, 'show'])-> name('station');
Route::get('/addstation', [StationController::class, 'addStationShow'])-> name('addstations');
Route::post('/addstation', [StationController::class, 'addStation'])-> name('addstation');
Route::get('/editstation/{name}', [StationController::class, 'editStationShow'])->name('editstations');
Route::post('/editstation', [StationController::class, 'editStation'])-> name('editstation');
Route::post('/deletestation', [StationController::class, 'deleteStation'])-> name('deletestation');


/*
 * routes voor de administief mederwerks
 */

/*
 * routes voor de facturen
 */

Route::get('/contracten', [ContractController::class, 'show']) ->name('contracten');
Route::post('/contracten', [ContractController::class, 'show']) ->name('contract');
Route::get('/addcontract', [ContractController::class, 'addContractShow']) ->name('addcontract');
Route::post('/addcontract', [ContractController::class, 'addContract']) ->name('addcontracts');
Route::get('/editcontract/{id}', [ContractController::class, 'editContractShow']) ->name('editcontract');
Route::post('/editcontract', [ContractController::class, 'editContract']) ->name('editcontracts');
Route::post('/deletecontract', [ContractController::class, 'deleteContract']) ->name('deletecontract');


Route::get('/stationlocation', [ContractController::class, 'locationstations']);


Route::get('/customerlist', [CustomerController::class, 'costumerlist']) ->name('customerlist');
Route::post('/customerlist', [CustomerController::class, 'costumerlist']) ->name('customerlist');
Route::get('/addcustomer', [CustomerController::class, 'show']) ->name('customer');
Route::post('/addcustomer', [CustomerController::class, 'addCostumer']) ->name('addcustomer');
Route::get('/editcustomer/{id}', [CustomerController::class, 'editCostumerShow']) ->name('editcustomer');
Route::post('/editcustomer', [CustomerController::class, 'editCostumer']) ->name('editcustomerpost');
Route::post('/deletecustomer', [CustomerController::class, 'deleteCustomer']) ->name('deletecustomer');
/*
 * routes voor de API keys
 */

Route::get('/APIManagement', [APIController::class, 'show']) ->name('APIManagement');
Route::post('/APIManagement', [APIController::class, 'show']) ->name('APIManagements');
Route::get('/addAPI', [APIController::class, 'addAPIkeyShow']) ->name('addAPI');
Route::post('/addAPI', [APIController::class, 'addAPIkey']) ->name('addAPI');
Route::get('/editAPI/{id}', [APIController::class, 'editAPIShow']) ->name('editAPIs');
Route::post('/editAPI', [APIController::class, 'editAPI']) ->name('editAPI');
Route::post('/deleteAPI', [APIController::class, 'deleteAPI']) ->name('deleteAPI');



/*
 * routes voor de station errors
 */

Route::get('/stationerrors', [ErrorController::class, 'show']) ->name('stationerrors');
Route::post('/deletestationerror', [ErrorController::class, 'deleteError']) ->name('deletestationerror');
