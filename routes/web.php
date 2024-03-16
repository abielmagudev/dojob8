<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CrewMemberAssignmentController;
use App\Http\Controllers\CrewMemberController;
use App\Http\Controllers\CrewStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\InspectionStatusController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MediaAjaxController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkOrderOrderedController;
use App\Http\Controllers\WorkOrderStatusController;
use App\Http\Controllers\WorkOrderUpdateQuicklyController;
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

Route::fallback(fn() => redirect()->route('login'));

Route::middleware(['auth'])->group(function () {
    
    // Dasboard
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
    
    // Members
    Route::resource('members', MemberController::class);
    
    // Clients
    Route::get('clients/ajax', ClientAjaxController::class)->name('clients.ajax.search');
    Route::resource('clients', ClientController::class);
    
    // Inspections
    Route::patch('inspections/status', InspectionStatusController::class)->name('inspections.update.status');
    Route::get('inspections/create/{work_order}', [InspectionController::class, 'create'])->name('inspections.create');
    Route::resource('inspections', InspectionController::class)->except('create');
   
    // Agencies
    Route::resource('agencies', AgencyController::class);
    
    // Jobs
    Route::resource('jobs', JobController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Crew Members Assigment
    Route::patch('crew-members/assignment', CrewMemberAssignmentController::class)->name('crew-members.assignment.update');
    
    // Crews
    Route::patch('crews/status', CrewStatusController::class)->name('crews.update.status');
    Route::put('crews/members', CrewMemberController::class)->name('crews.update.members');
    Route::resource('crews', CrewController::class);
    
    // Contractors
    Route::resource('contractors', ContractorController::class);
    
    // Users
    Route::resource('users', UserController::class);
    
    // History
    Route::get('history', HistoryController::class)->name('history.index');
    
    // Comments
    Route::post('comments/{work_order}', CommentController::class)->name('comments.create');
    
    // Payments
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::patch('payments', [PaymentController::class, 'update'])->name('payments.update');
    
    // Search clients and work orders
    Route::get('search', SearchController::class)->name('app.search');
    
    // Media (Files, photos, videos...)
    // Route::resource('media/ajax', MediaAjaxController::class)->only(['store', 'destroy']);
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('media', [MediaController::class, 'destroy'])->name('media.destroy');
    
    // Assessments
    Route::resource('assessments', AssessmentController::class);

    // Work orders    
    Route::patch('work-orders/edit-quickly/{attribute}', WorkOrderUpdateQuicklyController::class)->name('work-orders.update.quickly');
    Route::resource('work-orders', WorkOrderController::class);

    // Account
    Route::get('account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('account', [AccountController::class, 'update'])->name('account.update');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('settings', [SettingsController::class, 'update'])->name('settings.update');
});
