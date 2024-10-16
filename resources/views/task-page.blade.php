<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white flex flex-col">
    <div id="navContainer"></div>
    <div class="flex">
        <div id="Sidebar" class="flex flex-col py-2 border-r border-black px-2 gap-3" style="width: 400px;">
            <div id="Beranda" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl" onclick="window.location.href='index'">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
                <p class="font-medium">Beranda</p>
            </div>
            <div id="Study" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                </svg>
                <p class="font-medium">Mengajar</p>
            </div>
            <div id="Course" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-folders">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                    <path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" />
                </svg>
                <p class="font-medium">My Course</p>
            </div>
            <div id="class" class="flex gap-4 justify-start items-center px-4 py-2 bg-gray-300 rounded-xl">
                <img src="" class="w-7 h-7 bg-gray-700 rounded-full">
                <div class="flex flex-col gap-1">
                    <p class="font-medium text-sm">Matematika Lanjut</p>
                    <p class="text-sm">My Course</p>
                </div>
            </div>
            <div id="Setting" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                </svg>
                <p class="font-medium">Settings</p>
            </div>
        </div>
        <div id="Content" class="flex justify-center items-start p-10 w-full gap-5">
            <div class="flex flex-col w-full gap-3">
                <div class="flex justify-between border-b pb-3">
                    <div class="flex gap-3">
                        <div class="flex h-10 p-2 bg-blue-500 rounded-lg">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xl font-medium">Tugas 2</h1>
                            <p>Nama Pengajar • <span>19.57</span></p>
                            <p>100 Poin</p>
                        </div>
                    </div>
                    <div class="flex justify-end items-end">
                        <p>Deadline :  <span>2 Mei, 20.00</span></p>
                    </div>
                </div>
                <div class="max-h-fit">
                    <p id="Note" class="border-b pb-3">Assalamualaikum wr wb dan selamat pagi anak - anak!
                        Setelah kemarin kalian mempelajari video pembelajaran yang ibu berikan, mengikuti pembelajaran secara virtual, berikut ibu berikan ringkasan materi Limit Fungsi, contoh soal dan pembahasannya. Silahkan di pelajari dan tuliskan nama kalian sesuai daftar absensi di kolom komentar sebagai absensi pembelajaran hari ini paling lambat Hari selasa, tanggal 17 Agustus 2021 jam 12.00 WIB.</p>
                </div>
            </div>
            <div class="flex flex-col gap-5 border rounded-lg p-2" style="width : 400px;">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium">Tugas</p>
                    <p>Diserahkan</p>
                </div>
                <div class="flex gap-2 justify-between items-center border p-2 rounded-lg">
                    <div class="flex gap-4 justify-between items-center">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                        <div class="flex flex-col gap-2">
                            <p class="text-base font-medium">Dokumen.pdf</p>
                            <p class="text-sm">Word</p>
                        </div>
                    </div>
                    <button>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                    </button>
                </div>
                <button class="border flex rounded-lg py-2 justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    <p class="text-base font-medium">Upload Tugas</p>
                </button>
                <button class="border flex rounded-lg py-2 justify-center items-center">
                    <p class="text-base font-medium">Batalkan Pengiriman</p>
                </button>
            </div>
        </div>
    </div>
</body>
<script>
    
</script>
<script src="Js/Nav.js"></script>
