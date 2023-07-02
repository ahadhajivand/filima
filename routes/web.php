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
    return view('home.index');
})->name('home');


Route::post('logout' , [\App\Http\Controllers\Auth\LogoutController::class , 'logout'])->name('logout');
Route::prefix('auth')->middleware('guest')->group(function (){
Route::get('login' , [\App\Http\Controllers\Auth\LoginController::class , 'showLogin'])->name('auth.login');
Route::post('login' , [\App\Http\Controllers\Auth\LoginController::class , 'login']);
Route::get('register' , [\App\Http\Controllers\Auth\RegisterController::class , 'showRegister'])->name('auth.register');
Route::post('register' ,[\App\Http\Controllers\Auth\RegisterController::class , 'register']);
    Route::get('token' , [\App\Http\Controllers\Auth\TokenController::class , 'showToken'])->name('auth.token');
    Route::post('token' ,[\App\Http\Controllers\Auth\TokenController::class , 'token']);
});


///////////////// All-Route For Films //
Route::get('/films',[\App\Http\Controllers\HomeController::class , 'films'])->name('films');
Route::get('/film/{title}' , [\App\Http\Controllers\HomeController::class , 'single_film'])->name('single_film');
Route::post('film/{title}/comment',[\App\Http\Controllers\HomeController::class , 'comment'])->name('film-comment');
Route::post('/interests/video' , [\App\Http\Controllers\InterestController::class , 'index_video'])->name('interest-film');
Route::get('genre/films/{genre}' , [\App\Http\Controllers\HomeController::class , 'searchGenreFilm']);
Route::get('year/films/{year}' , [\App\Http\Controllers\HomeController::class , 'searchYearFilm']);

////////////////// end All Films //


///////////////// All-Route For Serials //
Route::get('/serials',[\App\Http\Controllers\HomeController::class , 'serials'])->name('serials');
Route::get('/serial/{title}' , [\App\Http\Controllers\HomeController::class , 'single_serial'])->name('single_serial');
Route::post('/interests/serial' , [\App\Http\Controllers\InterestController::class , 'index_serial'])->name('interest-serial');
Route::get('genre/serials/{genre}' , [\App\Http\Controllers\HomeController::class , 'searchGenreSerial']);
Route::get('year/serials/{year}' , [\App\Http\Controllers\HomeController::class , 'searchYearSerial']);
////////////////// end All Serials //


////////////////// details any Route For Website //
Route::get('category/{slug?}' , [\App\Http\Controllers\HomeController::class , 'categoryList'])->name('CategoryList');
Route::get('categories/{slug?}' , [\App\Http\Controllers\HomeController::class , 'singleCategory'])->name('category-single');
Route::get('plans/{plan}' , [\App\Http\Controllers\HomeController::class , 'single_plan'])->name('single-plan');
Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
///////////////// end Details Website //


/////////////////  Routing For Profile //
Route::middleware('auth')->group(function () {
    Route::get('/profile',[\App\Http\Controllers\Profile\ProfileController::class , 'index'])->name('profile');
    Route::patch('/profile', [\App\Http\Controllers\Profile\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/vip/{month}' , [\App\Http\Controllers\Profile\VipUserController::class , 'vip'])->name('profile.vip');
});
///////////////  end Routing Profile //


//////////////// Routing For Service Cart //
Route::post('cart/add/{plan}' , [\App\Http\Controllers\Cart\CartController::class , 'AddToCart'])->name('AddToCart');
Route::get('cart' , [\App\Http\Controllers\Cart\CartController::class , 'cart'])->name('cart');
Route::delete('cart/delete/{plan}' , [\App\Http\Controllers\Cart\CartController::class , 'delete'])->name('delete');
Route::middleware('auth')->group(function (){
    Route::post('cart/payment' , [\App\Http\Controllers\Cart\PaymentController::class , 'payment'])->name('cart-payment');
    Route::post('cart/payment/callback' , [\App\Http\Controllers\Cart\PaymentController::class , 'Payment_Callback'])->name('Payment_Callback');
});
/////////////// end Routing Service Cart //





