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

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace'  => 'Admin',
], function () {
    // CRUD resources and other admin routes
    CRUD::resource('feedback', 'FeedbackCrudController');
    CRUD::resource('photo', 'PhotoCrudController');
    CRUD::resource('album', 'AlbumCrudController');
    CRUD::resource('testimony', 'TestimonyCrudController');
    CRUD::resource('sermoncategory', 'SermonCategoryCrudController');
    CRUD::resource('sermon', 'SermonCrudController');
    CRUD::resource('slide', 'SlideCrudController');
    CRUD::resource('member', 'MemberCrudController');
    CRUD::resource('newsletter', 'NewsletterCrudController');
    CRUD::resource('leader', 'LeaderCrudController');
    CRUD::resource('department', 'DepartmentCrudController');
});


Route::get('events', ['uses' => '\SeanDowney\BackpackEventsCrud\app\Http\Controllers\EventController@index']);
Route::get('events/{event}/{subs?}', ['as' => 'view-event', 'uses' => '\SeanDowney\BackpackEventsCrud\app\Http\Controllers\EventController@view'])
    ->where(['event' => '^((?!admin).)*$', 'subs' => '.*']);

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
    ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);
