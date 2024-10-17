<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/input.css') }}" />
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        .btn-animate:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
    </style>
</head>
<body class="bg-gray-200 w-full h-screen flex items-center justify-center md:gap-40 gap-12 md:px-16 px-5 py-20 md:flex-row flex-col">
    <div class="flex flex-col items-center justify-center gap-3">
        <h1 class="font-bold text-6xl">Project Java</h1>
        <p class="text-3xl">Kelompok...</p>
    </div>
    <div class="bg-white py-10 px-16 flex flex-col gap-8 rounded-xl md:w-1/3 w-full" id="login-field">
        <div class="gap-3 flex flex-col">
            <h1 class="font-semibold text-3xl">Login</h1>
            <p class="text-lg">Selamat datang bree</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email">Masukkan email Anda</label>
                <input type="email" name="email" id="input_email" class="h-11 w-full rounded-xl border border-1 border-black px-2 py-2" placeholder="Email" required />
            </div>
            <div class="flex flex-col gap-1 relative mt-5">
                <label for="password">Masukkan password Anda</label>
                <input type="password" name="password" id="input_password" class="h-11 w-full rounded-xl border border-1 border-black px-2 py-2" placeholder="Password" required />
                <input type="checkbox" id="show-password" class="absolute right-2 top-10" onclick="togglePasswordVisibility()" />
                <label for="show-password" class="text-sm text-gray-600 cursor-pointer absolute right-2 top-2">Show</label>
            </div>
            <div class="submit_button mt-5">
                <button class="btn-animate rounded-xl bg-blue-500 py-3 text-white w-full" type="submit">Login</button>
            </div>
        </form>
        <div class="flex flex-col items-center mt-5">
            <p>
                Gak punya akun?
                <a href="{{ route('register') }}" class="text-blue-600">Daftar Disini</a>
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
    </script>
</body>
</html>
