<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/input.css') }}" />
    <title>Halaman Utama</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <style>
      .background-video {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
        object-fit: cover;
      }

      .content {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 15px;
      }

      .content-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        height: 100%;
        padding-right: 50px;
      }
    </style>
  </head>
  <body class="bg-gray-200 w-full h-screen">
    <video autoplay muted loop class="background-video">
      <source src="{{ asset('assets/p.mp4') }}" type="video/mp4">
      Browser Anda tidak mendukung video HTML5.
    </video>

    <div class="content-container">
      <div class="content text-center">
        <h1 class="font-bold text-4xl">Proyek Java</h1>
        <p class="text-2xl font-bold">Kelompok...</p>
        <div class="flex flex-col gap-3 mt-4">
          <a href="{{ route('register_page') }}" class="text-blue-600 text-lg hover:underline">Daftar</a>
          <a href="{{ route('login_page') }}" class="text-blue-600 text-lg hover:underline">Masuk</a>
        </div>
      </div>
    </div>
  </body>
</html>
