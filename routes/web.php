<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/',[PageController::class, 'home']);
Route::get('/about',[PageController::class, 'about'])->name('about');
Route::get('/service',[PageController::class, 'service'])->name('service');
Route::get('/project',[PageController::class, 'project'])->name('project');
Route::get('/contact',[PageController::class, 'contact'])->name('contact');

//Route::get('posts',[PostController::class, 'index']);

//Route::get('/posts',[PageController::class, 'index'])->name('posts.index');
//Route::get('/posts/{posts}',[PageController::class, 'show'])->name('posts.show');
//Route::get('/posts/create',[PageController::class, 'create'])->name('posts.create');
//Route::posts('/posts/create',[PageController::class, 'store'])->name('posts.create');
//Route::get('/posts/{posts}/edit',[PageController::class, 'edit'])->name('posts.edit');
//Route::put('/posts/{posts}/update',[PageController::class, 'update'])->name('posts.update');
//Route::delete('/posts/delete',[PageController::class, 'delete'])->name('posts.delete');

Route::resource('posts', PostController::class);

