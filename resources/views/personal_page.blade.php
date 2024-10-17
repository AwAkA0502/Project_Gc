<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Project</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.js"></script>
  <style>
    .sidebar-hidden {
      transform: translateX(-100%);
      transition: transform 0.3s ease;
    }
    .sidebar-visible {
      transform: translateX(0);
      transition: transform 0.3s ease;
    }
    .fixed-top-left {
      position: fixed;
      top: 16px;
      left: 16px;
      z-index: 50;
    }
    .fixed-top-right {
      position: fixed;
      top: 16px;
      right: 16px;
      display: flex;
      align-items: center;
      z-index: 50;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
    .user-info {
      display: flex;
      align-items: center;
      margin-left: 10px;
      position: relative;
    }
    .user-info span {
      margin-right: 10px;
    }
    .user-image {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
    }
    .logout-menu {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background-color: white;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      z-index: 10;
    }
    .user-info img:focus + .logout-menu, .logout-menu:hover {
      display: block;
    }
    .class-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      position: relative;
    }
    .class-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    .delete-button {
      position: absolute;
      top: 8px;
      right: 8px;
      background-color: red;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.875rem;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-gray-100 flex">

  <div class="fixed-top-left" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
  </div>

  <div class="fixed-top-right">
    <div class="dropdown">
      <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 5v14M5 12h14"/>
        </svg>
      </button>
      <div class="dropdown-content">
        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200" onclick="toggleModal('join')">Gabung Kelas</a>
        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200" onclick="toggleModal('create')">Buat Kelas</a>
      </div>
    </div>
    <div class="user-info">
      <span th:text="${userLogin}"></span>
      <img src="assets/user.png" alt="User Image" class="user-image" tabindex="0">
      <div class="logout-menu">
        <a href="/login_page" class="block px-4 py-2 text-gray-800 hover:bg-gray-200" onclick="logout()">Logout</a>
      </div>
    </div>
  </div>

  <aside id="sidebar" class="w-64 bg-white shadow-md h-screen fixed sidebar-visible">
    <div class="p-6">
      <div class="flex justify-between items-center">
      </div>
      <nav class="mt-10">
        <a href="#" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12h18M3 6h18M3 18h18"/>
          </svg>
          Beranda
        </a>
        <a href="#" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 gap-2" onclick="showCalendar()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2a10 10 0 0110 10 10 10 0 01-10 10A10 10 0 012 12 10 10 0 0112 2z"/>
            <path d="M12 6v6l4 2"/>
          </svg>
          Kalender
        </a>
        <a href="Class" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6v14h16V6H4zM4 10h16"/>
          </svg>
          Mengajar
        </a>
        <a href="Class" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6v14h16V6H4zM4 10h16"/>
          </svg>
          Kelas
        </a>
      </nav>
    </div>
  </aside>

  <div id="content" class="flex-1 p-6 ml-64">
    <h1 class="text-2xl font-semibold mb-6">Kelas</h1>
    <div id="classList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    <!-- Calendar -->
    <div id="calendar" class="hidden mt-6"></div>
  </div>

  <!-- Modal Gabung Kelas -->
  <div id="joinModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-md w-96">
      <h2 class="text-xl mb-4">Gabung Kelas</h2>
      <input type="text" id="joinClassCode" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Masukkan Kode Kelas">
      <button onclick="joinClass()" class="w-full bg-blue-500 text-white py-2 rounded">Gabung</button>
      <button onclick="toggleModal('join')" class="mt-4 text-red-500">Tutup</button>
    </div>
  </div>

  <!-- Modal Buat Kelas -->
  <div id="createModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded shadow-md w-96">
      <h2 class="text-xl mb-4">Buat Kelas</h2>
      <input type="text" id="className" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Nama Kelas">
      <input type="text" id="classCode" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Kode Kelas">
      <button onclick="createClass()" class="w-full bg-blue-500 text-white py-2 rounded">Buat</button>
      <button onclick="toggleModal('create')" class="mt-4 text-red-500">Tutup</button>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('sidebar-hidden');
      sidebar.classList.toggle('sidebar-visible');
    }

    function toggleModal(type) {
      const modal = document.getElementById(type === 'join' ? 'joinModal' : 'createModal');
      modal.classList.toggle('hidden');
    }

    function joinClass() {
      const classCode = document.getElementById('joinClassCode').value;
      // Lakukan proses gabung kelas di sini
      alert('Berhasil gabung kelas dengan kode: ' + classCode);
      toggleModal('join');
    }

    function createClass() {
      const className = document.getElementById('className').value;
      const classCode = document.getElementById('classCode').value;
      // Lakukan proses buat kelas di sini
      alert('Kelas berhasil dibuat: ' + className + ' (Kode: ' + classCode + ')');
      toggleModal('create');
    }

    function logout() {
      // Proses logout di sini
      alert('Anda telah logout');
    }

    function showCalendar() {
      const calendarElement = document.getElementById('calendar');
      calendarElement.classList.toggle('hidden');
      const calendar = new FullCalendar.Calendar(calendarElement, {
        initialView: 'dayGridMonth',
        // Konfigurasi lainnya untuk calendar
      });
      calendar.render();
    }
  </script>
</body>
</html>
