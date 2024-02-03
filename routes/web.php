<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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
//ruta del homme
Route::get('/',HomeController::class)->name('home');

//rutas del login
Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name("logout");

//rutas del registro
Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register', [RegisterController::class, 'store']);

//rutas para el perfil
Route::get('/editar-perfil', [perfilController::class, 'index'])->name("perfil.index");
Route::post('/editar-perfil', [perfilController::class, 'store'])->name("perfil.store");

//rutas para los post
Route::get('/{user:username}', [PostController::class, 'index'])->name("posts.index");
Route::get('/post/create', [PostController::class, 'create'])->name("posts.create");
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name("posts.show");
Route::post('/{user:username}/post/{post}', [ComentarioController::class, 'store'])->name("comentarios.store");
Route::post('/post', [PostController::class, 'store'])->name("posts.store");
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name("posts.destroy");


//ruta para las imagenes del registro
Route::post('/imagenes', [ImagenesController::class, 'store'])->name("imagenes.store");

//rutas para los likes
Route::post('/post/{post}/like', [LikeController::class, 'store'])->name("posts.likes.store");
Route::delete('/post/{post}/like', [LikeController::class, 'destroy'])->name("posts.likes.destroy");

//rutas para los followers
Route::get('/{user:username}/followers', [FollowerController::class, 'index'])->name("users.followers");
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name("users.follow");
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name("users.unfollow");


