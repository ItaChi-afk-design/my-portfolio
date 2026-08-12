<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/confirm/{contactMessage}/{token}', [ContactController::class, 'confirm'])
    ->name('contact.confirm');
