<?php

use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ExtensionJobController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
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

Route::get('/', fn() => view('welcome') );

Route::get('extensions', [ExtensionController::class, 'index'])->name('extensions.index');
Route::prefix('extensions')->group(function () {
    Route::get('/{extension}', [ExtensionController::class, 'show'])->name('extensions.show');
    Route::get('/{extension}/create', [ExtensionController::class, 'create'])->name('extensions.create');
    Route::post('/{extension}/create', [ExtensionController::class, 'store'])->name('extensions.store');
    Route::get('/{extension}/edit', [ExtensionController::class, 'edit'])->name('extensions.edit');
    Route::match(['put', 'patch'], '/{extension}/edit', [ExtensionController::class, 'update'])->name('extensions.update');
    Route::delete('/{extension}', [ExtensionController::class, 'destroy'])->name('extensions.destroy');
});

Route::post('jobs/{job}/extensions', [ExtensionJobController::class, 'attach'])->name('jobs.extensions.attach');
Route::delete('jobs/{job}/extensions', [ExtensionJobController::class, 'detach'])->name('jobs.extensions.detach');
Route::resource('jobs', JobController::class);

Route::resource('orders', OrderController::class);
