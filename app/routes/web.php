<?php

use App\Http\Controllers\Controller;
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

Route::get('/', [Controller::class, 'index'])->name('/index');

Route::get('/admin-dashboard', [Controller::class, 'dashboard'])->middleware('auth');

Route::post('/authenticate', [Controller::class, 'login']);

Route::get('/my-profile/{user}', [Controller::class, 'my_profile'])->middleware('auth');

Route::put('/users/upadateProfilePic/{user}', [Controller::class, 'profile_picture'])->middleware('auth');

Route::put('/users/upadateAll/{user}', [Controller::class, 'upadate_profile_data'])->middleware('auth');

Route::post('/users', [Controller::class, 'store_users'])->middleware('auth');

Route::post('/logout', [Controller::class, 'user_logout'])->middleware('auth');

Route::post('/messages', [Controller::class, 'store_messages']);

Route::get('/register-customer', [Controller::class, 'create_customer'])->middleware('auth');

Route::post('/customers', [Controller::class, 'store_customers'])->middleware('auth');

Route::get('/view-customers', [Controller::class, 'get_customers'])->middleware('auth');

Route::get('/customer-account/{customer}', [Controller::class, 'show_single_account'])->middleware('auth');

Route::put('/customers/editcustomer/{customer}', [Controller::class, 'edit_account'])->middleware('auth');

Route::delete('/customer/delete/{customer}', [Controller::class, 'delete_account'])->middleware('auth');

Route::get('/transaction-processing', [Controller::class, 'payment_processing'])->middleware('auth');

Route::get('/payments/{customer}', [Controller::class, 'payments'])->middleware('auth');

Route::delete('/messages/delete/{message}', [Controller::class, 'delete_message'])->middleware('auth');

Route::get('/post-news-updates', [Controller::class, 'news_updates'])->middleware('auth');

Route::post('/news', [Controller::class, 'store_news'])->middleware('auth');

Route::delete('/news/delete/{updates}', [Controller::class, 'update_news'])->middleware('auth');

Route::post('/transactions', [Controller::class, 'process_payments']);

Route::get('/success', [Controller::class, 'success']);

Route::get('/cancel', [Controller::class, 'cancel']);

Route::get('/view-payments', [Controller::class, 'view_payments'])->middleware('auth');

Route::delete('/transactions/delete_detail/{transaction}', [Controller::class, 'outdated_transaction'])->middleware('auth');

Route::get('/view-notifications', [Controller::class, 'all_nitications'])->middleware('auth');


//CUSTOMER SETUPS

Route::get('/casts/cast-dashboard', [Controller::class, 'customer_dashboard']);

Route::get('/casts/payments', [Controller::class, 'customer_pay']);

Route::get('/casts/my-payment-history', [Controller::class, 'payment_history']);

Route::get('/casts/send-notifications', [Controller::class, 'notifications']);

Route::post('/notifications', [Controller::class, 'store_notifications']);

Route::get('/casts/my-suggestions', [Controller::class, 'my_suggestions']);


//Route::post('/payments', [Controller::class, 'mobileCheckout']);


Route::post('/payments', [Controller::class, 'mobileCheckout']);

// Route for getting payment partners
Route::get('/payment/partners', [Controller::class, 'getPaymentPartners']);

// Route for post checkout
Route::post('/post/checkout', [Controller::class, 'postCheckout']);

// Route for creating transfer
Route::post('/create/transfer', [Controller::class, 'createTransfer']);

// Route for handling payment callbacks
Route::post('/payment/callback', [Controller::class, 'handleCallback']);

Route::get('/success', [Controller::class, 'success']);

Route::get('/failure', [Controller::class, 'failure']);

Route::get('/casts/my-profile/{customer}', [Controller::class, 'show_profile']);

Route::put('/customers/editpict/{customer}', [Controller::class, 'update_profile_pic']);

Route::put('/customers/editdata/{customer}', [Controller::class, 'update_customer_data']);

Route::get('/generate-report', [Controller::class, 'payment_report']);