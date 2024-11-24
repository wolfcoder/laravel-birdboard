<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects', [ProjectController::class, 'index']);
// route to specific id
Route::get('/projects/{project}', [ProjectController::class, 'show']);

Route::post('/projects', [ProjectController::class, 'store']);

Route::get('/phpinfo', function () {
    phpinfo();
});
