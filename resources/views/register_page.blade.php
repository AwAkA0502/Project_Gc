<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Register Page</title>
</head>
<body class="w-full flex h-screen">
    <img src="{{ asset('Assets/Bg_Login.png') }}" alt="login image" class="w-full" style="margin-right: -10px;">
    <div class="px-20 flex flex-col gap-16 rounded-l-2xl h-full justify-center" style="background-color: #89B88D; width: 840px;">
        <h2 class="font-semibold text-white" style="font-size: 40px;">Create Account</h2>
        
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
            @csrf
            <div class="form-group flex flex-col gap-1">
                <label for="input_login" class="text-white text-base">Username</label>
                <input id="input_login" class="h-11 w-full rounded-xl border p-2 text-white text-base" style="background-color: #779578; border-color: #618264;" name="login" placeholder="Enter your username" type="text" required>
            </div>
            <div class="form-group flex flex-col gap-1">
                <label for="input_password" class="text-white text-base">Password</label>
                <input id="input_password" class="h-11 w-full rounded-xl border p-2 text-white text-base" style="background-color: #779578; border-color: #618264;" name="password" placeholder="Enter your password" type="password" required>
            </div>
            <div class="form-group">
                <label for="input_email" class="text-white text-base">Email</label>
                <input id="input_email" class="h-11 w-full rounded-xl border p-2 text-white text-base" style="background-color: #779578; border-color: #618264;" name="email" placeholder="Enter your email" type="email" required>
            </div>
            <div class="form-group">
                <input class="btn-animate rounded-xl py-3  w-full font-medium text-xl" style="background-color: #B0D9B1; color: #506C50;" type="submit" value="Register">
            </div>
        </form>
        <div class="flex gap-1 justify-center items-center">
            <p class="text-white text-base">Sudah Punya Akun? 
                <a href="{{ route('login') }}" class="text-base" style="color: #064420;">Daftar Disini</a>
            </p>
        </div>
    </div>

</body>
</html>
