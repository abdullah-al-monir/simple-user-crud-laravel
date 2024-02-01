<?php

use App\Models\Post;
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

/**
 * Home route.
 *
 * @return \Illuminate\Contracts\View\View View for the home page.
 */
Route::get('/', function () {
    $posts = [];

    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});

/**
 * Register a new user.
 *
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after registration.
 */
Route::post('/register', [UserController::class, 'register']);

/**
 * Log out the authenticated user.
 *
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after logout.
 */
Route::post('/logout', [UserController::class, 'logout']);

/**
 * Attempt to log in a user.
 *
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after login.
 */
Route::post('/login', [UserController::class, 'login']);

/**
 * Create a new blog post.
 *
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after creating a post.
 */
Route::post('/create-post', [PostController::class, 'createPost']);

/**
 * Show the edit screen for a blog post.
 *
 * @param \App\Models\Post $post The post to be edited.
 * @return \Illuminate\Contracts\View\View View for editing the post.
 */
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);

/**
 * Update a blog post.
 *
 * @param \App\Models\Post $post The post to be updated.
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after updating the post.
 */
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);

/**
 * Delete a blog post.
 *
 * @param \App\Models\Post $post The post to be deleted.
 * @return \Illuminate\Http\RedirectResponse Redirect to the home page after deleting the post.
 */
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
