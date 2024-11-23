<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<body class="bg-white h-screen flex flex-col">
    <nav class="flex w- justify-between items-center py-3 px-8 border-b border-black">
        <div class="flex gap-4 justify-between items-center">
            <button type="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#000000"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
            </button>
            <h1 class="font-semibold text-2xl">Name</h1>
        </div>
        <div class="flex gap-4 justify-between items-center">
            <button type="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
            </button>
            <div class="flex flex-col">
                <div class="flex gap-3 justify-between items-center" id="Account">
                    <p>{{ auth()->user()->name }}</p>                    <img src="assets/user.png" class="w-10 h-10 cursor-pointer" id="accountImage">
                </div>
                <div class="relative">
                    <div id="dropdownMenu" class="hidden bg-gray-100 p-2 w-full rounded-lg absolute right-0 mt-2">
                        <button class="p-2 bg-red-500 text-white font-medium w-full rounded-lg">Log out</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
	<div>
		<h3><a th:href="@{/List_users}"></a></h3> 
		<h3><a th:href="@{/register}"></a></h3>
		<h3><a th:href="@{/Login}"></a></h3>
	</div>
    <section id="Content" class="flex">
        <div id="Sidebar" class="flex flex-col py-2 border-r h-screen border-black w-96 px-2 gap-3" style="width: 506px;">
            <div id="Beranda" class="flex gap-4 justify-start items-center px-4 py-2 bg-gray-300 rounded-xl">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    <p class="font-medium">Beranda</p>
            </div>
            <div id="Study" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    <p class="font-medium">Mengajar</p>
            </div>
            <div id="Course" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folders"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" /></svg>
                    <p class="font-medium">My Course</p>
            </div>
            <div id="class" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <img src="" class="w-7 h-7 bg-gray-700 rounded-full">
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Matematika Lanjut</p>
                    <p class="text-sm">My Course</p>
                </div>
            </div> <div id="class" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <img src="" class="w-7 h-7 bg-gray-700 rounded-full">
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Matematika Lanjut</p>
                    <p class="text-sm">My Course</p>
                </div>
            </div> 
            <div id="Setting" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>
                    <p class="font-medium">Settings</p>
            </div>
        </div>
        <div id="MainContent" class="w-full flex flex-col gap-3 p-4">
            <div id="Timeline" class="w-full flex flex-col gap-2">
                <p class="text-xl font-semibold">Timeline</p>
                <div class="w-full gap-3 flex flex-wrap justify-start items-center">
                    <div class="flex flex-col gap-2 p-3 bg-green-400 rounded-xl flex-grow">
                        <p class="font-medium">Thursday, 2 Mei 2024</p>
                        <div class="flex gap-2 w-full justify-start items-center">
                            <img src="" class="w-10 h-10 bg-white rounded-full">
                            <div class="flex flex-col gap-1">
                                <p class="font-medium">Nama Kelas</p>
                                <p class="font-medium">Nama Tugas</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 p-3 bg-green-400 rounded-xl flex-grow">
                        <p class="font-medium">Thursday, 2 Mei 2024</p>
                        <div class="flex gap-2 w-full justify-start items-center">
                            <img src="" class="w-10 h-10 bg-white rounded-full">
                            <div class="flex flex-col gap-1">
                                <p class="font-medium">Nama Kelas</p>
                                <p class="font-medium">Nama Tugas</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 p-3 bg-green-400 rounded-xl flex-grow">
                        <p class="font-medium">Thursday, 2 Mei 2024</p>
                        <div class="flex gap-2 w-full justify-start items-center">
                            <img src="" class="w-10 h-10 bg-white rounded-full">
                            <div class="flex flex-col gap-1">
                                <p class="font-medium">Nama Kelas</p>
                                <p class="font-medium">Nama Tugas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Timeline" class="w-full flex flex-col gap-2">
                <p class="text-xl font-semibold">Kelas saya</p>
                <div id="cardsContainer" class="mt-4 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3"></div>
            </div>
        </div>
        <div id="SubContent" class="w-54 flex flex-col gap-3 p-5">
            <div class="w-full flex flex-col gap-3 border border-gray-600 rounded-xl p-3">
                <p class="text-xl font-medium">Buat Kelas</p>
                <button id="buatKelasBtn" class="p-2 bg-blue-500 text-white rounded-lg">Buat Kelas</button>
            </div>
            <div id="modalMakeClass" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-5 rounded-lg shadow-lg w-1/3 flex flex-col gap-2">
                    <div class="flex justify-between items-start mb-4 flex-col gap-2 max-h-fit">
                        <h2 class="text-xl font-semibold">Nama Kelas</h2>
                        <input id="nameInput" type="text" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full">
                    </div>
                    <div class="flex justify-between items-start mb-4 flex-col gap-2 max-h-fit">
                        <h2 class="text-xl font-semibold">Nama Pelajaran</h2>
                        <input id="subjectInput" type="text" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full">
                    </div>
                    <button id="buatKelasModalBtn" class="p-2 bg-blue-500 text-white rounded-lg font-medium">Buat</button>
                </div>
            </div>
            <div class="w-full flex flex-col gap-3 border border-gray-600 rounded-xl p-3">
                <p>Masukkan kode kelas yang diberikan oleh guru Anda di bawah ini.</p>
                <input type="text" id="classCodeInput" placeholder="Kode Kelas" class="w-full p-3 border rounded-xl border-gray-600">
                <button id="joinClassBtn" class="w-full p-3 bg-blue-500 text-white rounded-xl">
                    Gabung Kelas
                </button>
            </div>
            
            <div class="w-full flex flex-col gap-3 border border-gray-600 rounded-xl p-3">
                <p>Calendar</p>
                <div class="calendarwrapper bg-white p-4 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-2">
                        <a href="#" class="text-blue-500 hover:text-blue-700" title="Previous month">
                            <span class="arrow">◄</span>
                        </a>
                        <span class="font-semibold text-lg">June 2024</span>
                        <a href="#" class="text-blue-500 hover:text-blue-700" title="Next month">
                            <span class="arrow">►</span>
                        </a>
                    </div>
                    <table class="minicalendar calendartable w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border text-center py-1" scope="col">Mon</th>
                                <th class="border text-center py-1" scope="col">Tue</th>
                                <th class="border text-center py-1" scope="col">Wed</th>
                                <th class="border text-center py-1" scope="col">Thu</th>
                                <th class="border text-center py-1" scope="col">Fri</th>
                                <th class="border text-center py-1" scope="col">Sat</th>
                                <th class="border text-center py-1" scope="col">Sun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border text-center py-1">&nbsp;</td>
                                <td class="border text-center py-1">&nbsp;</td>
                                <td class="border text-center py-1">&nbsp;</td>
                                <td class="border text-center py-1">&nbsp;</td>
                                <td class="border text-center py-1">&nbsp;</td>
                                <td class="border text-center py-1">1</td>
                                <td class="border text-center py-1">2</td>
                            </tr>
                            <tr>
                                <td class="border text-center py-1">3</td>
                                <td class="border text-center py-1">4</td>
                                <td class="border text-center py-1">5</td>
                                <td class="border text-center py-1">6</td>
                                <td class="border text-center py-1">7</td>
                                <td class="border text-center py-1">8</td>
                                <td class="border text-center py-1">9</td>
                            </tr>
                            <tr>
                                <td class="border text-center py-1">10</td>
                                <td class="border text-center py-1">11</td>
                                <td class="border text-center py-1">12</td>
                                <td class="border text-center py-1">13</td>
                                <td class="border text-center py-1">14</td>
                                <td class="border text-center py-1">15</td>
                                <td class="border text-center py-1">16</td>
                            </tr>
                            <tr>
                                <td class="border text-center py-1">17</td>
                                <td class="border text-center py-1">18</td>
                                <td class="border text-center py-1">19</td>
                                <td class="border text-center py-1">20</td>
                                <td class="border text-center py-1">21</td>
                                <td class="border text-center py-1">22</td>
                                <td class="border text-center py-1">23</td>
                            </tr>
                            <tr>
                                <td class="border text-center py-1">24</td>
                                <td class="border text-center py-1">25</td>
                                <td class="border text-center py-1">26</td>
                                <td class="border text-center py-1">27</td>
                                <td class="border text-center py-1">28</td>
                                <td class="border text-center py-1">29</td>
                                <td class="border text-center py-1">30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
