<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\PdfController;
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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::match(['get','post'],'/',[registrationController::class,'Register']);
Route::match(['get','post'],'/Add',[registrationController::class,'Add']);
Route::match(['get','post'],'/View/{id}',[registrationController::class,'View']);
Route::get('/download-pdf/{id}', [registrationController::class, 'downloadPdf'])->name('download-pdf');