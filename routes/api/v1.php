<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api\V1'
], function ($api) {
    // create token
    $api->post('auth', [
        'as' => 'authorizations.store',
        'uses' => 'AuthController@store',
    ]);

    // login
    $api->post('login', [
        'as' => 'authorizations.login',
        'uses' => 'AuthController@login',
    ]);

    // register
    $api->post('register', [
        'as' => 'authorizations.register',
        'uses' => 'AuthController@register',
    ]);

    // refresh jwt token
    $api->put('authorizations/current', [
        'as' => 'authorizations.update',
        'uses' => 'AuthController@update',
    ]);

    // need authentication
    $api->group(['middleware' => 'api.auth'], function ($api) {
        // logout
        $api->delete('logout', [
            'as' => 'authorizations.logout',
            'uses' => 'AuthController@destroy',
        ]);
        $api->delete('authorizations/current', [
            'as' => 'authorizations.logout',
            'uses' => 'AuthController@destroy',
        ]);

        // userShow
        $api->get('user', [
            'as' => 'user.show',
            'uses' => 'UserController@userShow',
        ]);

        // update profile
        $api->put('user/profile', [
            'as' => 'user.profile.update',
            'uses' => 'UserController@updateProfile',
        ]);

        // update my password
        $api->put('user/password', [
            'as' => 'user.password.update',
            'uses' => 'UserController@updatePassword',
        ]);

        // USER
        // user list
        $api->get('users', [
            'as' => 'users.index',
            'uses' => 'UserController@index',
        ]);
        // User add
        $api->post('users', [
            'as' => 'users.store',
            'uses' => 'UserController@store',
        ]);
        // user detail
        $api->get('users/{id}', [
            'as' => 'users.show',
            'uses' => 'UserController@show',
        ]);
        // user update
        $api->put('users/{id}', [
            'as' => 'users.update',
            'uses' => 'UserController@update',
        ]);
        // user delete
        $api->delete('users/{id}', [
            'as' => 'users.destroy',
            'uses' => 'UserController@destroy',
        ]);

        // POST
        // post list
        $api->get('posts', [
            'as' => 'posts.index',
            'uses' => 'PostController@index',
        ]);
        // post detail
        $api->get('posts/{id}', [
            'as' => 'posts.show',
            'uses' => 'PostController@show',
        ]);
        // user's posts index
        $api->get('user/posts', [
            'as' => 'user.posts.index',
            'uses' => 'PostController@userIndex',
        ]);
        // create a post
        $api->post('posts', [
            'as' => 'posts.store',
            'uses' => 'PostController@store',
        ]);
        // update a post
        $api->put('posts/{id}', [
            'as' => 'posts.update',
            'uses' => 'PostController@update',
        ]);
        // update part of a post
        $api->patch('posts/{id}', [
            'as' => 'posts.patch',
            'uses' => 'PostController@patch',
        ]);
        // delete a post
        $api->delete('posts/{id}', [
            'as' => 'posts.destroy',
            'uses' => 'PostController@destroy',
        ]);
    });
});