<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;



// Route untuk halaman welcome (default)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk halaman register dan proses registrasi
Route::get('/register', [UsersController::class, 'getRegisterPage'])->name('register_page');
Route::post('/register', [UsersController::class, 'register'])->name('register');

// Route untuk halaman login dan proses login
Route::get('/login', [UsersController::class, 'getLoginPage'])->name('login_page');
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::post('/join-class', [ClassController::class, 'join'])->name('join.class');
Route::get('/get-classes', [ClassController::class, 'index'])->name('get.classes');
Route::post('/create-class', [ClassController::class, 'create'])->name('create.class');
Route::get('/my-classes', [ClassController::class, 'getMyClasses'])->name('my.classes');
Route::get('/class-page/{id}', [ClassController::class, 'show'])->name('class.page');
Route::get('/class-page/{id}/submissions', [SubmissionController::class, 'index'])->name('class.submissions');
Route::delete('/submission/{id}', [SubmissionController::class, 'destroy'])->name('submission.destroy');
Route::post('/kelas/{kelas}/tasks', [TaskController::class, 'store'])->middleware('auth')->name('task.store');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->middleware('auth')->name('task.destroy');
Route::post('/kelas/{kelas}/tasks/{task}/submission', [SubmissionController::class, 'store'])->middleware('auth')->name('submission.store');
// Route::post('/add-task', [TaskController::class, 'store'])->middleware('auth')->name('task.store');


// Route untuk form pembuatan kelas
Route::get('/class/create', function () {
    return view('create_class');
})->middleware('auth')->name('create_class_form');

// Route untuk menyimpan data kelas
Route::post('/class/create', [ClassController::class, 'createClass'])->name('create_class');

// Route untuk bergabung ke kelas
Route::post('/class/join/{classCode}', [ClassController::class, 'joinClass'])->name('join_class');

// Route untuk menghapus kelas
Route::delete('/class/delete/{classCode}', [ClassController::class, 'deleteClass'])->name('delete_class');

// Route untuk halaman tugas (TaskPage)
Route::get('/class-page/{kelas}/task-page/{task}', [TaskController::class, 'showTaskPage'])->name('task_page');
Route::delete('/task/{task}/delete-file', [TaskController::class, 'deleteFile'])->name('task.deleteFile');

// Route untuk halaman ganti password dan proses ganti password
Route::get('/change-password', [UsersController::class, 'getChangePasswordPage'])->middleware('auth')->name('change_password_page');
Route::post('/change-password', [UsersController::class, 'changePassword'])->middleware('auth')->name('change_password');

// Route untuk halaman error
Route::get('/error', function () {
    return view('error_page');
})->name('error_page');

// Route untuk halaman personal
Route::get('/home', [UsersController::class, 'getPersonalPage'])->middleware('auth')->name('personal_page');

// Route untuk menampilkan video
Route::get('/video', function () {
    $path = resource_path('assets/p.mp4');
    return response()->file($path);
})->name('video');

// Route untuk logout
Route::post('/logout', function () {
    Auth::logout(); // Logout pengguna
    return redirect()->route('login_page')->with('success', 'Logout successful!');
})->name('logout');
