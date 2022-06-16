<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserRoleController;

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
    return redirect('login');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Products
Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/product-list', [ProductController::class, 'productlist'])->name('list');
    Route::get('/add', [ProductController::class, 'add'])->name('add');
    Route::post('/product-store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/product-update', [ProductController::class, 'update'])->name('update');
    Route::post('/product-search', [ProductController::class, 'search'])->name('search');
    Route::post('/delete', [ProductController::class, 'delete'])->name('delete');
    Route::get('/import', [ProductController::class, 'import'])->name('import');
    Route::post('/import', [ProductController::class, 'importsubmit'])->name('importsubmit');


});


//Route::post('prolist', [ProductController::class, 'proList'])->name('pro-list');

Route::get('users', [UserRoleController::class, 'index'])->name('users.index');
Route::get('set-permission/{id}', [UserRoleController::class, 'setpermission'])->name('users.setpermission');
Route::post('set-permissionsubmit', [UserRoleController::class, 'permissionSubmit'])->name('permission.store');


});
