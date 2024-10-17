<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('static/css/login_page_style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .registration-container {
            background-color: #ffffff;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .registration-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }
        .registration-container .form-group {
            margin-bottom: 15px;
        }
        .registration-container input {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .registration-container .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        .registration-container .submit-btn:hover {
            background-color: #0056b3;
        }
        .registration-container label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 16px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="registration-container">
        <section id="welcome-message">
            <h2>Welcome to the Registration Session</h2>
        </section>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="input_login">Username</label>
                <input id="input_login" name="login" placeholder="Enter your username" type="text" required>
            </div>
            <div class="form-group">
                <label for="input_password">Password</label>
                <input id="input_password" name="password" placeholder="Enter your password" type="password" required>
            </div>
            <div class="form-group">
                <label for="input_email">Email</label>
                <input id="input_email" name="email" placeholder="Enter your email" type="email" required>
            </div>
            <div class="form-group">
                <input class="submit-btn" type="submit" value="Register">
            </div>
            <div class="login-link">
                <p>Already registered? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </form>
    </div>

</body>
</html>
