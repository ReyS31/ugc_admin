<?php

use App\Http\Controllers\DailyActivitiesController;
use App\Http\Controllers\DailyLogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kegiatan/{dailyActivity}', [DailyActivitiesController::class, 'show']);
Route::get('/pembukuan/{dailyLog}', [DailyLogsController::class, 'show']);
