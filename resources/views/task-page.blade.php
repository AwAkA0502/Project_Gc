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
        @include('partials.sidebar') <!-- Memanggil partial sidebar.blade.php -->
        <div id="Content" class="flex justify-center items-start p-10 w-full gap-5">
            <div class="flex flex-col w-full gap-3">
                <div class="flex justify-between border-b pb-3">
                    <div class="flex gap-3">
                        <div class="flex h-10 p-2 bg-blue-500 rounded-lg">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xl font-medium">{{ $task->judul }}</h1>
                            <p>
                                {{ $kelas->guru->name }} • 
                                <span>{{ \Carbon\Carbon::parse($task->created_at)->format('d M Y H:i') }}</span>
                                <p>{{ $task->nilai }} Poin</p>
                        </div>
                    </div>
                    <div class="flex justify-end items-end">
                        <p>Deadline : <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d M, H:i') }}</span></p>                    </div>
                </div>
                <div class="max-h-fit">
                    <p id="Note" class="pb-3">
                        {{ $task->deskripsi }} <!-- Menampilkan deskripsi tugas yang diambil dari database -->
                        @if($task->file_path)
                            <div class="flex gap-2 justify-between items-center border p-2 pr-8 rounded-lg mt-3" style="width: fit-content;">
                                <a href="{{ asset('storage/' . $task->file_path) }}" download="{{ basename($task->file_path) }}" class="flex gap-4 justify-between items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    </svg>
                                    <div class="flex flex-col gap-1">
                                        <p class="text-base font-medium">{{ basename($task->file_path) }}</p>
                                        <p class="text-sm">{{ strtoupper(pathinfo($task->file_path, PATHINFO_EXTENSION)) }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-5 border rounded-lg p-2" style="width : 400px;">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-medium">Tugas</p>
                    <p class="{{ $task->is_submitted ? 'text-gray-500' : 'text-red-500' }}">
                        {{ $task->is_submitted ? 'Diserahkan' : 'Belum Diserahkan' }}
                    </p>                
                </div>
                <div class="flex gap-2 justify-between items-center border p-2 rounded-lg">
                    <div class="flex gap-4 justify-between items-center">
                        <!-- Ikon File -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        </svg>
                    
                        <div class="flex flex-col gap-2">
                            <!-- Nama File -->
                            <p id="file-name" class="text-base font-medium" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 150px;">
                                No file chosen
                            </p>
                        </div>
                    </div>
                    
                    <!-- Tombol untuk Menghapus -->
                    <button id="remove-file" class="bg-transparent border-none p-0 hidden" onclick="removeFile()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Input File -->
                <input type="file" id="file-upload" class="hidden" onchange="displayFileName(event)"/>
                
                <label for="file-upload" class="border flex rounded-lg py-2 justify-center items-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    <p class="text-base font-medium">Upload Tugas</p>
                </label>

                <button class="border flex rounded-lg py-2 justify-center items-center">
                    <p class="text-base font-medium">Serahkan</p>
                </button>

                <script>
                    // Menampilkan nama file yang dipilih
                    function displayFileName(event) {
                        const fileInput = event.target;
                        const fileName = fileInput.files[0] ? fileInput.files[0].name : 'No file chosen';
                        
                        // Tampilkan nama file di elemen <p>
                        document.getElementById('file-name').textContent = fileName;

                        // Tampilkan tombol untuk menghapus file jika ada file yang dipilih
                        document.getElementById('remove-file').style.display = fileInput.files[0] ? 'block' : 'none';
                    }

                    // Menghapus file yang dipilih
                    function removeFile() {
                        const fileInput = document.getElementById('file-upload');
                        fileInput.value = ''; // Reset nilai input file
                        
                        // Update tampilan nama file
                        document.getElementById('file-name').textContent = 'No file chosen';

                        // Sembunyikan tombol hapus setelah file dihapus
                        document.getElementById('remove-file').style.display = 'none';
                    }
                </script>
                
                <input id="file-upload" type="file" class="hidden" />
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
