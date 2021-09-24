<?php

use App\Http\Controllers\WordGeneratorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WordGeneratorController::class, 'form']);
Route::post('/', [WordGeneratorController::class, 'words'])->name('generate');
