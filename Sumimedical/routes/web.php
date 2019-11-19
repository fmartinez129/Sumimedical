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
    return view('welcome');
});

Route::get('/mylogg', function () {
    return view('mylogg');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/companies', function () {
    return view('companyV');
});

Route::get('/companies/getAll', 'CompanyController@index');

Route::put('/companies/update', 'CompanyController@update');

Route::post('/companies/save', 'CompanyController@store');

Route::delete('/companies/delete/{id}', 'CompanyController@destroy');

Route::get('/companies/search', 'CompanyController@show');

Route::get('/companies/showCompaniesAll', 'CompanyController@showCompaniesAll');

Route::get('/companiesList', function () {
    return view('seeCompanies');
});
