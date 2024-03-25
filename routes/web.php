<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index'])
    ->name('menus.index');

Route::get('/menuViewer', [MenuController::class, 'showMenus'])
    ->name('menus.showMenus');


// 管理者ページ
Route::get('/editPage', [MenuController::class, 'editPage'])
    ->name('edit.editPage');

Route::post('/editPage/store', [EditController::class, 'store'])
    ->name('edit.store');
