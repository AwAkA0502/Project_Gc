<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            color: #000;
            text-align: center;
            overflow: hidden;
            position: relative;
            background: #f4f7f6;
        }
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.8;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 40px;
            text-shadow: 2px 4px 6px rgba(255, 255, 255, 0.4);
            animation: fadeInDown 1s ease;
        }
        a {
            display: inline-block;
            margin: 15px 25px;
            padding: 15px 35px;
            border-radius: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
            text-decoration: none;
            font-size: 1.3em;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        a::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: rgba(255, 255, 255, 0.3);
            transition: all 0.5s ease;
            border-radius: 50%;
            z-index: 0;
            transform: translate(-50%, -50%) scale(0.1);
        }
        a:hover::before {
            transform: translate(-50%, -50%) scale(1);
        }
        a:hover {
            color: #ff6f61;
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        a span {
            position: relative;
            z-index: 1;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="background-video">
        <source src="{{ asset('assets/u.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <h1>Email atau Password ada yang salah, coba diingat</h1>
    <a href="{{ route('register_page') }}"><span>Register</span></a>
    <a href="{{ route('login_page') }}"><span>Login</span></a>
</body>
</html>
