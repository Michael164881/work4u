<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

use App\Http\Controllers\ServiceController;

/* Customer */
Route::get('/job-request/create', [App\Http\Controllers\JobRequestController::class, 'create'])->name('jobRequest.create');
Route::post('/job-request/store', [App\Http\Controllers\JobRequestController::class, 'store'])->name('jobRequest.store');
Route::get('/job-request/{id}', [App\Http\Controllers\JobRequestController::class, 'show'])->name('jobRequest.show');
Route::get('/job-request/{id}/edit', [App\Http\Controllers\JobRequestController::class, 'edit'])->name('jobRequest.edit');
Route::post('/job-request/{id}', [App\Http\Controllers\JobRequestController::class, 'update'])->name('jobRequest.update');
Route::delete('/job-request/{id}', [App\Http\Controllers\JobRequestController::class, 'destroy'])->name('jobRequest.destroy');

Route::get('/service/{id}', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
Route::get('pageCustBrowse/{page}', [App\Http\Controllers\PageControllerCustBrowse::class, 'index'])->name('pageCustBrowse.index');
Route::get('pageCustMap/{page}', [App\Http\Controllers\PageControllerCustMap::class, 'index'])->name('pageCustMap.index');
Route::get('pageCust/{page}', [App\Http\Controllers\PageControllerCust::class, 'index'])->name('pageCust.index');

/* Freelancer */
Route::get('/work-description/create', [App\Http\Controllers\WorkDescriptionController::class, 'create'])->name('workDescription.create');
Route::post('/work-description/store', [App\Http\Controllers\WorkDescriptionController::class, 'store'])->name('workDescription.store');
Route::get('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'show'])->name('workDescription.show');
Route::get('/work-description/{id}/edit', [App\Http\Controllers\WorkDescriptionController::class, 'edit'])->name('workDescription.edit');
Route::post('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'update'])->name('workDescription.update');
Route::delete('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'destroy'])->name('workDescription.destroy');

Route::get('/serviceFL/{id}', [App\Http\Controllers\ServiceFLController::class, 'index'])->name('serviceFL.index');
Route::get('pageFLBrowse/{page}', [App\Http\Controllers\PageControllerFLBrowse::class, 'index'])->name('pageFLBrowse.index');
Route::get('pageFLMap/{page}', [App\Http\Controllers\PageControllerFLMap::class, 'index'])->name('pageFLMap.index');
Route::get('pageFL/{page}', [App\Http\Controllers\PageControllerFL::class, 'index'])->name('pageFL.index');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


