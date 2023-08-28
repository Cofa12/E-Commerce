<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\UserController;





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
// Authentication page
Route::get('/signin',[AuthController::class,'getThePage'])->name('login.page')->middleware('Alreadyin');
Route::get('/signup',[AuthController::class,'getTheSignUp'])->name('signup.page')->middleware('Alreadyin');
Route::post('/signup-member',[AuthController::class,'signingup'])->name('member.signup');
Route::get('/home-admin',[AuthController::class,'homepage'])->middleware('isLogined')->middleware('Isuser');
Route::post('signin-member',[AuthController::class,'loginprocess'])->name('login.validate');
Route::get('/home-admin',[AuthController::class,'gobacktohome'])->name('returntohome.back')->middleware('isLogined')->middleware('Isuser');

/*Routes of the home admin page*/
Route::get('edit-photo',[AdminPageController::class,'forward_to'])->name('editback.forward')->middleware('isLogined')->middleware('Isuser');
Route::post('/home-admin',[AdminPageController::class,'applyimageedit'])->name('applyimage.edit');
Route::get('/home-admin',[AdminPageController::class,'gobackfromedit'])->name('returnhomeedit.back')->middleware('isLogined')->middleware('Isuser');
// profile page
Route::get('/admin-profile',[AdminPageController::class,'adminprofile'])->name('adminprofile')->middleware('isLogined');
Route::get('/Reciept{id}',[AdminPageController::class,'addreceipt'])->name('addreceipt')->middleware('isLogined');

// add product
Route::get('/add-product',[AdminPageController::class,'addproduct'])->name('addproduct.admin')->middleware('isLogined')->middleware('Isuser');
Route::post('/add-product',[AdminPageController::class,'saveproductValidate'])->name('saveproduct.admin');

// delete product
Route::delete('/delte-product/{id}',[AdminPageController::class,'deleteproduct'])->name('deleteproduct.home');

//edit product
Route::get('/edit-product/{id}',[AdminPageController::class,'geteditproduct'])->name('geteditProduct.home')->middleware('isLogined')->middleware('Isuser');
Route::post('/edit-product/{id}',[AdminPageController::class,'applyedit'])->name('applyeditproduct');


/*Routes of User home page */
Route::get('/home',[UserController::class,'gobacktohome'])->name('returnhomeuser.back')->middleware('isLogined')->middleware('Isuser');

//search route
Route::post('/search',[UserController::class,'searchto'])->name('searchproduct.get');

// add love
Route::get('/home-love/{id}',[UserController::class,'addlovefun'])->name('addlove');

// add to cart
Route::get('/home/{id}',[UserController::class,'addtocart'])->name('addto.cart');
Route::get('/your-cart',[UserController::class,'gotocart'])->name('gotocart.user')->middleware('isLogined')->middleware('Isuser');
Route::delete('/delete-cart/{id}',[UserController::class,'deleteproductcart'])->name('removeproduct.cart');

// remove all cart products
Route::delete('/delete-cart-all',[UserController::class,'removeallcart'])->name('removeall.cart');

// save cart checkout
Route::post('/checkout/{total}',[UserController::class,'checkoutfun'])->name('checkout.cart');
Route::get('/delivey',[UserController::class,'delivery'])->name('delivery.cart')->middleware('isLogined')->middleware('Isuser');

// user profile
Route::get('/profile',[UserController::class,'userprofile'])->name('userprofile')->middleware('isLogined')->middleware('Isuser');
Route::put('/profile-data',[UserController::class,'updateuserinfo'])->name('updateuser.info');
Route::put('/profile',[UserController::class,'resetpassword'])->name('resetpassword.user');

//log out
Route::get('/log-out',[AuthController::class,'logout'])->name('logout.profile');





Route::get('/', function () {
    return view('welcome');
});
