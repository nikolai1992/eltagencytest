<?php

use App\Http\Controllers\Admin\CasteFieldsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\LanguageController;
use App\Http\Middleware\SetLocaleMiddleware;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'roles', 'roles'=> ['admin'], 'prefix' => 'admin'], function()
{
    Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');
    Route::resource('films', FilmController::class);
    Route::resource('caste-fields', CasteFieldsController::class);
    Route::resource('tags', TagsController::class);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/setlocale/{lang}', [LanguageController::class, 'setPrefix'])->name('setlocale');

Route::group([
    'prefix'     => SetLocaleMiddleware::getLocale(),
    'middleware' => ['setLocale'],
], function () {
    Route::get('/', [FrontController::class, 'index'])->name('mainPage');
    Route::get('/film/{id}', [App\Http\Controllers\Front\FilmController::class, 'show'])->name('filmShow');
});
