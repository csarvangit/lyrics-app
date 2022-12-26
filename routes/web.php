<?php

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
    return view('index');
});

 
//Auth::routes();

Route::group(['prefix' => 'admin'], function () {

    Auth::routes();

});

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::get('/admin/songs', [App\Http\Controllers\SongsController::class, 'index'])->name('songs');
Route::get('/admin/songs/create', [App\Http\Controllers\SongsController::class, 'create'])->name('songs.create');
Route::post('/admin/songs/store', [App\Http\Controllers\SongsController::class, 'store'])->name('songs.store');
Route::get('/admin/songs/show/{id}', [App\Http\Controllers\SongsController::class, 'show'])->name('songs.show');
Route::get('/admin/songs/edit/{id}', [App\Http\Controllers\SongsController::class, 'edit'])->name('songs.edit');
Route::patch('/admin/songs/update/{id}', [App\Http\Controllers\SongsController::class, 'update'])->name('songs.update');
Route::delete('/admin/songs/destroy/{id}', [App\Http\Controllers\SongsController::class, 'destroy'])->name('songs.destroy');*/

Route::resource('/admin/songs', 'App\Http\Controllers\SongsController');
Route::resource('/admin/movies', 'App\Http\Controllers\MoviesController');
Route::resource('/admin/music-directors', 'App\Http\Controllers\MusicDirectorsController');
Route::resource('/admin/singers', 'App\Http\Controllers\SingersController');
Route::resource('/admin/lyricists', 'App\Http\Controllers\LyricistsController');

Route::get('/admin/artists/lyricists', [App\Http\Controllers\ArtistsController::class, 'lyricists'])->name('artists.lyricists');
Route::get('/admin/artists/singers', [App\Http\Controllers\ArtistsController::class, 'singers'])->name('artists.singers');
Route::get('/admin/artists/music-directors', [App\Http\Controllers\ArtistsController::class, 'music_directors'])->name('artists.music_directors');

Route::resource('/admin/artists', 'App\Http\Controllers\ArtistsController');

Route::get('/clear-all', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    return '<h1>All cache cleared</h1>';
});

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

