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

Route::get('/', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function() {
    Route::get('/users', 'Dashboard\UsersController@index')->name('users_list');
    Route::get('/users/edit/{id}', 'Dashboard\UsersController@editForm')->name('user_edit');
    Route::post('/users/save', 'Dashboard\UsersController@save')->name('user_save');
    Route::get('/users/remove/{id}', 'Dashboard\UsersController@remove')->name('user_remove');
    Route::get('/users/new', 'Dashboard\UsersController@newForm')->name('user_new');

    Route::get('/cities', 'Dashboard\CitiesController@index')->name('cities_list');
    Route::get('/cities/new', 'Dashboard\CitiesController@newForm')->name('city_new');
    Route::post('/cities/save', 'Dashboard\CitiesController@save')->name('city_save');
    Route::get('/cities/edit/{id}', 'Dashboard\CitiesController@editForm')->name('city_edit');
    Route::get('/cities/remove/{id}', 'Dashboard\CitiesController@remove')->name('city_remove');

    Route::get('/districts', 'Dashboard\DistrictsController@index')->name('districts_list');
    Route::get('/districts/new', 'Dashboard\DistrictsController@newForm')->name('district_new');
    Route::get('/districts/edit/{id}', 'Dashboard\DistrictsController@editForm')->name('district_edit');
    Route::post('/districts/save', 'Dashboard\DistrictsController@save')->name('district_save');
    Route::get('/districts/remove/{id}', 'Dashboard\DistrictsController@remove')->name('district_remove');

    Route::get('/institution-types', 'Dashboard\InstitutionTypesController@index')->name('institution_types_list');
    Route::get('/institution-types/new', 'Dashboard\InstitutionTypesController@newForm')->name('institution_types_new');
    Route::post('/institution-types/save', 'Dashboard\InstitutionTypesController@save')->name('institution_types_save');
    Route::get('/institution-types/edit/{id}', 'Dashboard\InstitutionTypesController@editForm')->name('institution_types_edit');
    Route::get('/institution-types/remove/{id}', 'Dashboard\InstitutionTypesController@remove')->name('institution_types_remove');

    Route::get('/images', 'Dashboard\ImagesController@index')->name('images_list');
    Route::get('/images/new', 'Dashboard\ImagesController@newForm')->name('image_new');
    Route::post('/images/save', 'Dashboard\ImagesController@save')->name('image_save');
    Route::get('/images/remove/{id}', 'Dashboard\ImagesController@removeIfNotUsed')->name('image_remove');

    Route::get('/institutions', 'Dashboard\InstitutionsController@index')->name('institutions_list');
    Route::get('/institutions/new', 'Dashboard\InstitutionsController@newForm')->name('institution_new');
    Route::post('/institutions/save', 'Dashboard\InstitutionsController@save')->name('institution_save');
    Route::get('/institutions/edit/{id}', 'Dashboard\InstitutionsController@editForm')->name('institution_edit');
    Route::get('/institutions/remove/{id}', 'Dashboard\InstitutionsController@remove')->name('institution_remove');

    Route::get('/editors', 'Dashboard\EditorsController@index')->name('editors_list');
    Route::get('/editors/new', 'Dashboard\EditorsController@newForm')->name('editor_new');
    Route::post('/editors/save', 'Dashboard\EditorsController@save')->name('editor_save');
    Route::get('/editors/edit/{id}', 'Dashboard\EditorsController@editForm')->name('editor_edit');
    Route::get('/editors/remove/{id}', 'Dashboard\EditorsController@remove')->name('editor_remove');

    Route::get('/exhibitions', 'Dashboard\ExhibitionsController@index')->name('exhibitions_list');
    Route::get('/exhibitions/new', 'Dashboard\ExhibitionsController@newForm')->name('exhibition_new');
    Route::post('/exhibitions/save', 'Dashboard\ExhibitionsController@save')->name('exhibition_save');
    Route::get('/exhibitions/edit/{id}', 'Dashboard\ExhibitionsController@editForm')->name('exhibition_edit');
    Route::get('/exhibitions/remove/{id}', 'Dashboard\ExhibitionsController@remove')->name('exhibition_remove');
});

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});
