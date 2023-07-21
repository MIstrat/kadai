<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\InformationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/notice',[PostController::class,'notice'])->name('notice');
    Route::post('/notice',[PostController::class,'read'])->name('read');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__.'/auth.php';
