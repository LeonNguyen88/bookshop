<?php

use App\Category;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Product_detail;
use App\Role;
use App\Users;
use App\Post;
use App\Country;
use App\Photo;
use App\Tag;
use App\Video;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', )->name('home');

Route::get('/test', function(){
    return view('layouts.front-end1');
});
Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function(){
    Route::get('/', 'AdminDashboardController@index')->name('admin');
    Route::resource('/user', 'AdminUserController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'destroy' => 'admin.users.destroy'
    ]]);
    Route::get('/user/promote/{id}', 'AdminUserController@promote')->name('admin.users.promote');
    Route::get('/user/demote/{id}', 'AdminUserController@demote')->name('admin.users.demote');
    Route::resource('/category', 'AdminCategoryController', ['names' => [
        'index' => 'admin.category.index',
        'create' => 'admin.category.create',
        'store' => 'admin.category.store',
        'edit' => 'admin.category.edit',
        'destroy' => 'admin.category.destroy'
    ]]);
    Route::resource('/product', 'AdminProductController', ['names' => [
        'index' => 'admin.product.index',
        'create' => 'admin.product.create',
        'store' => 'admin.product.store',
        'edit' => 'admin.product.edit',
        'destroy' => 'admin.product.destroy'
    ]]);
    Route::resource('/order', 'AdminOrderController', ['names' => [
        'index' => 'admin.order.index',
        'create' => 'admin.order.create',
        'store' => 'admin.order.store',
        'edit' => 'admin.order.edit',
        'destroy' => 'admin.order.destroy'
    ]]);
    Route::get('/order/detail/{id}', 'AdminOrderController@detail')->name('admin.order.detail');
    Route::get('/slider', 'AdminSliderController@index')->name('admin.slider');
    Route::get('/slider/create/{id}', 'AdminSliderController@create')->name('admin.slider.create');
    Route::post('/slider', 'AdminSliderController@store')->name('admin.slider.store');
    Route::get('/slider/edit/{id}', 'AdminSliderController@edit')->name('admin.slider.edit');
    Route::get('/comment', 'AdminCommentController@index')->name('admin.comment.index');
    Route::delete('/commment/{id}', 'AdminCommentController@destroy')->name('admin.comment.delete');
});
Route::get('/aa', function(Request $request){
    dd(Auth::user()->id);
});
Route::get('/product/{id}', 'ProductController@index')->name('product');
Route::post('/cart/{id}', 'CartController@add')->name('addtocart');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/delete/{id}', 'CartController@delete')->name('deletecart');
Route::post('/cart/decrease/{id}', 'CartController@decrease')->name('decreaseqty');
Route::get('/transaction', 'TransactionController@index')->name('showtransaction');
Route::post('/transaction', 'TransactionController@store');
Route::get('/thank-you', function(){
    return view('cart.thank-you');
})->name('thank-you');
Route::get('/account', 'UserController@account')->name('account');
Route::patch('/updateaccount/{id}', 'UserController@updateaccount')->name('updateaccount');
Route::get('/order/history', 'UserController@orderhistory')->name('orderhistory');
Route::get('/order/history/{id}', 'UserController@orderdetail')->name('orderdetail');
Route::delete('/order/history/{id}', 'UserController@removeorder')->name('removeorder');
Route::get('/category/{id}', 'CategoryController@index')->name('category');
Route::get('/search', 'SearchController@index')->name('search');
Route::post('/product/review/{id}', 'ReviewController@store')->name('storereview');
Route::post('/product/comment/{id}', 'CommentController@store')->name('storecomment');

