<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SendEmailController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');

// Route::get('/brands', function () {
//     return "ehllo";
// });
Route::get('/brands', [BrandController::class, 'index'])->name('brands');
Route::get('/brand/add', [BrandController::class, 'add'])->name('brand.add');
Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
Route::post('/brand/update', [BrandController::class, 'update'])->name('brand.update');

// Route::get('/get-table', [BrandController::class, 'getTable']);

// Route::get('send-email', [SendEmailController::class, 'index']);
