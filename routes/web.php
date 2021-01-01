<?php

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('index');
Route::get('/search', [\App\Http\Controllers\MainController::class, 'search'])->name('search');
//AD
Route::get('/a/{id}', [\App\Http\Controllers\AdController::class, 'index'])->name('ad.index');

Route::get('/new', [\App\Http\Controllers\AdController::class, 'newAd'])->name('ad.new');
Route::post('/create', [\App\Http\Controllers\AdController::class, 'create'])->name('ad.create');
Route::post('/delete', [\App\Http\Controllers\AdController::class, 'delete'])->name('ad.delete');

Route::get('/edit/{id}', [\App\Http\Controllers\AdController::class, 'edit'])->name('ad.edit');
Route::post('/a/edit', [\App\Http\Controllers\AdController::class, 'editPost'])->name('ad.edit_post');

Route::post('/favorite', [\App\Http\Controllers\AdController::class, 'favorite'])->name('ad.favorite');

//COMMENT
Route::post('/newcomment', [\App\Http\Controllers\AdController::class, 'newComment'])->name('ad.new_comment');

//USER
Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'userPage'])->name('user.page');
Route::get('/mypage', [\App\Http\Controllers\UserController::class, 'myPage'])->name('user.mypage');
Route::get('/myfavorites', [\App\Http\Controllers\UserController::class, 'myFavorites'])->name('user.myfavorites');

Route::get('language/kz', [\App\Http\Controllers\LanguageController::class, 'kz'])->name('lang-kz');
Route::get('language/ru', [\App\Http\Controllers\LanguageController::class, 'ru'])->name('lang-ru');
Route::get('language/en', [\App\Http\Controllers\LanguageController::class, 'en'])->name('lang-en');

//ROLE
Route::get('newcategory', [\App\Http\Controllers\RoleController::class, 'newCategory'])->name('admin.new_category');
Route::post('newcategorypost', [\App\Http\Controllers\RoleController::class, 'newCategoryPost'])->name('admin.new_category_post');

Route::get('giverole', [\App\Http\Controllers\RoleController::class, 'giveRole'])->name('admin.give_role');
Route::get('giverole/{user_id}/{role_id}', [\App\Http\Controllers\RoleController::class, 'giveRoleGet'])->name('admin.give_role_get');

Route::post('notice', [\App\Http\Controllers\RoleController::class, 'notice'])->name('notice');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
