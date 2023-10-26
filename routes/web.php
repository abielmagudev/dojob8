<?php

use App\Http\Controllers\Api\OrderJobExtensionsController;
use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\ClientController;
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

Route::get('extensions/{extension}/create', [ExtensionController::class, 'create'])->name('extensions.create');
Route::post('extensions/{extension}/create', [ExtensionController::class, 'store'])->name('extensions.store');
Route::resource('extensions', ExtensionController::class)->except(['create','store']);

Route::post('jobs/{job}/extensions', [ExtensionJobController::class, 'attach'])->name('jobs.extensions.attach');
Route::delete('jobs/{job}/extensions', [ExtensionJobController::class, 'detach'])->name('jobs.extensions.detach');
Route::resource('jobs', JobController::class);

Route::get('clients/ajax', [ClientAjaxController::class, 'search'])->name('clients.ajax.search');
Route::resource('clients', ClientController::class);

Route::resource('orders', OrderController::class)->except('create');
Route::get('orders/create/{client}', [OrderController::class, 'create'])->name('orders.create');

Route::get('orders/api/create/{job}', [OrderJobExtensionsController::class, 'create'])->name('orders.api.create');
Route::get('orders/api/edit/{order}', [OrderJobExtensionsController::class, 'edit'])->name('orders.api.edit');
