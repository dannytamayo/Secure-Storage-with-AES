<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\MicrosoftController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\FiseiController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\UploadController;
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

Route::get('/', function(){
    return;
})->middleware('roles.redirect');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth.admin')->name('dashboard');

    Route::get('/explorer', [ExplorerController::class, 'index']);

});

Route::get('auth/microsoft/redirect', [MicrosoftController::class, 'handleMicrosoftRedirect']);

Route::get('auth/microsoft/callback', [MicrosoftController::class, 'handleMicrosoftCallback']);

Route::prefix('dashboard')->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::resource('folder', FolderController::class);
    Route::get('folder/upload/{id}', [UploadController::class, 'index'])->name('upload.files');
    Route::post('folder/upload', [UploadController::class, 'upload'])->name('upload');
    
})->middleware('auth.admin');




