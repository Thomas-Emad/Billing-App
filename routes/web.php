<?php
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\InvoicesDateilsController;
use App\Http\Controllers\InvoicesAttchmentsController;
use App\Http\Controllers\InvoicesArchiveController;

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

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices', InvoicesController::class)->middleware('permission:invoices_table');
Route::resource("sections", SectionsController::class)->middleware('permission:sections');
Route::resource("items", ItemsController::class)->middleware('permission:product');
Route::get("/section/{section_id}", [InvoicesController::class, "getItems"]);
Route::get("/invoiceDateils/{id}", [InvoicesDateilsController::class, "index"]);
Route::resource("attch", InvoicesAttchmentsController::class);
Route::get("invoiceDateils/show/{invoice_number}/{file_name}", [InvoicesDateilsController::class, "showFile"]);
Route::get("invoiceDateils/download/{invoice_number}/{file_name}", [InvoicesDateilsController::class, "download"]);
Route::get("invoicesPaid", [InvoicesController::class, "paid"])->middleware('permission:invoices_paid');
Route::get("invoicesUnpaid", [InvoicesController::class, "unpaid"])->middleware('permission:invoices_unpaid');
Route::get("invoicesPartpaid", [InvoicesController::class, "partpaid"])->middleware('permission:invoices_partpaid');
Route::get("invoices/statusInvoice/{id}", [InvoicesController::class, "status_invoice"])->middleware('permission:invoices_status');
Route::POST("invoices/statusInvoice/changeStatus", [InvoicesController::class, "status_invoice_save"])->middleware('permission:invoices_status');
Route::resource("archive", InvoicesArchiveController::class)->middleware('permission:invoices_archive');
Route::get("exportExcelInvoices", [InvoicesController::class, "export"])->middleware('permission:invoices_excel');
Route::get("readAllNot", [InvoicesController::class, "readAllNot"]);

Route::get("invoicesReports", [ReportsController::class, "invoices_reports"])->middleware('permission:reports|reports_invoices');
Route::post("invoicesSearch", [ReportsController::class, "invoices_search"])->name("invoicesSearch")->middleware('permission:reports|reports_invoices');
Route::get("usersReports", [ReportsController::class, "users_reports"])->middleware('permission:reports|reports_customers');
Route::post("usersSearch", [ReportsController::class, "users_search"])->name("usersSearch")->middleware('permission:reports|reports_customers');

Route::group(['middleware' => ['auth']], function () {
  Route::resource('roles', RoleController::class);
  Route::resource('users', UserController::class);
});

Route::get('/{page}', 'App\Http\Controllers\AdminController@index')->middleware('auth');
