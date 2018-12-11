<?php


Route::get('/', 'FrontEndController@actionHome');
Route::get('/shop', 'FrontEndController@actionShop');
Route::get('/product-details/{slug}', 'FrontEndController@actionProductDetails');
Route::get('/blog', 'FrontEndController@actionBlogs');
Route::get('/blog-details/{slug}', 'FrontEndController@actionBlogDeatils');
Route::post('/cart/add', 'FrontEndController@addProductTocart');
Route::get('/cart', 'FrontEndController@actionCart');
Route::get('/cart/remove/{id}', 'FrontEndController@actionCartRemove');

Route::get('/login', 'CustomerController@showLoginForm')->middleware('CustomerLoggedIn');
Route::post('/login', 'CustomerController@actionLogin');
Route::get('/register', 'CustomerController@showRegisterForm')->middleware('CustomerLoggedIn');
Route::post('/register', 'CustomerController@actionRegister');

Route::get('/my-account', 'CustomerController@actionMyAccount')->middleware('CustomerNotLoggedIn');
Route::get('/checkout', 'FrontEndController@actionCheckout')->middleware('CartEmptyAndCustomerNotLoggedIn');
Route::post('/checkout-final', 'FrontEndController@actionCheckoutFinal')->middleware('CartEmptyAndCustomerNotLoggedIn');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