</body>
<script>
    document.getElementById('accountImage').addEventListener('click', function() {
    const dropdown = document.getElementById('dropdownMenu');
    dropdown.classList.toggle('hidden');
});
    
     document.addEventListener('DOMContentLoaded', function() {
            const buatKelasBtn = document.getElementById('buatKelasBtn');
            const modalMakeClass = document.getElementById('modalMakeClass');
            const modalContent = document.querySelector('#modalMakeClass > .bg-white');
            const closeModalBtn = document.getElementById('buatKelasModalBtn');
            const nameInput = document.getElementById('nameInput');
            const subjectInput = document.getElementById('subjectInput');
            const submitBtn = document.getElementById('buatKelasModalBtn');

            // Fungsi untuk menutup modal dan mereset input
            function closeModal() {
                modalMakeClass.classList.add('hidden');
                nameInput.value = '';
                subjectInput.value = '';
            }

            // Menambahkan event listener untuk membuka modal
            buatKelasBtn.addEventListener('click', function() {
                modalMakeClass.classList.remove('hidden');
            });

            // Menambahkan event listener untuk menutup modal (tombol Buat)
            submitBtn.addEventListener('click', closeModal);

            // Menambahkan event listener untuk menutup modal ketika area luar modal diklik
            modalMakeClass.addEventListener('click', function(event) {
                if (event.target === modalMakeClass) {
                    closeModal();
                }
            });

            // Mencegah penutupan modal ketika mengklik konten modal
            modalContent.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
</script>
<script>
    // Fungsi untuk mengambil data kelas dari server dan menampilkan card
function loadClasses() {
    fetch('/my-classes', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = ''; // Kosongkan container sebelum menambahkan card

        // Render setiap kelas ke dalam container
        data.kelas.forEach(kelas => {
            const newCard = document.createElement('a');
            newCard.href = `/class-page/${kelas.id}`;
            newCard.className = 'rounded-xl border border-black flex-grow';
            newCard.innerHTML = `
                <div class="max-h-fit w-full">
                    <img src="Assets/Background_Class.png" class="rounded-t-xl w-full h-24">
                </div>
                <div class="flex justify-between w-full px-4 py-2">
                    <div class="flex flex-col">
                        <p>${kelas.nama_kelas}</p>
                        <p>${kelas.nama_pelajaran}</p>
                    </div>
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                        </svg>
                    </button>
                </div>
            `;
            cardsContainer.appendChild(newCard);
        });
    })
    .catch(error => console.error('Error:', error));
}

// Fungsi untuk membuat kelas baru dan menampilkan card
document.getElementById('buatKelasModalBtn').addEventListener('click', function () {
    const nameInput = document.getElementById('nameInput').value;
    const subjectInput = document.getElementById('subjectInput').value;

    fetch('/create-class', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nama_kelas: nameInput,
            nama_pelajaran: subjectInput
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Kelas berhasil dibuat') {
            const cardsContainer = document.getElementById('cardsContainer');
            const newCard = document.createElement('a');
            newCard.href = `/class-page/${data.kelas.id}`;
            newCard.className = 'rounded-xl border border-black flex-grow';
            newCard.innerHTML = `
                <div class="max-h-fit w-full">
                    <img src="Assets/Background_Class.png" class="rounded-t-xl w-full h-24">
                </div>
                <div class="flex justify-between w-full px-4 py-2">
                    <div class="flex flex-col">
                        <p>${data.kelas.nama_kelas}</p>
                        <p>${data.kelas.nama_pelajaran}</p>
                    </div>
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                        </svg>
                    </button>
                </div>
            `;
            cardsContainer.appendChild(newCard);

            // Tutup modal
            document.getElementById('modalMakeClass').classList.add('hidden');
        } else {
            alert('Terjadi kesalahan: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Panggil loadClasses saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadClasses);

document.getElementById('joinClassBtn').addEventListener('click', function () {
        const kodeKelas = document.getElementById('classCodeInput').value;

        if (!kodeKelas.trim()) {
            alert('Kode kelas tidak boleh kosong.');
            return;
        }

        // Kirim kode kelas ke server menggunakan Fetch API
        fetch('/join-class', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ kode_kelas: kodeKelas })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Berhasil bergabung ke kelas') {
                alert('Anda berhasil bergabung ke kelas!');
                loadClasses(); // Refresh daftar kelas setelah berhasil bergabung
            } else {
                alert(data.message); // Tampilkan pesan error dari server
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mencoba bergabung ke kelas.');
        });
    });

    // Fungsi untuk memuat ulang daftar kelas
    function loadClasses() {
    fetch('/my-classes', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        const cardsContainer = document.getElementById('cardsContainer');
        cardsContainer.innerHTML = ''; // Kosongkan container sebelum menambahkan card

        // Render setiap kelas ke dalam container
        data.kelas.forEach(kelas => {
            const newCard = document.createElement('a');
            newCard.href = `/class-page/${kelas.id}`;
            newCard.className = 'rounded-xl border border-black flex-grow';
            newCard.innerHTML = `
                <div class="max-h-fit w-full">
                    <img src="Assets/Background_Class.png" class="rounded-t-xl w-full h-24">
                </div>
                <div class="flex justify-between w-full px-4 py-2">
                    <div class="flex flex-col">
                        <p>${kelas.nama_kelas}</p>
                        <p>${kelas.nama_pelajaran}</p>
                    </div>
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"/>
                        </svg>
                    </button>
                </div>
            `;
            cardsContainer.appendChild(newCard);
        });
    })
    .catch(error => {
        console.error('Error fetching classes:', error);
    });
}
</script>



</html>
