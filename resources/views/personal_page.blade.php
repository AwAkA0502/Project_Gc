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
            <span>{{ $userLogin }}</span>
            <img src="assets/user.png" alt="User Image" class="user-image" tabindex="0">
            <div class="logout-menu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <aside id="sidebar" class="w-64 bg-white shadow-md h-screen fixed sidebar-visible">
        <div class="p-6">
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
                <a href="Profile" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-200 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.42 0-8 2.58-8 6v2h16v-2c0-3.42-3.58-6-8-6z"/>
                    </svg>
                    Profil
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
            <button onclick="toggleModal('join')" class="w-full bg-gray-500 text-white py-2 rounded mt-2">Batal</button>
          </div>
        </div>

  <!-- Modal Buat Kelas -->
        <div id="createModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
          <div class="bg-white p-6 rounded shadow-md w-96">
            <h2 class="text-xl mb-4">Buat Kelas</h2>
            <input type="text" id="className" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Nama Kelas">
            <input type="text" id="subjectName" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Nama Mata Pelajaran">
            <button onclick="createClass()" class="w-full bg-blue-500 text-white py-2 rounded">Buat</button>
            <button onclick="toggleModal('create')" class="w-full bg-gray-500 text-white py-2 rounded mt-2">Batal</button>
          </div>
        </div>

        <script>
    // Sidebar toggle function
          function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-hidden');
            sidebar.classList.toggle('sidebar-visible');
          }

    // Modal toggle function
          function toggleModal(type) {
            const joinModal = document.getElementById('joinModal');
            const createModal = document.getElementById('createModal');
            if (type === 'join') {
              joinModal.classList.toggle('hidden');
            } else if (type === 'create') {
            createModal.classList.toggle('hidden');
            }
          }

    // Calendar show/hide function
          function showCalendar() {
            const calendarDiv = document.getElementById('calendar');
            calendarDiv.classList.toggle('hidden');
            if (!calendarDiv.classList.contains('hidden')) {
              initializeCalendar();
            }
          }

    // Initialize FullCalendar
          function initializeCalendar() {
            const calendarEl = document.getElementById('calendar');
            new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
              editable: true,
              selectable: true,
              events: [
                {
                  title: 'Meeting',
                  start: '2024-08-30T10:00:00',
                  end: '2024-08-30T12:00:00'
                }
              ]
            }).render();
          }

    // Load classes
          function loadClasses() {
            fetch('/api/classes/all')
              .then(response => response.json())
              .then(data => {
                const classList = document.getElementById('classList');
                classList.innerHTML = '';
                data.forEach(classModel => {
                  const classCard = document.createElement('div');
                  classCard.className = 'class-card bg-white p-4 rounded shadow-md';
                  classCard.innerHTML = `
                    <h2 class="text-xl font-semibold">${classModel.className}</h2>
                    <p class="text-gray-600">${classModel.subjectName}</p>
                    <p class="text-gray-600">${classModel.classCode}</p>
                    <button class="delete-button" onclick="deleteClass('${classModel.classCode}')">Hapus</button>
                  `;
                  classCard.onclick = (event) => {
                    if (!event.target.classList.contains('delete-button')) {
                      window.location.href = 'Class';
                    }
                  };
                  classList.appendChild(classCard);
                });
              });
          }

    // Join class
          function joinClass() {
            const classCode = document.getElementById('joinClassCode').value;
            fetch(`/api/classes/join/${classCode}`)
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                    alert('Berhasil gabung kelas!');
                    loadClasses();
                    toggleModal('join');
                } else {
                    alert('Kode kelas tidak valid!');
                }
              });
          }

    // Create class
    function createClass() {
        const className = document.getElementById('createClassName').value;
        const subjectName = document.getElementById('subjectName').value;
        fetch('/api/classes/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ className, subjectName })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Kelas berhasil dibuat!');
                loadClasses();
                toggleModal('create');
            } else {
                alert('Gagal membuat kelas!');
            }
        });
    }

    // Delete class
    function deleteClass(classCode) {
        if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
            fetch(`/api/classes/delete/${classCode}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kelas berhasil dihapus!');
                    loadClasses();
                } else {
                    alert('Gagal menghapus kelas!');
                }
            });
        }
    }

    // Initial load
    document.addEventListener('DOMContentLoaded', () => {
        loadClasses();
    });
          </script>

    </main>
</body>
</html>
