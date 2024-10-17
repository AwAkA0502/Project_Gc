<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

// Route untuk halaman kelas (Class)
Route::get('/class', [UsersController::class, 'welcome'])->name('class_page');

// Route untuk halaman tugas (TaskPage)
Route::get('/task-page', [UsersController::class, 'viewTaskPage'])->name('task_page');

// Route untuk halaman ganti password dan proses ganti password
Route::get('/change-password', [UsersController::class, 'getChangePasswordPage'])->name('change_password_page');
Route::post('/change-password', [UsersController::class, 'changePassword'])->name('change_password');

// Route untuk halaman error
Route::get('/error', function () {
    return view('error_page');
})->name('error_page');

// Route untuk halaman personal
Route::get('/personal', [UsersController::class, 'getPersonalPage'])->name('personal_page');
