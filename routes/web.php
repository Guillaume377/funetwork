<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// ***************************** page de connexion / inscription ********************************* */

// Route:: méthode http ( url, [ emplacement du contrôleur concerné, méthode du ctrl concerné ])-> nom de la route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


// ***************************** ACCUEIL (home.blade.php)/ liste des messages ********************* */

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');


//*******************************routes AUTHENTIFICATION (Laravel UI) ***************************** */

Auth::routes();


// ****************************** route resource USERS ***************************************** */
Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');


//******************************* route resource POSTS *************************************** */
Route::resource('/post', App\Http\Controllers\PostController::class)->except('index', 'create', 'show');


//******************************* route resource COMMENTS *************************************** */
Route::resource('/comment', App\Http\Controllers\CommentController::class)->except('index', 'create', 'show');


// ************************************************ route SEARCH ********************************* */
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');
