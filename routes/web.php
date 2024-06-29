<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopUpController;




// Routes for displaying the payment method selection page
Route::get('/payment/debit', function() {
    return view('customer.pages.payment.debit');
})->name('payment.debit');

Route::get('/payment/ewallet', function() {
    return view('customer.pages.payment.ewallet');
})->name('payment.ewallet');

Route::get('/payment/qr', function() {
    return view('customer.pages.payment.qr');
})->name('payment.qr');

// Routes for processing the payment forms
Route::post('/payment/debit', [App\Http\Controllers\TopUpController::class, 'processDebit'])->name('payment.debit.process');
Route::post('/payment/ewallet', [App\Http\Controllers\TopUpController::class, 'processEwallet'])->name('payment.ewallet.process');
Route::post('/payment/qr', [App\Http\Controllers\TopUpController::class, 'processQr'])->name('payment.qr.process');

Route::post('/payment/ewallet/redirect', [App\Http\Controllers\TopUpController::class, 'redirectToTouchNGo'])->name('payment.ewallet.redirect');


Route::post('/payment/process', [App\Http\Controllers\TopUpController::class, 'process'])->name('payment.process');
Route::get('/payment/debit', [App\Http\Controllers\TopUpController::class, 'debit'])->name('payment.debit');
Route::get('/payment/ewallet', [App\Http\Controllers\TopUpController::class, 'ewallet'])->name('payment.ewallet');
Route::post('/ewallet/reload', [App\Http\Controllers\TopUpController::class, 'reloadEwallet'])->name('ewallet.reload');
Route::get('/payment/qr', [App\Http\Controllers\TopUpController::class, 'qr'])->name('payment.qr');

Route::get('/ewallet/withdraw', [App\Http\Controllers\WithdrawController::class, 'withdrawPage'])->name('ewallet.withdrawPage');
Route::post('/ewallet/withdraw', [App\Http\Controllers\WithdrawController::class, 'withdraw'])->name('ewallet.withdraw');

Route::post('/ewallet/withdraw', [App\Http\Controllers\EWalletController::class, 'withdraw'])->name('ewallet.withdraw');

Route::get('/ewallet/withdraw', [App\Http\Controllers\WithdrawController::class, 'withdrawPage'])->name('ewallet.withdrawPage');
Route::post('/ewallet/withdraw', [App\Http\Controllers\WithdrawController::class, 'withdraw'])->name('ewallet.withdraw');








// Add routes for processing debit and QR code payments similarly



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

//ADMIN

use App\Http\Controllers\AdminCancelationController;
use App\Http\Controllers\AdminStatisticController;
use App\Http\Controllers\AdminUserManagementController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

Route::get('/cancel', [App\Http\Controllers\AdminCancelationController::class, 'index'])->name('cancel.index');

Route::get('/statistic', [App\Http\Controllers\AdminStatisticController::class, 'index'])->name('statistic.index');
Route::get('/statistic/export', [App\Http\Controllers\AdminStatisticController::class, 'export'])->name('statistic.export');


Route::get('/users', [App\Http\Controllers\AdminUserManagementController::class, 'index'])->name('users.index'); 
Route::get('/user/{id}', [App\Http\Controllers\AdminUserManagementController::class, 'show'])->name('users.show');
Route::get('/user/{id}/edit', [App\Http\Controllers\AdminUserManagementController::class, 'edit'])->name('users.edit');
Route::put('/user/{id}', [App\Http\Controllers\AdminUserManagementController::class, 'update'])->name('users.update');
Route::delete('/user/{id}', [App\Http\Controllers\AdminUserManagementController::class, 'destroy'])->name('users.destroy');

use App\Http\Controllers\AdminFreelancerManagementController;

Route::get('/freelancers', [App\Http\Controllers\AdminFreelancerManagementController::class, 'index'])->name('freelancers.index');
Route::get('/freelancers/{id}', [App\Http\Controllers\AdminFreelancerManagementController::class, 'show'])->name('freelancers.show');
Route::get('/freelancers/{id}/edit', [App\Http\Controllers\AdminFreelancerManagementController::class, 'edit'])->name('freelancers.edit');
Route::put('/freelancers/{id}', [App\Http\Controllers\AdminFreelancerManagementController::class, 'update'])->name('freelancers.update');
Route::delete('/freelancers/{id}', [App\Http\Controllers\AdminFreelancerManagementController::class, 'destroy'])->name('freelancers.destroy');

use App\Http\Controllers\AdminJobController;

Route::get('/job', [App\Http\Controllers\AdminJobController::class, 'index'])->name('job.index');
Route::get('/job/job-request/{id}', [App\Http\Controllers\AdminJobController::class, 'showJobRequest'])->name('job.showJobRequest');
Route::get('/job/work-description/{id}', [App\Http\Controllers\AdminJobController::class, 'showWorkDescription'])->name('job.showWorkDescription');

