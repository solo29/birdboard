<?php



Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/projects', 'ProjectsController@index');

    Route::get('/projects/create', 'ProjectsController@create');



    Route::get('/projects/{project}', 'ProjectsController@show');

    Route::post('/projects', 'ProjectsController@store');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');

    Route::patch('/projects/{project}', 'ProjectsController@update');

    Route::patch('/projects/{project}/update', 'ProjectsController@update');

    Route::get('/projects/{project}/update', 'ProjectsController@update_route');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
