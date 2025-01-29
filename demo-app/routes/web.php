<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/students', function () {
    return view('student', [
        'students' => Student::all()
    ]);
});
Route::get('/students-edit/{id}', function ($id) {
    // dd( Student::find($id));
    return view('student-edit', [
        'selectedStudents' => Student::find($id)
    ]);
});
Route::post('/students',  [StudentController::class, 'store'])->name('student.store');
// Route::get('/button-view/{id}',  [StudentController::class, 'show'])->name('student.edit');
Route::get('/button-delete/{id}',  [StudentController::class, 'delete'])->name('student.delete');
Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
