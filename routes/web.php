<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminItemJanController;
use App\Http\Controllers\Admin\AdminItemKeepController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminLendingController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserItemController;
use App\Models\Admin;
use GuzzleHttp\Middleware;

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

Route::get('/', [UserItemController::class, 'index'])->middleware('auth:web')->name('user.index');
Route::get('/item/{item}', [UserItemController::class, 'show'])->middleware('auth:web')->name('user.item.show');
Route::post('/item/{item}', [UserItemController::class, 'reserve'])->middleware('auth:web')->name('user.item.reserve');
Route::patch('/item/{item}', [UserItemController::class, 'cancel'])->middleware('auth:web')->name('user.item.cancel');

Route::get('/login', [UserAuthController::class, 'show'])->name('user.show');
Route::post('/login', [UserAuthController::class, 'login'])->name('login');



Route::get('/admin/login', [AdminAuthController::class, 'show'])->name('admin.show');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');


Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth:admin']], function() {
    Route::view('/', 'admin.index')->name('index');
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::resource('member', AdminController::class);
    Route::resource('item', AdminItemController::class);
    Route::post('item_import', [AdminItemController::class, 'import'])->name('item.import');
    Route::get('item_export', [AdminItemController::class, 'export'])->name('item.export');
    Route::resource('item.jan', AdminItemJanController::class);
    Route::get('/keep', [AdminItemKeepController::class, 'index'])->name('item.keep.index');
    Route::delete('/keep', [AdminItemKeepController::class, 'destroy'])->name('item.keep.destroy');
    Route::get('/item/{item}/keep/create', [AdminItemKeepController::class, 'create'])->name('item.keep.create');
    Route::post('/item/{item}/keep/create', [AdminItemKeepController::class, 'store'])->name('item.keep.store');
    Route::resource('user', AdminUserController::class);
    Route::get('/lend', [AdminLendingController::class, 'showLend'])->name('showLend');
    Route::post('/lend', [AdminLendingController::class, 'lend'])->name('lend');
    Route::get('/return', [AdminLendingController::class, 'showReturn'])->name('showReturn');
    Route::patch('/return', [AdminLendingController::class, 'return'])->name('return');

});


Route::group(['prefix' => 'user', 'as' => 'user.','middleware' => ['auth:web']], function() {
    Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::resource('member', UserController::class);
});

Route::get('/phpinfo', function() {
    phpinfo();
});

