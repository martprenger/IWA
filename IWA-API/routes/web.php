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


Route::get('/login', [loginController::class, 'show']);
Route::post('/custom-login', [loginController::class, 'customLogin'])->name('custom-login');
Route::get('/dashboard', [DashboardController::class, 'show']);
Route::get('/machinePage', [MachineController::class, 'show']);
Route::get('/add-station', [AddStationController::class, 'show']);
Route::get('/testdb', [testdbController::class, 'index']);
