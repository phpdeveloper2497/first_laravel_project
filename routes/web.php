<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[PageController::class, 'home'])->name('main');
Route::get('/about',[PageController::class, 'about'])->name('about');
Route::get('/service',[PageController::class, 'service'])->name('service');
Route::get('/project',[PageController::class, 'project'])->name('project');
Route::get('/contact',[PageController::class, 'contact'])->name('contact');

//Route::get('posts',[PostController::class, 'index']);

//Route::get('/posts',[PostController::class, 'index'])->name('posts.index');
//Route::get('/posts/{posts}',PostController::class, 'show'])->name('posts.show');
//Route::get('/posts/create',PostController::class, 'create'])->name('posts.create');
//Route::posts('/posts/create',[PageController::class, 'store'])->name('posts.create');
//Route::get('/posts/{posts}/edit',PostController::class, 'edit'])->name('posts.edit');
//Route::put('/posts/{posts}/update',PostController::class, 'update'])->name('posts.update');
//Route::delete('/posts/delete',[CoPostController::class, 'delete'])->name('posts.delete');

//Route::resource('posts', PostController::class);
//Route::resource('comments', CommentsController::class);

//yuqoridagi resource larni qisqacha yozish

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentsController::class,
    'users' => UserController::class
]);

Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::get('sign',[AuthController::class,'sign'])->name('sign');
Route::post('sign',[AuthController::class,'sign_store'])->name('sign.store');

//Route::get('usercomment',[AuthController::class,'usercomment'])->name('usercomment');
