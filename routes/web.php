<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\InfoController;
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
})->name('base');

Route::get('locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    Session::put('locale', $locale);
    App::setLocale($locale);
    return redirect()->back();
})->name('locale');

Auth::routes();
Route::get('info', [InfoController::class, 'index']);
// Route::get('info',function () {return view('info');})->name('appinfo');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('tasks', TasksController::class);
Route::post('finished/task',[TasksController::class, 'setfinished'])->name('tasks.setfinished');
Route::get('finished', [TasksController::class, 'finished'])->name('tasks.finished');
Route::get('unfinished', [TasksController::class, 'unfinished'])->name('tasks.unfinished');
Route::get('byproject/{project}', [TasksController::class, 'byproject'])->name('tasks.byproject');

Route::group(['prefix' => 'site/settings'], function () {
    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return "Cleared!";
    });
    Route::get('/info', function () {
        phpinfo();
    });
    Route::get('/cc', function () {
        $exitCode = Artisan::call('cache:clear');
        return "Cleared!";
    });
});
