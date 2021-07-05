<?php

require_once(app_path('helpers.php'));

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', 'ProjectsController');
Route::post('projects/{projectId}/file', 'ProjectFilesController@store')->name('project-files.store');
