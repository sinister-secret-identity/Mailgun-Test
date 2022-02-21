<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\ShowEmails;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MessageController;

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

Route::view('/', 'welcome')->name('home');
Route::view('/create-email', 'create-email')->name('create-email');
Route::view('/history', 'history')->name('history');

//Route::get("send-email", [EmailController::class, "sendEmail"]);
Route::post('store-email', [MessageController::class, 'store']);

Route::post('webhooks/email_delivered','WebhookController@emailDelivered');
Route::post('webhooks/email_opened','WebhookController@emailOpened');
Route::post('webhooks/email_clicked','WebhookController@emailClicked');
Route::post('webhooks/fail_temp','WebhookController@failTemp');
Route::post('webhooks/fail_perm','WebhookController@failPerm');
Route::post('webhooks/unsubscribe','WebhookController@unsubscribe');
Route::post('webhooks/spam','WebhookController@spam');


Route::get('/show-emails', ShowEmails::class)
    ->name('emails')
    ->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