Route::get('/job/job-request/edit/{id}', [App\Http\Controllers\AdminJobController::class, 'editJobRequest'])->name('job.editJobRequest');
Route::post('/job/job-request/update/{id}', [App\Http\Controllers\AdminJobController::class, 'updateJobRequest'])->name('job.updateJobRequest');

Route::get('/job/work-description/edit/{id}', [App\Http\Controllers\AdminJobController::class, 'editWorkDescription'])->name('job.editWorkDescription');
Route::post('/job/work-description/update/{id}', [App\Http\Controllers\AdminJobController::class, 'updateWorkDescription'])->name('job.updateWorkDescription');

Route::delete('/job/job-request/delete/{id}', [App\Http\Controllers\AdminJobController::class, 'destroyJobRequest'])->name('job.destroyJobRequest');
Route::delete('/job/work-description/delete/{id}', [App\Http\Controllers\AdminJobController::class, 'destroyWorkDescription'])->name('job.destroyWorkDescription');

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ExportController;

Route::get('/export/work-descriptions', [ExportController::class, 'exportWorkDescriptions'])->name('export.work_descriptions');
Route::get('/export/job-requests', [ExportController::class, 'exportJobRequests'])->name('export.job_requests');


//ADMIN

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

Route::get('/hire/{service}', [App\Http\Controllers\ServiceController::class, 'showHirePage'])->name('hire.show');
Route::post('/hire/{service}', [App\Http\Controllers\ServiceController::class, 'processHire'])->name('hire.process');

Route::get('/bid/{id}', [App\Http\Controllers\BidController::class, 'index'])->name('hireBid.index');
Route::get('/hireBid/{bid}', [App\Http\Controllers\BidController::class, 'showHireBid'])->name('hireBid.show');
Route::post('/hireProcessBid/{bid}', [App\Http\Controllers\BidController::class, 'processHireBid'])->name('hireBid.process');

use App\Http\Controllers\BookingController;

Route::get('/bookings/{page}', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings/{id}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('bookings.cancel');
Route::get('/bookings/{id}/show', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
Route::post('/bookings/{id}/rate', [App\Http\Controllers\BookingController::class, 'rate'])->name('bookings.rate');

Route::get('/top-up/payment-method', [App\Http\Controllers\TopUpController::class, 'showPaymentMethod'])->name('top-up.payment-method');
Route::post('/top-up/process', [App\Http\Controllers\TopUpController::class, 'reloadEWallet'])->name('top-up.process');


/* Freelancer */
Route::get('/work-description/create', [App\Http\Controllers\WorkDescriptionController::class, 'create'])->name('workDescription.create');
Route::post('/work-description/store', [App\Http\Controllers\WorkDescriptionController::class, 'store'])->name('workDescription.store');
Route::get('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'show'])->name('workDescription.show');
Route::get('/work-description/{id}/edit', [App\Http\Controllers\WorkDescriptionController::class, 'edit'])->name('workDescription.edit');
Route::post('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'update'])->name('workDescription.update');
Route::delete('/work-description/{id}', [App\Http\Controllers\WorkDescriptionController::class, 'destroy'])->name('workDescription.destroy');

use App\Http\Controllers\PageControllerFLBrowse;
use App\Http\Controllers\PageControllerFLBooking;

Route::get('/hireFL/{service}', [App\Http\Controllers\ServiceFLController::class, 'showHirePage'])->name('hireFL.show');
Route::get('/serviceFL/{service}', [App\Http\Controllers\ServiceFLController::class, 'index'])->name('serviceFL.index');


Route::post('/bid/process/{service}', [App\Http\Controllers\BidController::class, 'processBid'])->name('bid.process');
Route::post('/bid/update/{id}', [App\Http\Controllers\BidController::class, 'update'])->name('bid.update');

Route::get('pageFLBrowse/{page}', [App\Http\Controllers\PageControllerFLBrowse::class, 'index'])->name('pageFLBrowse.index');
Route::get('pageFLMap/{page}', [App\Http\Controllers\PageControllerFLMap::class, 'index'])->name('pageFLMap.index');
Route::get('pageFL/{page}', [App\Http\Controllers\PageControllerFL::class, 'index'])->name('pageFL.index');


Route::get('pageFLBooking/{page}', [App\Http\Controllers\PageControllerFLBooking::class, 'index'])->name('pageFLBooking.index');
Route::get('pageFLBooking/{id}/show', [App\Http\Controllers\PageControllerFLBooking::class, 'show'])->name('pageFLBooking.show');

Route::post('/bookings/{bookingId}/checklist', [PageControllerFLBooking::class, 'addChecklistItem'])->name('checklist.add');
Route::put('/checklist/{itemId}', [PageControllerFLBooking::class, 'updateChecklistItem'])->name('checklist.update');
Route::delete('/checklist/{itemId}', [PageControllerFLBooking::class, 'deleteChecklistItem'])->name('checklist.delete');
Route::post('/bookings/{bookingId}/end', [PageControllerFLBooking::class, 'endTask'])->name('task.end');


Auth::routes();

Route::get('/home', 'App\Http\Controllers\AdminController@index')->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\AdminController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});





