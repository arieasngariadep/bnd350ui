<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadBND350UIController;
use App\Http\Controllers\ListBND350UIController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;

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
// ================ Authentication Routing ================ //
Route::get('login', [AuthenticationController::class, 'loginPage'])->name('loginPage');
Route::post('/loginProcess', [AuthenticationController::class, 'loginProcess'])->name('loginProcess');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('checkauth');

// ================ Dashboard Routing ================ //
Route::get('dashboard', [DashboardController::class, 'dashboardPage'])->name('dashboardPage')->middleware('checkauth');

// ================ Form Upload BND350UI Routing ================ //
Route::get('formUploadBND350UI', [UploadBND350UIController::class, 'formUploadBND350UI'])->name('formUploadBND350UI')->middleware('checkauth');
Route::post('prosesUploadBND350UI', [UploadBND350UIController::class, 'prosesUploadBND350UI'])->name('prosesUploadBND350UI')->middleware('checkauth');

// ================ Form Delete BND350UI Routing ================ //
Route::get('formDeleteBND350UI',[ListBND350UIController::class,'formDeleteBND350UI'])->name('formDeleteBND350UI')->middleware('checkauth');
Route::delete('deleteBndCreatedAt', [ListBND350UIController::class, 'deleteBndCreatedAt'])->name('deleteBndCreatedAt')->middleware('checkauth');

// ================ List BND350UI Routing ================ //
Route::get('listBND350UI', [ListBND350UIController::class, 'getListBND350UI'])->name('getListBND350UI')->middleware('checkauth');
Route::get('listResultBND350UI/{userId}', [ListBND350UIController::class, 'getListResultBND350UI'])->name('getListResultBND350UI')->middleware('checkauth');
Route::post('prosesUploadSearchBulk', [ListBND350UIController::class, 'prosesUploadSearchBulk'])->name('prosesUploadSearchBulk')->middleware('checkauth');
Route::post('prosesReportSearchExport', [ListBND350UIController::class, 'prosesReportSearchExport'])->name('prosesReportSearchExport')->middleware('checkauth');
Route::post('prosesReportSearchBulkExport', [ListBND350UIController::class, 'prosesReportSearchBulkExport'])->name('prosesReportSearchBulkExport')->middleware('checkauth');
// ================ Download Report Routing ================ //
Route::get('formDownloadReport', [ReportController::class, 'formDownloadReport'])->name('formDownloadReport')->middleware('checkauth');
Route::post('prosesDownloadReport', [ReportController::class, 'prosesDownloadReport'])->name('prosesDownloadReport')->middleware('checkauth');
Route::delete('prosesDeleteData', [ReportController::class, 'prosesDeleteData'])->name('prosesDeleteData')->middleware('checkauth');
// ================ Delete Report Routing ================ //


// ================ Users Routing ================ //
Route::prefix('users')->group(function(){
    Route::get('/', [UsersController::class, 'getListUsers'])->name('getListUsers')->middleware('checkauth');
    Route::get('/formAddUser', [UsersController::class, 'formAddUser'])->name('formAddUser')->middleware('checkauth');
    Route::get('/formUpdateUser/{id}', [UsersController::class, 'formUpdateUser'])->name('formUpdateUser')->middleware('checkauth');

    Route::post('proses_tambah_user', [UsersController::class, 'prosesAddUser'])->name('prosesAddUser');
    Route::post('proses_update_user', [UsersController::class, 'prosesUpdateUser'])->name('prosesUpdateUser');
    Route::get('proses_delete_user/{id}', [UsersController::class, 'deleteUser'])->name('deleteUser');
    Route::post('check_email_exists', [UsersController::class, 'checkEmailExists'])->name('checkEmailExists');
});