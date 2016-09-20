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

    Route::get('plays/{play}/winners', 'SedpMis\Bingo\Modules\Plays\PlaysController@winners');

    Route::get('parishes', 'SedpMis\Bingo\Modules\Parishes\ParishesController@index');
    Route::get('parishes/active', 'SedpMis\Bingo\Modules\Parishes\ParishesController@active');
    Route::put('parishes/{parish}', 'SedpMis\Bingo\Modules\Parishes\ParishesController@update');

}); // End of Authenticated get


Route::get('make_parishes', function () {
    $filepath = base_path('parishes.csv');

    $parishes = [];
    
    $branch = '';
    $parish = [];

    if (($handle = fopen($filepath, "r")) !== false) {
        while (($data = fgetcsv($handle, /*100*/0, ",")) !== false) {
            // var_dump($data);
            // echo "\n\n";

            if (strlen($data[0]) > 0) {
                $branch = $data[0];
            } 

            if (strlen($data[1]) > 0) {
                if ($parish) {
                    $parishes[] = $parish;
                }

                $parish = [
                    'name'               => $data[1],
                    'branch'             => $branch,
                    'date'               => carbon($data[2])->format('Y-m-d'),
                    'no_of_members'      => $data[3],
                    'additional_members' => $data[4],
                ];
            }

            if (
                strlen($data[0]) == 0 && 
                strlen($data[1]) == 0 && 
                strlen($data[2]) == 0 && 
                strlen($data[4]) == 0 && 
                strlen($data[3]) > 0
            ) {
                $parish['no_of_members'] .= ' + ' .$data[3];
            }
        }

        $parishes[] = $parish;

        fclose($handle);
    }

    return $parishes;
});