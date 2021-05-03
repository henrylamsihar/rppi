<?php

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
    return view('auth.login');
});
Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();

// Route::get('/dashboard', 'AdminController@index');
// Route::get('/dashboard', 'AdminController@dashboard');
// Route::get('/product', 'AdminController@product');
// Route::get('/pesanan', 'AdminController@pesanan');
// Route::get('/tokorekanan', 'AdminController@tokorekanan');
Route::get('/laporan', 'AdminController@laporan');
Route::get('/laporan2', 'AdminController@laporan2');
Route::get('/mastertest', 'AdminController@mastertest');

Route::resource('product', 'ProductController');
Route::get('/api.test','OrderController@apitest')->name('api.test');

Route::get('api.product','ProductController@apiProduct')->name('api.product');
Route::get('/cetakrekapbarang','OrderController@cetakrekapbarang')->name('cetakrekapbarang');
Route::get('api.order/{id}','OrderController@apiOrder')->name('api.order');

Route::get('/pesanan/{id}/orderdetail','OrderController@editorderdetail')->name('pesanan.editorderdetail');
Route::get('/pesanan/{id}/send','OrderController@sendpesanan')->name('pesanan.send');
Route::get('/pesanan/{id}/accpayment','OrderController@accpayment')->name('pesanan.accpayment');
Route::get('/pesanan/{id}/acc','OrderController@accpesanan')->name('pesanan.acc');
Route::get('/pesanan/{id}/dec','OrderController@decpesanan')->name('pesanan.dec');
Route::get('/dashboard','OrderController@index2');
// Route::post('/daterange/fetch_data', 'DateRangeController@fetch_data')->name('daterange.fetch_data');
Route::post('/laporan2/fetchlaporan2', 'OrderController@fetch_data2')->name('daterange.fetch_data2');
Route::post('/laporan/fetchlaporan', 'OrderController@fetch_data')->name('daterange.fetch_data');
Route::resource('pesanan', 'OrderController');
Route::get('tokokategori/{id}/editcategory','TokoCategoryController@editcategory')->name('tokokategori.editcategory');
Route::delete('tokokategori/{id}','TokoCategoryController@destroycategory')->name('tokokategori.destroycategory');
Route::delete('tokokategori/deletetoko/{id}','TokoCategoryController@destroytoko')->name('tokokategori.destroytoko');
Route::get('tokokategori/createcategory','TokoCategoryController@create2')->name('tokokategori.create2');

Route::resource('tokokategori', 'TokoCategoryController');
Route::resource('user', 'UserController');

// Route::resource('article', 'ArticleController');
