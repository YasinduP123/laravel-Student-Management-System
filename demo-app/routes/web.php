<?php

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use \Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/students', function () {
//     return view('student', [
//         'students' => Student::all()
//     ]);
// });


Route::get('/about', [StudentController::class, 'index'])->middleware(['auth']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/students/edit/{id}', function ($id) {
        // dd( Student::find($id));
        return view('student-edit', [
            'selectedStudents' => Student::find($id)
        ]);
    });
    Route::get('/students', [StudentController::class, 'index'])->middleware(['auth','verified']);
    Route::post('/students/find-by-email', [StudentController::class, 'findByEmail']);
    Route::post('/students/save',  [StudentController::class, 'store'])->name('student.store');
    // Route::get('/button-view',  [StudentController::class, 'show'])->name('student.edit');
    Route::get('/button/delete/{id}',  [StudentController::class, 'delete'])->name('student.delete');
    Route::get('/payments',  [StudentController::class, 'index'])->name('payment.paypal');
    Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');

});
Route::get('/payments', [PayPalController::class, 'index'])->name('payment');
Route::post('/payments-paypal', [PayPalController::class, 'paypal'])->name('paypal');
Route::get('/payments-success', [PayPalController::class, 'success'])->name( 'success');
Route::get('/payments-cancel', [PayPalController::class, 'cancel'])->name('cancel');



// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');
