<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Menampilkan halaman registrasi
    public function getRegisterPage()
    {
        return view('register_page');
    }

    // Menampilkan halaman login
    public function getLoginPage()
    {
        return view('login_page');
    }

    // Proses registrasi pengguna
    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login_page')->with('success', 'User registered successfully');
    }

    // Proses login pengguna
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return view('personal_page', ['userLogin' => $user->login]);
        }

        return view('error_page')->withErrors(['message' => 'Invalid credentials']);
    }

    // Menampilkan halaman ganti password
    public function getChangePasswordPage()
    {
        return view('change_password_page');
    }

    // Proses ganti password
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('login_page')->with('success', 'Password changed successfully');
        }

        return view('error_page')->withErrors(['message' => 'Invalid credentials']);
    }

    // Menampilkan halaman kelas
    public function welcome()
    {
        return view('class_page');
    }

    // Menampilkan halaman tugas
    public function viewTaskPage()
    {
        return view('task_page');
    }

    // Menampilkan halaman personal setelah login
    public function getPersonalPage()
    {
        return view('personal_page');
    }
}
