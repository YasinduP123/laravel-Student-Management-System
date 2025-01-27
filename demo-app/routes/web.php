<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/students', function () {
    return view(view: 'student');
});
Route::post('/students', [StudentController::class, 'store'])->name('student.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
