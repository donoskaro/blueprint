<?php

require_once(app_path('helpers.php'));

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', 'ProjectsController');

Route::resource('project-files', 'ProjectFilesController')->only(['index', 'store', 'show']);
