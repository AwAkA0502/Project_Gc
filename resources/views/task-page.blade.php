<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>File Upload</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="flex flex-col h-screen" style="background-color: #E0FBE2">
    <div id="navContainer"></div>
    <div class="flex h-screen">
        @include('partials.sidebar') <!-- Memanggil partial sidebar.blade.php -->
        <div id="Content" class="flex justify-center items-start p-10 w-full gap-5">
            <div class="flex flex-col w-full gap-3">
                <div class="flex justify-between border-b p-5 rounded-xl text-white" style="background-color: #89B88D">
                    <div class="flex gap-3 justify-center items-center">
                        <div class="flex h-10 p-2 rounded-lg bg-opacity-2" style="background-color: rgba(64, 64, 64, 0.5);">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="text-2xl font-medium">{{ $task->judul }}</h1>
                            <p class="opacity-60">
                                {{ $kelas->guru->name }} • 
                                <span>{{ \Carbon\Carbon::parse($task->created_at)->format('d M Y H:i') }}</span>
                                {{-- <p>{{ $task->nilai }} Poin</p> --}}
                        </div>
                    </div>
                    <div class="flex justify-end items-end">
                        <p>Deadline : <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d M, H:i') }}</span></p>                    </div>
                </div>
                <div class="max-h-fit">
                    <p id="Note" class="pb-3">
                        {{ $task->deskripsi }} <!-- Menampilkan deskripsi tugas yang diambil dari database -->
                        @if($task->file_path)
                            <div class="flex text-white gap-2 justify-between items-center border p-2 pr-8 rounded-lg mt-3" style="width: fit-content; background-color : #89B88D">
                                <a href="{{ asset('storage/uploads/tugas/' . $task->file_path) }}" 
                                    download="{{ basename($task->file_path) }}" 
                                    class="flex gap-4 justify-between items-center">
                                     <!-- Ikon File -->
                                     <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                         <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                         <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                     </svg>
                                     <!-- Detail File -->
                                     <div class="flex flex-col gap-1">
                                         <!-- Nama File -->
                                         <p class="text-base font-medium truncate" style="max-width: 200px;" title="{{ basename($task->file_path) }}">
                                             {{ basename($task->file_path) }}
                                         </p>
                                         <!-- Jenis File -->
                                         <p class="text-sm">
                                             {{ strtoupper(pathinfo($task->file_path, PATHINFO_EXTENSION)) }}
                                         </p>
                                     </div>
                                 </a>
                            </div>
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col gap-4 w-full" style="max-width: 350px;">
                <!-- Header -->
                 <div class="flex gap-5">
                    <div class="flex flex-col gap-3 p-2 justify-center items-center rounded-lg  w-full" style="background-color: #89B88D;">
                        <p class="text-xl font-semibold text-white">Nilai</p>
                        <p class="font-medium text-[#064420] text-xl">0/100</p>
                    </div>
                    <div class="flex flex-col gap-3 p-2 justify-center items-center rounded-lg w-full" style="background-color: #89B88D ">
                        <p class="text-xl font-semibold text-white">Status</p>
                        <p class="text-base font-medium" 
                            style="color: {{ $submission ? '#4EFF98' : '#FF4E4E' }};">
                            {{ $submission ? 'Diserahkan' : 'Belum Diserahkan' }}
                        </p>
                    </div>
                 </div>
                <div class="flex flex-col gap-6 px-3 py-5 justify-center items-center rounded-xl" style="background-color: #89B88D;">
                    <h2 class="text-xl font-semibold text-white">Tugas : {{ $task->judul }}</h2>                
                    @if ($submission)
                    <!-- Jika sudah mengirimkan -->
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <a href="{{ asset('storage/' . $submission->file_url) }}" target="_blank" class="text-blue-500 underline hover:text-blue-700 truncate max-w-xs" title="{{ basename($submission->file_url) }}">
                                {{ basename($submission->file_url) }}
                            </a>
                        </div>
                        <form action="{{ route('submission.destroy', ['id' => $submission->id]) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white font-semibold py-3 rounded-lg hover:bg-red-700 transition">
                                Batalkan Pengiriman
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <!-- Jika belum mengirimkan -->
                <div class="flex flex-col gap-3 w-full">
                    <form action="{{ route('submission.store', ['kelas' => $kelas->id, 'task' => $task->id]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                        @csrf
                        <!-- Tampilan File yang Dipilih -->
                        <div class="w-full flex gap-2 justify-start items-center border p-2 pr-8 rounded-lg mt-3" style=" background-color:#E2FFE4">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                            <div class="flex flex-col gap-1">
                                <p class="text-base font-medium" id="file-name">No file chosen</p> <!-- Nama file -->
                                <p class="text-sm" id="file-type">Jenis File: </p> <!-- Jenis file -->
                            </div>
                        </div>
                
                        <!-- Input File (Tersembunyi) -->
                        <input type="file" id="file-upload" name="file" class="hidden" onchange="displayFileName(event)" />
                
                        <!-- Tombol Pilih File -->
                        <button type="button" class="w-full px-4 flex justify-center items-center gap-2 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition" style="background-color: #B0D9B1" onclick="document.getElementById('file-upload').click();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#506C51" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <p style="color: #506C51">Pilih File</p>
                        </button>
                
                        <!-- Tombol Kumpulkan -->
                        <button type="submit" class="flex justify-center items-center gap-2 w-full bg-blue-500 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition" style="background-color: #B0D9B1">
                            <p style="color: #506C51">Kumpulkan</p>
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <script>
                // Menampilkan nama file dan jenis file yang dipilih
                function displayFileName(event) {
                    const fileInput = event.target;
                    const file = fileInput.files[0];
            
                    if (file) {
                        // Menampilkan nama file
                        document.getElementById('file-name').textContent = file.name;
            
                        // Menampilkan jenis file
                        const fileType = file.type.split('/')[1];  // Mengambil ekstensi file (misalnya: pdf, jpeg)
                        document.getElementById('file-type').textContent = `Jenis File: ${fileType.toUpperCase()}`;
                    } else {
                        document.getElementById('file-name').textContent = 'No file chosen';
                        document.getElementById('file-type').textContent = 'Jenis File: ';
                    }
                }
            
                // Menghapus file yang dipilih
                function removeFile() {
                    const fileInput = document.getElementById('file-upload');
                    fileInput.value = ''; // Reset nilai input file
            
                    // Update tampilan nama file dan jenis file
                    document.getElementById('file-name').textContent = 'No file chosen';
                    document.getElementById('file-type').textContent = 'Jenis File: ';
                }
            </script>
        </div>
    </div>
</body>
<script>
    
</script>
<script src="Js/Nav.js"></script>
