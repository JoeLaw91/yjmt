<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index']);

Route::prefix('posts')->group(function () {
    Route::get('create', [PostController::class,'create'])->middleware('auth');
    Route::post('create', [PostController::class,'store'])->middleware('auth')->name('post.create');
    Route::get('{post:uuid}/edit', [PostController::class, 'edit'])->middleware('auth');
    Route::get('sort_posts', [PostController::class, 'sortPosts'])->name('sort_posts');
    Route::get('/{post:uuid}', [PostController::class, 'show']);
    Route::patch('{post:uuid}', [PostController::class, 'update'])->middleware('auth');
    Route::delete('{post:uuid}', [PostController::class, 'destroy'])->middleware('auth');
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts',[
        'posts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts',[
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
});

Route::get('register', [RegisterController::class,'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');
Route::get('login', [SessionsController::class,'create'])->middleware('guest');
Route::post('login', [SessionsController::class,'store'])->middleware('guest');
Route::post('logout', [SessionsController::class,'destroy'])->middleware('auth');
