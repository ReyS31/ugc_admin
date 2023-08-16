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

Route::get('/pembukuan', [DailyLogsController::class, 'index'])->name('pembukuan.index');
Route::get('/pembukuan/add', [DailyLogsController::class, 'create'])->name('pembukuan.create');
Route::post('/pembukuan/add', [DailyLogsController::class, 'store'])->name('pembukuan.store');
Route::get('/pembukuan/filter', [DailyLogsController::class, 'filter'])->name('pembukuan.filter');
Route::get('/pembukuan/{dailyLog}', [DailyLogsController::class, 'show'])->name('pembukuan.show');
