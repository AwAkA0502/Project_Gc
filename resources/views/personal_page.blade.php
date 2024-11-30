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
<body class="h-screen flex flex-col" style="background-color: #E0FBE2;">
	<div>
		<h3><a th:href="@{/List_users}"></a></h3> 
		<h3><a th:href="@{/register}"></a></h3>
		<h3><a th:href="@{/Login}"></a></h3>
	</div>
    <section id="Content" class="flex gap-3">
                @include('partials.sidebar') <!-- Memanggil partial sidebar.blade.php -->

        <div id="MainContent" class="w-full flex flex-col gap-3 p-4">
            <div class="flex justify-between justify-center items-center">
                <h1 class="font-bold" style="color: #064420; font-size: 32px;">Hello Nama</h1>
                <div class="flex gap-4 justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="25"  height="25"  viewBox="0 0 24 24"  fill="#618264"  class="icon icon-tabler icons-tabler-filled icon-tabler-bell"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" /><path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" /></svg>
                    <div class="rounded-full bg-black" style="width: 40px; height: 40px; background-color: #89B88D;"> </div>
                </div>
            </div>
            <div id="Timeline" class="flex flex-col gap-3 pl-5 pt-3 pb-5 rounded-2xl" style="background-color : #89B88D;">
                <p class="text-xl font-semibold text-white">Timeline</p>
                <p class="text-base font-regular text-white">Cek rentang waktu dan deadline penting dalam pelaksanaan tugas ini.</p>
                <div class="w-fit gap-3 flex justify-start items-center overflow-x-auto" id="tasksContainer">
                    @forelse ($tasks as $task)
                        <div class="flex flex-col gap-2 p-3 bg-green-400 rounded-xl flex-grow w-fit">
                            <p class="font-medium w-fit">{{ \Carbon\Carbon::parse($task->deadline)->format('l, d F Y') }}</p>
                            <div class="flex gap-2 w-fit justify-start items-center">
                                <img src="{{ asset('path-to-default-image.png') }}" class="w-10 h-10 bg-white rounded-full" alt="Class Icon">
                                <div class="flex flex-col gap-1 w-fit">
                                    <p class="font-medium">{{ $task->kelas->nama_kelas }}</p>
                                    <p class="font-medium">{{ $task->judul }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada tugas untuk kelas yang Anda ikuti.</p>
                    @endforelse
                </div>
            </div>
            
            <div id="Course" class="w-full flex flex-col gap-3 px-5 pt-3 pb-5 rounded-2xl"style="background-color : #89B88D;">
                <p class="text-xl font-semibold text-white">Course Overview</p>
                <div id="cardsContainer" class="mt-4 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <div id="card" class="flex flex-col gap-3 pl-3 pr-2 pt-2 pb-3 rounded-xl" style="background-color: #D0E7D2;">
                        <div class="flex px-1 py-2 justify-between border-b" style="border-color: #618264;">
                            <div class="flex gap-3">
                                <div class="rounded-full" style="background-color: #618264; width: 35px; height: 35px;"> </div>
                                <p class="font-semibold" style="font-size: 14px; color: #064420;">Nama Dosen</p>
                            </div>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#618264"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </div>
                        <div class="flex flex-col gap-3">
                            <p class="font-medium" style="color: #064420; font-size: 12px;">Nama Kelas</p>
                            <p class="font-regular" style="color: #064420; font-size: 12px;">Nama Mata Pelajaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="SubContent" class="w-54 flex flex-col gap-5 p-5">
            <div class="w-full flex flex-col gap-5 rounded-xl p-3" style="background-color: #89B88D;">
                <p class="text-xl font-semibold text-white">Buat Kelas</p>
                <button id="buatKelasBtn" class="p-3 rounded-lg font-semibold" style="background-color: #B0D9B1; color: #506C50;">
                    Buat
                </button>
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
                    <div class="flex justify-between items-center gap-2">
                        <button id="closeModalBtn" class="p-2 bg-red-500 text-white rounded-lg font-medium">
                            Tutup
                        </button>
                        <button id="buatKelasModalBtn" class="p-2 bg-blue-500 text-white rounded-lg font-medium">
                            Buat
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col gap-5 rounded-xl p-3" style="background-color: #89B88D;">
                <p class="text-xl font-semibold text-white">Masukkan kode kelas yang diberikan oleh guru Anda di bawah ini.</p>
                <input type="text" id="classCodeInput" placeholder="Kode Kelas" class="w-full p-3 rounded-xl text-white-80 border" style="background-color: #779578; border-color: #618264;">
                <button id="joinClassBtn" class="w-full p-3 rounded-xl font-semibold" style="background-color: #B0D9B1; color: #506C50;">
                    Gabung Kelas
                </button>
            </div>
            
            <div class="w-full flex flex-col gap-3 rounded-xl p-3" style="background-color: #89B88D;">
                <p class="text-xl font-semibold text-white">Calendar</p>
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
    document.addEventListener("DOMContentLoaded", () => {
    const buatKelasBtn = document.getElementById("buatKelasBtn");
    const modalMakeClass = document.getElementById("modalMakeClass");
    const buatKelasModalBtn = document.getElementById("buatKelasModalBtn");
    const cardsContainer = document.getElementById("cardsContainer");

    // Tombol untuk menutup modal
    const closeModalBtn = document.createElement("button");
    closeModalBtn.id = "closeModalBtn";
    closeModalBtn.className = "p-2 bg-red-500 text-white rounded-lg font-medium mt-4";
    closeModalBtn.innerText = "Tutup";

    if (!document.getElementById("closeModalBtn")) {
        modalMakeClass.querySelector(".bg-white").appendChild(closeModalBtn);
    }

    // Tampilkan modal
    buatKelasBtn.addEventListener("click", () => {
        modalMakeClass.classList.remove("hidden");
    });

    // Sembunyikan modal
    closeModalBtn.addEventListener("click", () => {
        modalMakeClass.classList.add("hidden");
    });

    // Tutup modal jika klik di luar area modal
    window.addEventListener("click", (event) => {
        if (event.target === modalMakeClass) {
            modalMakeClass.classList.add("hidden");
        }
    });

    // Fungsi untuk memuat daftar kelas
    function loadClasses() {
        fetch("/my-classes", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                cardsContainer.innerHTML = ""; // Bersihkan card container

                data.kelas.forEach((kelas) => {
                    const newCard = document.createElement("a");
                    newCard.href = `/class-page/${kelas.id}`; // Mengarahkan ke halaman kelas berdasarkan ID
                    newCard.className = "flex flex-col gap-3 pl-3 pr-2 pt-2 pb-3 rounded-xl";
                    newCard.style.backgroundColor = "#D0E7D2";
                    newCard.innerHTML = `
                        <div class="flex px-1 py-2 justify-between border-b" style="border-color: #618264;">
                            <div class="flex gap-3">
                                <div class="rounded-full" style="background-color: #618264; width: 35px; height: 35px;"></div>
                                <p class="font-semibold" style="font-size: 14px; color: #064420;">
                                    ${kelas.guru?.name || "Dosen Tidak Diketahui"}
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#618264" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </div>
                        <div class="flex flex-col gap-3">
                            <p class="font-medium" style="color: #064420; font-size: 12px;">${kelas.nama_kelas}</p>
                            <p class="font-regular" style="color: #064420; font-size: 12px;">${kelas.nama_pelajaran}</p>
                        </div>
                    `;
                    cardsContainer.appendChild(newCard);
                });
            })
            .catch((error) => console.error("Error fetching classes:", error));
    }

    // Fungsi untuk membuat kelas baru
    buatKelasModalBtn.addEventListener("click", function () {
        const nameInput = document.getElementById("nameInput").value;
        const subjectInput = document.getElementById("subjectInput").value;

        if (!nameInput.trim() || !subjectInput.trim()) {
            alert("Nama kelas dan pelajaran tidak boleh kosong!");
            return;
        }

        fetch("/create-class", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                nama_kelas: nameInput,
                nama_pelajaran: subjectInput,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message === "Kelas berhasil dibuat") {
                    const newCard = document.createElement("a");
                    newCard.href = `/class-page/${data.kelas.id}`;
                    newCard.className = "flex flex-col gap-3 pl-3 pr-2 pt-2 pb-3 rounded-xl";
                    newCard.style.backgroundColor = "#D0E7D2";
                    newCard.innerHTML = `
                        <div class="flex px-1 py-2 justify-between border-b" style="border-color: #618264;">
                            <div class="flex gap-3">
                                <div class="rounded-full" style="background-color: #618264; width: 35px; height: 35px;"></div>
                                <p class="font-semibold" style="font-size: 14px; color: #064420;">
                                    ${data.kelas.guru?.name || "Dosen Tidak Diketahui"}
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#618264" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </div>
                        <div class="flex flex-col gap-3">
                            <p class="font-medium" style="color: #064420; font-size: 12px;">${data.kelas.nama_kelas}</p>
                            <p class="font-regular" style="color: #064420; font-size: 12px;">${data.kelas.nama_pelajaran}</p>
                        </div>
                    `;
                    cardsContainer.appendChild(newCard);

                    modalMakeClass.classList.add("hidden");
                    document.getElementById("nameInput").value = "";
                    document.getElementById("subjectInput").value = "";
                } else {
                    alert("Terjadi kesalahan: " + data.message);
                }
            })
            .catch((error) => console.error("Error:", error));
    });

    loadClasses(); // Memuat kelas saat halaman dimuat
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // URL API untuk mengambil data tugas
        const tasksApiUrl = '/api/tasks';

        // Kontainer tempat tugas akan ditampilkan
        const tasksContainer = document.getElementById('tasksContainer');

        // Fungsi untuk memuat tugas dari server
        function loadTasks() {
            fetch(tasksApiUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    tasksContainer.innerHTML = ''; // Kosongkan kontainer sebelum menambahkan tugas baru

                    if (data.tasks.length > 0) {
                        data.tasks.forEach(task => {
                            const taskCard = `
                                <div class="flex flex-col gap-2 p-3 bg-green-400 rounded-xl flex-grow w-fit">
                                    <p class="font-medium w-fit">
                                        ${new Date(task.deadline).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                                    </p>
                                    <div class="flex gap-2 w-fit justify-start items-center">
                                        <img src="/path-to-default-image.png" class="w-10 h-10 bg-white rounded-full" alt="Class Icon">
                                        <div class="flex flex-col gap-1 w-fit">
                                            <p class="font-medium">${task.kelas.nama_kelas}</p>
                                            <p class="font-medium">${task.judul}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            tasksContainer.innerHTML += taskCard;
                        });
                    } else {
                        tasksContainer.innerHTML = `<p class="text-gray-500">Belum ada tugas untuk kelas yang Anda ikuti.</p>`;
                    }
                })
                .catch(error => console.error('Error fetching tasks:', error));
        }

        // Panggil fungsi untuk memuat tugas
        loadTasks();
    });
</script>


</html>
