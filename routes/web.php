<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(ChatController::class)->group(function (){

    Route::get('/chat', 'index')->name('chat');
    Route::get('/ls-chat/{user}', 'lsChat')->name('lsChat');
    Route::get('/users', 'users')->name('users');
    Route::get('/messages', 'messages');
    Route::get('/ls-messages/{user}', 'lsMessages');
    Route::post('/send', 'send');
    Route::post('/ls-send', 'sendLs');

})->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
