<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FQAController;
use App\Http\Controllers\SettingsConroller;

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
Route::get('/', [AdminLoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AdminLoginController::class, 'getLogin'])->middleware('guest')->name('admin.getLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/sections/archived-sections', [SectionController::class, 'ArchivedSections'])->name('sections.archived.sections');
    Route::post('/delete-forever', [SectionController::class, 'DeleteForever'])->name('section.delete.forever');
    Route::get('/section-delete/{id}', [SectionController::class, 'destroy'])->name('section.delete');
    Route::get('/section-restore/{id}', [SectionController::class, 'RestoreElement'])->name('section.restore');
    Route::post('sections/archive-all', [SectionController::class, 'ArchiveAll'])->name('sections.muliple.archive');
    Route::post('sections/restore-all', [SectionController::class, 'RestoreAll'])->name('sections.muliple.restore');
    Route::resource("sections", \SectionController::class);
    Route::resource("clients", \ClientController::class);
    Route::get('/client/change-status/{id}', [ClientController::class, 'changeStatus'])->name('clients.change.status');
    Route::post('/clients/change-status-all', [ClientController::class, 'ChangeStatusAll'])->name('clients.change.status.all');
    Route::get('/clients/status/{status}', [ClientController::class, 'SatatusSection'])->name('clients.status.filter');
    Route::get('/clients/is-register/{is_registered}', [ClientController::class, 'IsRegisterSection'])->name('clients.is.register.filter');


    Route::get('/settings/technical-support', [SettingsConroller::class, 'TechnicalSupport'])->name('settings.technical.support');
    Route::get('/settings/about-us', [SettingsConroller::class, 'AboutUs'])->name('settings.About.Us');
    Route::post('/settings/store', [SettingsConroller::class, 'store'])->name('settings.store');
    Route::get('/settings/fqa', [FQAController::class, 'index'])->name('settings.fqa.index');
    Route::get('/settings/fqa/create', [FQAController::class, 'createOrUpdate'])->name('settings.fqa.create');
    Route::get('/settings/fqa/update/{id}', [FQAController::class, 'createOrUpdate'])->name('settings.fqa.update');
    Route::post('/settings/fqa/delete', [FQAController::class, 'delete'])->name('settings.fqa.delete');
    Route::post('/settings/fqa/delete-all', [FQAController::class, 'DeleteAll'])->name('settings.fqa.delete.all');

});