<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\MenuController;

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// 公開ページ
Route::get('/', [MenuController::class, 'index'])
    ->name('menus.index');

Route::get('/menuViewer', [MenuController::class, 'showMenus'])
    ->name('menus.showMenus');

Route::post('/menuViewer/{id}/detail', [MenuController::class, 'detail'])
    ->name('menus.detail')
    ->where('id', '[0-9]+');

Route::get('/editPage', [MenuController::class, 'editPage'])
    ->middleware(['auth', 'verified'])
    ->name('edit.editPage');


// メニュー表示操作
Route::post('/editPage/post', [EditController::class, 'post'])
    ->middleware(['auth', 'verified'])
    ->name('edit.post');

Route::post('/editPage/{id}/destroy', [EditController::class, 'destroy'])
    ->name('edit.destroy')
    ->where('id', '[0-9]+');

Route::post('/editPage/{id}/toggle', [EditController::class, 'toggle'])
    ->middleware(['auth', 'verified'])
    ->name('edit.toggle')
    ->where('id', '[0-9]+');

Route::post('/editPage/calendar', [EditController::class, 'calendar'])
    ->middleware(['auth', 'verified'])
    ->name('edit.calendar');


// メニュー掲載画面
Route::get('/editPage/postPage', [EditController::class, 'postPage'])
    ->middleware(['auth', 'verified'])
    ->name('edit.postPage');


// 新規メニュー追加
Route::get('/editPage/create', [EditController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('edit.create');

Route::post('/editPage/store', [EditController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('edit.store');

Route::post('/editPage/create/store', [EditController::class, 'create_store'])
    ->middleware(['auth', 'verified'])
    ->name('edit.create_store');



