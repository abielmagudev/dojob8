<?php

use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ExtensionJobController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAjaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkOrderJobExtensionsAjaxController;
use App\Http\Controllers\WorkOrderWorkerController;
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

Route::match(['put','patch'], 'crews/{crew}/members', [CrewController::class, 'membersUpdate'])->name('crews.members.update');
Route::resource('crews', CrewController::class);

Route::resource('contractors', ContractorController::class);
Route::resource('inspectors', InspectorController::class);

Route::resource('inspections', InspectionController::class)->except('create');
Route::get('inspections/create/{work_order}', [InspectionController::class, 'create'])->name('inspections.create');

Route::resource('users', UserController::class);

Route::get('history', HistoryController::class)->name('history.index');

Route::patch('work-orders/workers', WorkOrderWorkerController::class)->name('work-orders.update.workers');
Route::get('work-orders/create/{client}', [WorkOrderController::class, 'create'])->name('work-orders.create');
Route::resource('work-orders', WorkOrderController::class)->except('create');

Route::get('work-orders/ajax/create/{job}', [WorkOrderJobExtensionsAjaxController::class, 'create'])->name('work-orders.ajax.create');
Route::get('work-orders/ajax/edit/{work_order}', [WorkOrderJobExtensionsAjaxController::class, 'edit'])->name('work-orders.ajax.edit');
