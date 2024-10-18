<?php

use App\Http\Controllers\Account;
use App\Http\Controllers\Bxtest;
use App\Http\Controllers\Comments;
use App\Http\Controllers\Posts;
use App\Http\Controllers\Cars;
use App\Http\Controllers\Brands;
use App\Http\Controllers\Auth\Sessions;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\Cars as PublicCars; 
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/auth')->middleware('guest')->group(function () {
    Route::controller(Sessions::class)->group(function () {
        Route::get('/login', 'create')->name('auth.sessions.create');
        Route::post('/login', 'store')->name('auth.sessions.store');
    });
});

Route::middleware(['auth'])->get('/secret', function () {
    return 'secret page';
});

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function () {
    // code here smthng

    Route::resource('posts', Posts::class);

    // Route::get('/home', [Cars::class, 'index']);
    // Route::get('/posts', [Posts::class, 'index']);
    // Route::get('/posts/create', [Posts::class, 'create']);
    // Route::get('/posts/{id}', [Posts::class, 'show'])->name('posts.show');
    // Route::post('/posts', [Posts::class, 'store']);
    // Route::get('/posts/{id}/edit', [Posts::class, 'edit']);
    // Route::put('/posts/{id}', [Posts::class, 'update'])->name('posts.update');

    Route::middleware('can:cars')->group(function(){
        Route::get('cars/trashed', [Cars::class, 'trashed'])->name('cars.trashed');
        Route::put('cars/{car}/restore', [Cars::class, 'restore'])->name('cars.restore');
        Route::resource('cars', Cars::class); // Автоматом генерирует всю схему выше
    });

    Route::resource('brands', Brands::class);
    Route::get('/account', [Account::class, 'index'])->name('account.index');
    Route::delete('/logout', [Sessions::class, 'destroy'])->name('auth.sessions.destroy');

});
Route::middleware(['auth', 'verified'])->prefix('/account')->group(function () {
    Route::get('/contracts/{id}', [Bxtest::class, 'show'])->middleware('api.fields')->name('bx.show');
    Route::resource('/contracts', Bxtest::class)->middleware('api.fields');
});


Route::get('/', [PublicCars::class, 'index'])->name('home');
// Обратить внимание на порядок, иначе /create ловит как id поста и тогда полчаем 404
Route::get('/catalog/{car}', [PublicCars::class, 'show'])->name('catalog.show');

Route::post('/comments', [Comments::class, 'store'])->name('comments.store');

