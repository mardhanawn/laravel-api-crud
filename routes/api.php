<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api){
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('/me', function(){
            $data = [
                "name" => "Indra Hehe Aja",
                "nickname" => "goeroeku",
                "gender" => "Male",
                "class" => "Pro Akut",
            ];
            return ['status' => 200, 'data' =>  $data];
        });
        // $api->get('/me', function(){
        //     $data = [
        //         "name" => "Raihan Athaya Fawwaz",
        //         "nickname" => "xxscreamo",
        //         "gender" => "Male",
        //         "class" => "hehe",
        //     ];
        //     return ['status' => 200, 'data' =>  $data];
        // });
        $api->delete('/logout' , 'App\Http\Controllers\AuthController@logout');
        $api->post('/article' , 'App\Http\Controllers\materialController@store');
        $api->get('/article/{id}' , 'App\Http\Controllers\materialController@show');
        $api->post('/article/{id}' , 'App\Http\Controllers\materialController@update');
        $api->delete('/article/{id}' , 'App\Http\Controllers\materialController@destroy');
    });
    $api->post('/login' , 'App\Http\Controllers\AuthController@login');
    $api->post('/register' , 'App\Http\Controllers\AuthController@register');
    $api->post('/login' , 'App\Http\Controllers\userController@login');
    $api->post('/register' , 'App\Http\Controllers\userController@register');
});