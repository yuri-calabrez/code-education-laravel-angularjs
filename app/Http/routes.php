<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function(){
   return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function(){
        Route::resource('', 'ProjectController', ['except' => ['create', 'edit']]);

        //Project Note
        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');

        //Project Task
        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        Route::put('{id}/task/{taskId}', 'ProjectTaskController@update');
        Route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');

        //Members
        Route::get('{id}/members', 'ProjectController@members');
        Route::post('{id}/member/{memberId}', 'ProjectController@addMember');
        Route::delete('{id}/member/{memberId}', 'ProjectController@removeMember');
        Route::get('{id}/member/{memberId}', 'ProjectController@isMember');
    });

});
