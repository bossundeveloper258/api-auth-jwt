<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
});


Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('cities', [App\Http\Controllers\CityController::class , 'index']);
    Route::get('city/{id}', [App\Http\Controllers\CityController::class , 'show']);

    Route::get('condominia', [App\Http\Controllers\CondominiumController::class , 'index']);
    Route::get('condominia/{id}', [App\Http\Controllers\CondominiumController::class , 'show']);

    Route::get('typeProperties', [App\Http\Controllers\TypePropertyController::class , 'index']);
    Route::get('typeProperty/{id}', [App\Http\Controllers\TypePropertyController::class , 'show']);

    Route::get('people', [App\Http\Controllers\PersonController::class , 'index']);
    Route::get('person/{id}', [App\Http\Controllers\PersonController::class , 'show']);

    Route::get('departments', [App\Http\Controllers\DepartmentController::class , 'index']);
    Route::get('department/{id}', [App\Http\Controllers\DepartmentController::class , 'show']);

    Route::get('typePersons', [App\Http\Controllers\TypePersonController::class , 'index']);
    Route::get('typePerson/{id}', [App\Http\Controllers\TypePersonController::class , 'show']);

    Route::get('sessions', [App\Http\Controllers\SessionController::class , 'index']);
    Route::get('session/{id}', [App\Http\Controllers\SessionController::class , 'show']);

    Route::get('condominium', [App\Http\Controllers\CondominiumController::class , 'index']);
    Route::get('condominium/{id}', [App\Http\Controllers\CondominiumController::class , 'show']);
});

Route::group(['middleware' => ['jwt.verify:admin']], function () {

    Route::post('city', [App\Http\Controllers\CityController::class , 'store']);
    Route::put('city/{id}', [App\Http\Controllers\CityController::class , 'update']);
    Route::delete('city/{id}', [App\Http\Controllers\CityController::class , 'destroy']);

    Route::post('condominia', [App\Http\Controllers\CondominiumController::class , 'store']);
    Route::put('condominia/{id}', [App\Http\Controllers\CondominiumController::class , 'update']);
    Route::delete('condominia/{id}', [App\Http\Controllers\CondominiumController::class , 'destroy']);

    Route::post('typeProperty', [App\Http\Controllers\TypePropertyController::class , 'store']);
    Route::put('typeProperty/{id}', [App\Http\Controllers\TypePropertyController::class , 'update']);
    Route::delete('typeProperty/{id}', [App\Http\Controllers\TypePropertyController::class , 'destroy']);

    // Route::post('person', [App\Http\Controllers\PersonController::class , 'store']);
    Route::put('person/{id}', [App\Http\Controllers\PersonController::class , 'update']);
    Route::delete('person/{id}', [App\Http\Controllers\PersonController::class , 'destroy']);

    Route::post('department', [App\Http\Controllers\DepartmentController::class , 'store']);
    Route::put('department/{id}', [App\Http\Controllers\DepartmentController::class , 'update']);
    Route::delete('department/{id}', [App\Http\Controllers\DepartmentController::class , 'destroy']);

    Route::post('typePerson', [App\Http\Controllers\TypePersonController::class , 'store']);
    Route::put('typePerson/{id}', [App\Http\Controllers\TypePersonController::class , 'update']);
    Route::delete('typePerson/{id}', [App\Http\Controllers\TypePersonController::class , 'destroy']);

    Route::post('condominium', [App\Http\Controllers\CondominiumController::class , 'store']);
    Route::put('condominium/{id}', [App\Http\Controllers\CondominiumController::class , 'update']);
    
});