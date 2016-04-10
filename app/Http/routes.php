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

$app->get('/', function () use ($app) {
    return $app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
	// Get token
	$api->post('login', [
		'as' => 'login',
		'uses' => 'App\Http\Controllers\V1\LoginController@index'
	]);

	// All requests must be authorized
	$api->group(['middleware' => 'api.auth', 'providers' => ['jwt']], function($api) {

		// User resources
		resource('/users', 'UserController', $api);

		// ClientGroup resources
		resource('/cgroups', 'ClientGroupController', $api);
		$api->get('/cgroups/{$group_id}/users', 'App\Http\Controllers\V1\ClientGroupController@getUsersOfGroup');
	});
});

/**
 * Helper for generate resource routes
 * @param  string $uri
 * @param  string $controller
 * @return void
 */
function resource($uri, $controller, \Dingo\Api\Routing\Router $api)
{
	$api->get($uri, 'App\\Http\\Controllers\\V1\\'. $controller.'@index');
	$api->get($uri.'/create', 'App\\Http\\Controllers\\V1\\'. $controller.'@create');
	$api->post($uri, 'App\\Http\\Controllers\\V1\\'. $controller.'@store');
	$api->get($uri.'/{id}', 'App\\Http\\Controllers\\V1\\'. $controller.'@show');
	$api->get($uri.'/{id}/edit', 'App\\Http\\Controllers\\V1\\'. $controller.'@edit');
	$api->put($uri.'/{id}', 'App\\Http\\Controllers\\V1\\'. $controller.'@update');
	$api->patch($uri.'/{id}', 'App\\Http\\Controllers\\V1\\'. $controller.'@update');
	$api->delete($uri.'/{id}', 'App\\Http\\Controllers\\V1\\'. $controller.'@destroy');
}
