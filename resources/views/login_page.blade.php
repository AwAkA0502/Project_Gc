<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/input.css') }}" />
    <title>Login Page</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        .btn-animate:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
    </style>
</head>
    <!-- backup <body class="w-full h-screen flex items-center justify-center md:gap-40 gap-12 md:px-16 md:flex-row flex-col"> -->
<body class="w-full flex h-screen">
    <img src="{{ asset('Assets/Bg_Login.png') }}" alt="login image" class="w-full" style="margin-right: -10px;">
    <div class="bg-white px-20 flex flex-col gap-16 rounded-l-2xl h-full justify-center" id="login-field" style="background-color: #89B88D; width: 840px;">
        <div class="gap-3 flex flex-col">
            <h1 class="font-semibold text-white" style="font-size: 40px;">Login</h1>
            <p class="text-white font-regular text-xl">Selamat datang bree</p>
        </div>
        
        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>   
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email" class="text-white text-base">Masukkan email Anda</label>
                <input type="email" name="email" id="input_email" class="h-11 w-full rounded-xl border p-2" style="background-color: #779578; border-color: #618264;" placeholder="Email" required />
            </div>
            <div class="flex flex-col gap-1 relative">
                <label for="password" class="text-white text-base">Masukkan password Anda</label>
                <input type="password" name="password" id="input_password" class="h-11 w-full rounded-xl border p-2" style="background-color: #779578; border-color: #618264;" placeholder="Password" required />
                <input type="checkbox" id="show-password" class="absolute right-2 top-10" onclick="togglePasswordVisibility()" />
                <label for="show-password" class="text-sm text-gray-600 cursor-pointer absolute right-2 top-2">Show</label>
            </div>
            <p class="text-base" style="color: #064420;">Forgot Password</p>
            <div class="submit_button ">
                <button class="btn-animate rounded-xl py-3  w-full font-medium text-xl" style="background-color: #B0D9B1; color: #506C50;" type="submit">Login</button>
            </div>
        </form>
        <div class="flex flex-col items-center mt-5">
            <p class="text-white text-base">
                Gak punya akun?
                <a href="{{ route('register') }}" class="text-base" style="color: #064420;">Daftar Disini</a>
            </p>
            <p class="mt-2">
                Ganti password?
                <a href="{{ route('change_password') }}" class="text-blue-600">Ganti Password</a>
            </p>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('input_password');
            var showPasswordCheckbox = document.getElementById('show-password');
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
        function login() {
            const passwordInput = document.getElementById('passwordInput').value; // Ambil password dari input
            const correctPassword = "your_correct_password"; // Ganti dengan password yang benar

            if (passwordInput === correctPassword) {
        // Arahkan ke halaman utama jika password benar
                window.location.href = "home_page.html"; // Ganti dengan halaman utama Anda
            } else {
        // Arahkan ke halaman error jika password salah
                window.location.href = "error_page.html"; // Ganti dengan nama file error_page Anda
            }
        }
    </script>
</body>
</html>
