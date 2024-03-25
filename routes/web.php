<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionsController::class);
Route::resource('products', ProductsController::class);
Route::get('/section/{id}', [InvoicesController::class, 'getProducts']);
Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
Route::resource('archive', InvoiceAchiveController::class);

Route::get('/status_show/{id}', [InvoicesController::class, 'show'])->name('status_show');

Route::post('/status_update/{id}', [InvoicesController::class, 'status_update'])->name('status_update');
Route::get('/invoices_paid', [InvoicesController::class, 'invoicesPaid']);
Route::get('/invoices_unpaid', [InvoicesController::class, 'invoicesunPaid']);
Route::get('/invoices_partial', [InvoicesController::class, 'invoicesPartial']);



Route::get('invoices_report', [Invoices_Report::class, 'index']);

Route::post('Search_invoices', [Invoices_Report::class, 'Search_invoices']);


// Route::group(['middleware' => ['role:super-admin|admin']], function() {

//     Route::resource('permissions', App\Http\Controllers\PermissionController::class);
//     Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

//     Route::resource('roles', App\Http\Controllers\RoleController::class);
//     Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
//     Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
//     Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

//     Route::resource('users', App\Http\Controllers\UserController::class);
//     Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

// });

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
});

Route::get('/{page}', [AdminController::class, 'index']);
