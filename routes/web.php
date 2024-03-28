<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index'])
    ->name('menus.index');

Route::get('/menuViewer', [MenuController::class, 'showMenus'])
    ->name('menus.showMenus');

Route::get('/editPage', [MenuController::class, 'editPage'])
    ->name('edit.editPage');


// メニュー表示操作
Route::post('/editPage/post', [EditController::class, 'post'])
    ->name('edit.post');

Route::post('/editPage/{id}/destroy', [EditController::class, 'destroy'])
    ->name('edit.destroy')
    ->where('id', '[0-9]+');

Route::post('/editPage/{id}/toggle', [EditController::class, 'toggle'])
    ->name('edit.toggle')
    ->where('id', '[0-9]+');


// メニュー掲載画面
Route::get('/editPage/postPage', [EditController::class, 'postPage'])
    ->name('edit.postPage');

// Route::post('/editPage/postPage/date', [EditController::class, 'date'])
    // ->name('edit.date');


// 新規メニュー追加
Route::get('/editPage/create', [EditController::class, 'create'])
    ->name('edit.create');

Route::post('/editPage/store', [EditController::class, 'store'])
    ->name('edit.store');

Route::post('/editPage/create/store', [EditController::class, 'create_store'])
    ->name('edit.create_store');

