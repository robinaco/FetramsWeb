<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('empresas','App\Http\Controllers\EmpresaController');
Route::resource('polizas','App\Http\Controllers\PolizaController');
Route::get('empresas/{empresa}/fileUpload', [EmpresaController::class, 'fileUpload'])->name('empresas.fileUpload');
Route::post('empresas/{id}/saveUpload', [EmpresaController::class, 'saveUpload'])->name('empresas.saveUpload');
Route::get('empresas/{id}/CrearPoliza', [EmpresaController::class, 'CrearPoliza'])->name('empresas.CrearPoliza');
Route::get('empresas/{id}/CrearVehiculo', [EmpresaController::class, 'CrearVehiculo'])->name('empresas.CrearVehiculo');
Route::get('empresas/{id}/show', [EmpresaController::class, 'show'])->name('empresas.show');
Route::get('empresas/{id}/destroy', [EmpresaController::class, 'destroy'])->name('empresas.destroy');
Route::get('exportempresas', [EmpresaController ::class, 'exportempresas'])->name('empresas.exportempresas');
Route::get('empresas/{id}/urlfile', [EmpresaController::class, 'urlfile'])->name('empresas.urlfile');
Route::get('empresas/{id}/deleteFile', [EmpresaController::class, 'deleteFile'])->name('empresas.deleteFile');
Route::post('empresas/SavePoliza', [EmpresaController::class, 'SavePoliza'])->name('empresas.SavePoliza');
Route::post('empresas/SaveVehiculo', [EmpresaController::class, 'SaveVehiculo'])->name('empresas.SaveVehiculo');
Route::get('empresas/{id}/EditarVehiculo', [EmpresaController::class, 'EditarVehiculo'])->name('empresas.EditarVehiculo');
Route::post('empresas/{id}/UpdateVehiculo', [EmpresaController::class, 'UpdateVehiculo'])->name('empresas.UpdateVehiculo');
Route::get('exportvehiculos', [EmpresaController ::class, 'exportvehiculos'])->name('empresas.exportvehiculos');
Route::get('exportpolizas', [EmpresaController ::class, 'exportpolizas'])->name('empresas.exportpolizas');











