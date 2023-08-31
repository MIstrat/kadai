<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InformationController;

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

Route::group(['middleware' => ['auth']], function(){
    Route::get('/index',[PostController::class,'index'])->name('index');
    //Route::get('/index',[InformationController::class,'store']);
    Route::get('/index/store',[PostController::class,'add'])->name('add');
    Route::post('/index',[PostController::class,'store'])->name('store');
    //Route::post('/index',[InformationController::class,'store']);
    Route::get('/index/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::get('/index/{post}',[PostController::class,'info'])->name('info');
    Route::put('/index/{post}',[PostController::class,'update'])->name('update');
    Route::delete('/index/{post}', [PostController::class, 'delete'])->name('delete');
    Route::get('/notifications',[PostController::class,'notification'])->name('notification');
    Route::get('/notifications/{notification}',[PostController::class,'read'])->name('notifications.read');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
