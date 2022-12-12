<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('UserControl')->group(function (){
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('account', [UserController::class, 'accountView'])->name('acc');
    Route::get('admin', [UserController::class, 'adminView'])->middleware('AdminControl')->name('admin');

    Route::get('basket', [ProductController::class, 'basketView'])->name('basket');
    Route::post('basket/buy{id}', [ProductController::class, 'basketPost'])->name('basket_buy');
    Route::post('basket/count{purchase}', [ProductController::class, 'basketCountPost'])->name('basket_count');
    Route::post('basket/delete{id}', [ProductController::class, 'basketDeletePost'])->name('basket_delete');

    Route::get('addproduct', [ProductController::class, 'productAddView'])->middleware('AdminControl')->name('add_product');
    Route::post('addproduct', [ProductController::class, 'productAddPost']);

    Route::post('/', [MainController::class, 'mainPost']);
});

Route::get('/', [MainController::class, 'mainView'])->name('/');

Route::get('registration', [UserController::class, 'registrationView'])->name('reg');
Route::post('registration', [UserController::class, 'registrationPost']);

Route::get('authorization', [UserController::class, 'authorizationView'])->name('auth');
Route::post('authorization', [UserController::class, 'authorizationPost']);

Route::get('404', [MainController::class, 'error_404'])->name('404');
