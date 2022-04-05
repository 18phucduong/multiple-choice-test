<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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
Route::get('/test', function(){
   return 'qq';
});
Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth')
    ->group(function () {
        Route::post('/login', 'login')->name('.login');
        Route::post('/signup', 'signup');
        Route::post('/logout', 'logout')->middleware('auth:api');
        Route::get('/user', 'user')->middleware('auth:api');
});
Route::controller(TestController::class)
    ->prefix('tests')
    ->name('tests')
    ->group(function () {
        Route::get('/lists', 'lish')->name('.lish');
        Route::get('/show', 'show')->name('.show');
        Route::post('/show-result/{id}', 'showResult')->name('.showResult');
        Route::post('/store', 'store')->middleware('auth:api');
        Route::delete('/delete/{id}', 'delete')->middleware('auth:api');
        Route::post('/save', 'saveResult')->middleware('auth:api');
});
Route::controller(QuestionController::class)
    ->prefix('questions')
    ->name('questions')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/store', 'store')->middleware('auth:api');
        Route::delete('/delete/{id}', 'delete')->middleware('auth:api');
});
Route::controller(AnswerController::class)
    ->prefix('answers')
    ->name('answers')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/store', 'store')->middleware('auth:api');
        Route::delete('/delete/{id}', 'delete')->middleware('auth:api');
});
