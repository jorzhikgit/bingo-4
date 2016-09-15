<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
use Carbon\Carbon;

Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

Route::get('login', [
    'as' => 'user.login',
    'before' => 'guest',
    'uses' => 'LoginController@getLogin'
]);

Route::get('image/{thumbnail?}/{filename?}', [
    'as'    => 'image.get',
    'uses'  => 'ImageController@getImage'
]);

 
// Cross-site request Forgery
Route::group(['before' => 'csrf'], function () {
    Route::post('login', 'LoginController@postLogin');
});


// Authenticated get
Route::group(['before' => 'auth'], function () {
    // GET

    // Change Password
    Route::get('change_password', ['as' => 'change.password', function () {
        return View::make('change_password');
    }]);

    Route::post('change_password', [
        'as'    => 'change.get',
        'uses'  => 'ChangePasswordController@postChange'
    ]);

    Route::get('/', [
        'as'    => 'queue.home',
        'uses'  => 'HomeController@index'
    ]);

    // Logout
    Route::get('logout', [
        'as'    => 'user.logout',
        'uses'  => 'LoginController@getLogout'
    ]);

    // User Profile
    Route::get('user/profile', [
        'as'    => 'user.profile',
        'uses'  => 'UserController@profile'
    ]);

    // Image
    Route::get('image_link/{table}/{id}/{thumbnail?}', [
        'as'   => 'image_link.index',
        'uses' => 'ImageLinkController@images'
    ]);

    // POST, PUT/PATCH, DELETE

    Route::resource('user', 'UserController', ['only' => ['index', 'store', 'update', 'destroy']]);

    Route::get('cards', 'SedpMis\Bingo\Modules\Cards\CardsController@index');

    Route::get('plays', 'SedpMis\Bingo\Modules\Plays\PlaysController@index');
    Route::get('plays/{play}', 'SedpMis\Bingo\Modules\Plays\PlaysController@show');
    Route::post('plays/{play}/pick_a_number', 'SedpMis\Bingo\Modules\Plays\PlaysController@pickANumber');

    Route::delete('plays', 'SedpMis\Bingo\Modules\Plays\PlaysController@resetPlays');

    Route::get('patterns/{pattern}', 'SedpMis\Bingo\Modules\Patterns\PatternsController@show');
    Route::get('patterns/{pattern}/compare/{card}', 'SedpMis\Bingo\Modules\Patterns\PatternsController@compare');

    Route::get('plays/{play}/winner_count', 'SedpMis\Bingo\Modules\Plays\PlaysController@winnerCount');

}); // End of Authenticated get
