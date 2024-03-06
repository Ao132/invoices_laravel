<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
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

Route::get('/status_show/{id}', [InvoicesController::class, 'show'])->name('status_show');

Route::post('/status_update/{id}', [InvoicesController::class, 'status_update'])->name('status_update');
Route::get('/invoices_paid', [InvoicesController::class, 'invoicesPaid']);
Route::get('/invoices_unpaid', [InvoicesController::class, 'invoicesunPaid']);
Route::get('/invoices_partial', [InvoicesController::class, 'invoicesPartial']);




Route::get('/{page}', [AdminController::class, 'index']);
