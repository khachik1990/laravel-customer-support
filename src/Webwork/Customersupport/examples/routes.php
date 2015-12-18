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

Route::group(['prefix' => 'tickets', 'before' => 'auth'], function () {

    Route::get('create', ['as' => 'tickets.create', 'uses' => 'TicketsController@create']);
    Route::get('/{status?}', ['as' => 'tickets', 'uses' => 'TicketsController@index']);
    Route::post('/', ['as' => 'tickets.store', 'uses' => 'TicketsController@store']);
    Route::post('{id}', ['as' => 'tickets.addComment', 'uses' => 'TicketsController@addComment']);
    Route::get('view/{id}', ['as' => 'tickets.show', 'uses' => 'TicketsController@show']);
    Route::get('solved/{id}', ['as' => 'tickets.makeSolved', 'uses' => 'TicketsController@makeSolved']);

    // Download Route
    Route::get('download/{filefolder}/{filename}', function($filefolder, $filename) {
                // Check if file exists in app/storage/file folder
                $file_path = public_path() . '/uploads/customersupport/attached/' . $filefolder . '/' . $filename;
                if (file_exists($file_path)) {
                    // Send Download
                    return Response::download($file_path, $filename, [
                                'Content-Length: ' . filesize($file_path)
                    ]);
                } else {
                    // Error
                    exit('Requested file does not exist on our server!');
                }
            })
            ->where('filename', '[A-Za-z0-9\-\_\.]+');
});

