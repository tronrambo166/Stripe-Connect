<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\testController;

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

//Route::get('/', 'testController@login');
Route::get('forgot/{remail}', 'testController@forgot')->name('forgot');
Route::post('send_reset_email', 'testController@send_reset_email')->name('send_reset_email');
Route::post('reset/{remail}', 'testController@reset')->name('reset');


Route::group(['middleware'=>['checkAuth']], function(){

//Inside
//Route::get('home', 'testController@home')->name('home');

});


//Route::get('{anypath}', 'testController@home')->where('path', '.*');

Auth::routes();
Route::get('/', 'HomeController@home');//->name('home');
Route::get('home', 'HomeController@home')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('social', 'HomeController@social')->name('social'); 
Route::get('radio', 'HomeController@radio')->name('radio');
Route::get('breakdown', 'HomeController@breakdown')->name('breakdown');

Route::get('/stripe', 'checkoutController@goCheckout')->name('stripe');
Route::post('/stripe', 'checkoutController@stripePost')->name('stripe.post');

//Connect
Route::get('/connect/{id}', 'checkoutController@connect')->name('connect.stripe');
Route::get('/saveStripe/{token}', 'checkoutController@saveStripe')->name('return.stripe');

Route::get('acc_balance', 'checkoutController@acc_balance')->name('acc_balance');
Route::get('con_acc_balance', 'checkoutController@con_acc_balance')->name('con_acc_balance');
Route::get('make_payment', 'checkoutController@make_payment')->name('make_payment');
Route::get('split', 'checkoutController@split')->name('split');
Route::get('retrive', 'checkoutController@retrive')->name('retrive');
Route::get('refund', 'checkoutController@refund')->name('refund');
	
Route::get('clear_cache', function () {
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    dd("Cache is cleared");
});

