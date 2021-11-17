<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSVController;

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
    return view('uploadcsv');
});

Route::post('fileUpload', [CSVController::class, 'fileUpload'])->name('fileUpload');
Route::get('listbranch', [CSVController::class, 'listbranch'])->name('listbranch');
Route::get('listFeeCategory', [CSVController::class, 'listFeeCategory'])->name('listFeeCategory');
Route::get('listFeeCollectionType', [CSVController::class, 'listFeeCollectionType'])->name('listFeeCollectionType');
Route::get('listFeeType', [CSVController::class, 'listFeeType'])->name('listFeeType');
Route::get('listfinancialTrans', [CSVController::class, 'listfinancialTrans'])->name('listfinancialTrans');
Route::get('listfinancialTransdetail', [CSVController::class, 'listfinancialTransdetail'])->name('listfinancialTransdetail');

