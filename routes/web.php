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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/msg', 'HomeController@sendMsg');

Route::get('/blog', 'ArticleController@index');
Route::get('/tags/{tag}', 'ArticleController@index');
Route::get('/blog/{title}', 'ArticleController@show');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/blog/{title}/comment', 'ArticleController@comment');
    Route::post('/blog/{title}/reply', 'ArticleController@reply');
    Route::get('/article/create', 'ArticleController@create');
    Route::post('/articles', 'ArticleController@store');
    Route::get('/admin-management', 'AdminController@index');
    Route::get('/delete/user/{id}', 'AdminController@userdel');
    Route::get('/delete/article/{id}', 'AdminController@postdel');
    Route::get('/account/{id}', 'AccountController@index');
    Route::get('/delete-account/{id}', 'AccountController@userdel');
});

Route::get('/privacy', function(){
    return view ('privacy');
});
Route::get('/terms-of-service', function(){
    return view ('terms');
});
Route::get('/about-us', function(){
    return  view ('about');
});

Route::get('/login', 'SessionController@show')->name('login');
Route::post('/login', 'SessionController@create');

Route::get('/logout', 'SessionController@destroy');

Route::get('/register', 'RegistrationController@show');
Route::post('/register', 'RegistrationController@create');

Route::get('/verify/{code}', 'SessionController@verify');

Route::get('/forgot', function(){
    return view('auth.forgot');
});
Route::post('/forgot', 'RecoveryController@mailUser');
Route::get('/reset/{code}', 'RecoveryController@index');
Route::post('/reset', 'RecoveryController@reset');

Route::get('auth/callback/{social}', 'SocialAuthController@callback');
Route::get('auth/redirect/{social}', 'SocialAuthController@redirect');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/weight-loss-gain-tracker', 'ToolsController@bmr');
Route::post('/weight-loss-gain-tracker', 'ToolsController@bmresults');
Route::post('/weight-loss', 'ToolsController@track');
Route::get('/online-food-diary', 'ToolsController@diary');
Route::get('/diet-meal-planner', 'ToolsController@planner');
Route::get('/food-calorie-counter', 'ToolsController@counter');

Route::get('/shop', 'ShoppingController@index');
Route::get('/cart', 'ShoppingController@cart');
Route::post('/iframe', 'ShoppingController@iframe');
Route::get('/status', 'ShoppingController@status');
