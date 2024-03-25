<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\previewController;
use App\Http\Controllers\testdbController;
use App\Http\Controllers\CreateUserController;

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

Route::get('/preview', [previewController::class, 'show']);
Route::get('/login', [loginController::class, 'show']);
Route::post('/custom-login', [loginController::class, 'customLogin'])->name('custom-login');
Route::get('/testdb', [testdbController::class, 'index']);
Route::get('/create_user', [CreateUserController::class, 'show']);