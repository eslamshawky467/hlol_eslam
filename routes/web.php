<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\FQAController;
use App\Http\Controllers\ServicesController;
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

    // ----------------------------------banner routes------------------------------------
    Route::get('/banners', [BannersController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannersController::class, 'create'])->name('banners.create');
    Route::post('/banners/store', [BannersController::class, 'store'])->name('banners.store');
    Route::get('/banners/edit/{id}', [BannersController::class, 'edit'])->name('banners.edit');
    Route::post('/banners/update', [BannersController::class, 'update'])->name('banners.update');
    Route::post('/banners/delete', [BannersController::class, 'destroy'])->name('banners.destroy');
    Route::post('/banners/banner-all', [BannersController::class, 'BannerAll'])->name('banners.banner.all');
    Route::get('/banners/change-status/{id}', [BannersController::class, 'changeStatus'])->name('banners.change.status');
    Route::get('/banners/status/{status}', [BannersController::class, 'SatatusBanner'])->name('banners.status.filter');
    // ----------------------------------service routes------------------------------------
    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServicesController::class, 'store'])->name('services.store');
    Route::get('/services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
    Route::post('/services/update', [ServicesController::class, 'update'])->name('services.update');
    Route::post('/services/delete', [ServicesController::class, 'destroy'])->name('services.destroy');
    Route::post('/services/restore', [ServicesController::class, 'Restore'])->name('services.Restore');
    Route::post('/services/services-all', [ServicesController::class, 'ServicesAll'])->name('services.all');
    Route::get('/services/change-status/{id}', [ServicesController::class, 'changeStatus'])->name('services.change.status');
    Route::get('/services/status/{status}', [ServicesController::class, 'SatatusService'])->name('services.status.filter');
    Route::get('/services/archived-services', [ServicesController::class, 'ArchivedServices'])->name('services.archived.services');
    // ----------------------------------Coupons routes------------------------------------
    Route::get('/coupons', [CouponsController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponsController::class, 'create'])->name('coupons.create');
    Route::post('/coupons/store', [CouponsController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/edit/{id}', [CouponsController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupons/update', [CouponsController::class, 'update'])->name('coupons.update');
    Route::post('/coupons/delete', [CouponsController::class, 'destroy'])->name('coupons.destroy');
    Route::post('/coupons/restore', [CouponsController::class, 'Restore'])->name('coupons.Restore');
    Route::post('/coupons/coupons-all', [CouponsController::class, 'ServicesAll'])->name('coupons.all');
    Route::get('/coupons/change-status/{id}', [CouponsController::class, 'changeStatus'])->name('coupons.change.status');
    Route::get('/coupons/status/{status}', [CouponsController::class, 'SatatusService'])->name('coupons.status.filter');
    Route::get('/coupons/archived-coupons', [CouponsController::class, 'ArchivedServices'])->name('coupons.archived.coupons');


});
