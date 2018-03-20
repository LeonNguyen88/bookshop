<?php

use App\Category;
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
    Route::get('/', function(){
        return view('admin.index');
    })->name('admin');
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
});
Route::get('/aa', function(Request $request){
    /*$content = Cart::content();
    print_r($content);*/
    echo "buon cua anh";

});
Route::get('/product/{id}', 'ProductController@index')->name('product');
Route::get('/cart/{id}', 'CartController@add')->name('addtocart');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/delete/{id}', 'CartController@delete')->name('deletecart');
Route::get('/cart/decrease/{id}', 'CartController@decrease')->name('decreaseqty');


