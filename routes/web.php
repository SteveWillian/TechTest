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

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EventCredentialsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\JobsController;

Route::get('/', function () {
	return redirect('/users');
})->middleware('auth');


Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::group(['middleware' => 'auth'], function () {
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	/** Users */
	Route::get('/users', [UsersController::class, 'show'])->name('users');
	Route::get('/users_create', [UsersController::class, 'create'])->name('users_create');
	Route::get('/users_edit/{id?}', [UsersController::class, 'edit'])->name('users_edit');
	Route::post('/users_store', [UsersController::class, 'store'])->name('users_store');
	Route::post('/users_update', [UsersController::class, 'update'])->name('users_update');
	Route::post('/users_delete/{id?}', [UsersController::class, 'delete'])->name('users_delete');

	Route::get('/jobs', [JobsController::class, 'show'])->name('jobs');
	Route::get('/jobs_create', [JobsController::class, 'create'])->name('jobs_create');
	Route::get('/jobs_filter', [JobsController::class, 'filter'])->name('jobs_filter');
	Route::get('/jobs_edit/{id?}', [JobsController::class, 'edit'])->name('jobs_edit');
	Route::get('/jobs_detail/{id?}', [JobsController::class, 'detail'])->name('jobs_detail');
	Route::get('/jobs_applicants/{id?}', [JobsController::class, 'applicants'])->name('jobs_applicants');
	Route::post('/jobs_store', [JobsController::class, 'store'])->name('jobs_store');
	Route::post('/jobs_update', [JobsController::class, 'update'])->name('jobs_update');
	Route::post('/jobs_postulate', [JobsController::class, 'postulate'])->name('jobs_postulate');
	Route::post('/jobs_delete/{id?}', [JobsController::class, 'delete'])->name('jobs_delete');
});
