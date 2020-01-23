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

// Welcome
Route::get('/', 'WelcomeController@index');

Auth::routes();

// Shopping Lists
Route::get('/shopping-lists/{id}/email', 'ShoppingListController@email')->name('shopping-lists.email');
// Route::get('/shopping-lists/{id}/delete', 'ShoppingListController@destroy')->name('shopping-lists.delete');
Route::resource('shopping-lists', 'ShoppingListController');

// Products
Route::resource('products', 'ProductController');

// Categories
Route::get('/categories/sort', 'CategoryController@sort');
Route::resource('categories', 'CategoryController');

// Shopping Lists Products
Route::resource('shopping-lists-products', 'ShoppingList\ProductController');
Route::get('shopping-lists-products/{id}/essentials', 'ShoppingList\ProductController@updateEssentials')->name('essentials.update');