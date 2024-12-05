<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ganti Password</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
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
        <p class="text-3xl">Kelompok....</p>
    </div>
    <div class="bg-white py-10 px-16 flex flex-col gap-12 rounded-xl md:w-1/3 w-full" id="change-password-field">
        <div class="gap-3 flex flex-col">
            <h1 class="font-semibold text-3xl">Ganti Password</h1>
        </div>
        <form method="post" action="{{ route('change_password') }}">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email">Masukkan email Anda</label>
                <input type="email" name="email" id="input_email" class="h-11 w-full rounded-xl border border-black px-2 py-2" placeholder="Email" value="{{ old('email') }}" required />
            </div>
            <div class="flex flex-col gap-1 mt-5 relative">
                <label for="oldPassword">Masukkan password lama Anda</label>
                <input type="password" name="oldPassword" id="input_old_password" class="h-11 w-full rounded-xl border border-black px-2 py-2" placeholder="Password Lama" required />
                <input type="checkbox" id="show-old-password" class="absolute right-2 top-10" onclick="togglePasswordVisibility('input_old_password', 'show-old-password')" />
                <label for="show-old-password" class="text-sm text-gray-600 cursor-pointer absolute right-2 top-2">Show</label>
            </div>
            <div class="flex flex-col gap-1 mt-5 relative">
                <label for="newPassword">Masukkan password baru Anda</label>
                <input type="password" name="newPassword" id="input_new_password" class="h-11 w-full rounded-xl border border-black px-2 py-2" placeholder="Password Baru" required />
                <input type="checkbox" id="show-new-password" class="absolute right-2 top-10" onclick="togglePasswordVisibility('input_new_password', 'show-new-password')" />
                <label for="show-new-password" class="text-sm text-gray-600 cursor-pointer absolute right-2 top-2">Show</label>
            </div>
            <div class="submit_button mt-5">
                <button class="btn-animate rounded-xl bg-blue-500 py-3 text-white w-full" type="submit">Ganti Password</button>
            </div>
        </form>
        <div class="flex flex-col items-center mt-5">
            <p>
                Kembali ke halaman?
                <a href="{{ route('login_page') }}" class="text-blue-600">Login</a>
            </p>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputId, checkboxId) {
            var passwordField = document.getElementById(inputId);
            var showPasswordCheckbox = document.getElementById(checkboxId);
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>
