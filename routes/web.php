<?php

use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ExtensionJobController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\IntermediaryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderJobExtensionsAjaxController;
use App\Http\Controllers\UserController;
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

// Route::get('/', fn() => redirect()->route('orders.index') );

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('extensions/{extension}/create', [ExtensionController::class, 'create'])->name('extensions.create');
Route::post('extensions/{extension}/create', [ExtensionController::class, 'store'])->name('extensions.store');
Route::resource('extensions', ExtensionController::class)->except(['create','store']);

Route::post('jobs/{job}/extensions', [ExtensionJobController::class, 'attach'])->name('jobs.extensions.attach');
Route::delete('jobs/{job}/extensions', [ExtensionJobController::class, 'detach'])->name('jobs.extensions.detach');
Route::resource('jobs', JobController::class);

Route::get('clients/ajax', [ClientAjaxController::class, 'search'])->name('clients.ajax.search');
Route::resource('clients', ClientController::class);

Route::resource('members', MemberController::class);
Route::resource('crews', CrewController::class);

Route::resource('intermediaries', IntermediaryController::class);
Route::resource('inspectors', InspectorController::class);

Route::resource('inspections', InspectionController::class)->except('create');
Route::get('inspections/create/{order}', [InspectionController::class, 'create'])->name('inspections.create');

Route::resource('orders', OrderController::class)->except('create');
Route::get('orders/create/{client}', [OrderController::class, 'create'])->name('orders.create');

Route::get('orders/ajax/create/{job}', [OrderJobExtensionsAjaxController::class, 'create'])->name('orders.ajax.create');
Route::get('orders/ajax/edit/{order}', [OrderJobExtensionsAjaxController::class, 'edit'])->name('orders.ajax.edit');

Route::resource('users', UserController::class);
