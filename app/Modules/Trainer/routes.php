<?php

Route::group(['middleware' => 'web'], function () {
    // Application routes
    Route::group(['module' => 'Trainer', 'namespace' => 'Application'], function () {
        Route::get('trainers', ['as' => 'trainers', 'uses' => 'TrainerController@all']);
        Route::get('trainer/{trainer_slug}', ['as' => 'trainer.page', 'uses' => 'TrainerController@index']);
        Route::get('trainer', ['as' => 'trainer', 'uses' => 'TrainerController@me']);
        Route::get('trainer/{trainer_slug}/edit', ['as' => 'application.trainer.edit', 'uses' => 'TrainerController@edit']);
    });
});

// API routes
Route::group(['prefix' => 'api', 'module' => 'Trainer', 'namespace' => 'Api', 'middleware' => 'api'], function () {
    //
});

// Admin routes
Route::group(['prefix' => 'dashboard', 'module' => 'Trainer', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
	Route::resource('trainer', 'TrainerController');
});
