@extends('layouts.class-page')

@section('title', 'Nilai Kelas')

@section('nilai-tab-class', 'font-bold')
@section('nilai-tab-border', 'border-blue-500')

@section('content')
<div id="nilaiContent" class="tab-content flex flex-col gap-1 px-4">
    <div id="Chip_Field" class="flex gap-3">
        @foreach ($tasks as $task)
        <div id="ChipContainer-{{ $task->id }}" class="chip-container justify-center items-center flex gap-2 bg-green-800 rounded-xl px-2">
            <button id="Chip-{{ $task->id }}" class="chip flex justify-center items-center px-3 py-2 rounded-xl" onclick="showTaskContent('{{ $task->id }}')">
                <p class="text-white font-medium">{{ $task->judul }}</p>
            </button>

            <!-- Tombol Delete -->
            <form method="POST" action="{{ route('task.destroy', ['task' => $task->id]) }}" onsubmit="return confirm('Hapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="border-none text-white rounded-lg hover:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>
        @endforeach
    
        @if ($isTeacher)
        <button id="NewTask" class="flex justify-center items-center px-3 py-2 border rounded-xl gap-2 bg-blue-500 text-white" onclick="createNewTask()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            <p class="font-medium">Buat Tugas</p>
        </button>
        @endif
    </div>
    
    <!-- Modal untuk membuat tugas -->
    <div id="modalNewTask" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 relative">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18"></path>
                    <path d="M6 6L18 18"></path>
                </svg>
            </button>
    
            <form method="POST" action="{{ route('task.store', ['kelas' => $kelas->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                
                <!-- Form fields -->
                <div class="flex flex-col gap-2">
                    <label for="judul">Judul</label>
                    <input name="judul" id="judul" type="text" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="deskripsi">Deskripsi</label>
                    <input name="deskripsi" id="deskripsi" type="text" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full">
                </div>
                <div class="flex flex-row gap-3">
                    <div class="flex flex-col gap-2">
                        <label for="deadline">Deadline</label>
                        <input name="deadline" id="deadline" type="date" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="waktu">Waktu</label>
                        <input name="waktu" id="waktu" type="time" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="nilai">Nilai</label>
                    <input name="nilai" id="nilai" type="number" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full" min="0" max="100">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="file">File</label>
                    <input name="file" id="file" type="file" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4">Simpan Tugas</button>
            </form>
        </div>
    </div>
    
    <div id="Content_Field" class="py-3 w-full gap-3 flex flex-col">
        {{-- <div class="flex w-full justify-between items-end">
            <h1 class="font-semibold text-2xl">{{ $task->judul }}</h1>
            <div class="flex gap-3 justify-center items-end">
                <p class="text-md font-medium">Deadline : <span>{{ $task->deadline ?? 'Tidak Ada' }}</span></p>
                <p class="text-md font-medium">Submited <span>{{ count($submissions) }}/30</span></p>
            </div>
        </div> --}}
        <div class="flex justify-between items-center gap-3">
            <input type="search" class="w-full px-3 py-2 border-2 border-gray-500 rounded-xl focus:border-none focus:outline-none" placeholder="Cari...">
            <button class="flex justify-between items-center border-2 border-gray-600 px-3 py-2 rounded-lg">
                <p>Filter</p>
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
            </button>
        </div>
        <!-- Include komponen task-content -->
        <div id="Content_Tugas" class="content overflow-auto border-gray-300 border-2 rounded-xl shadow-lg">
            <table id="submissionTable" class="table-fixed w-full">
                <thead class="text-left bg-gray-200">
                    <tr>
                        <th class="py-3 px-3">Nama User</th>
                        <th class="py-3">Tanggal Upload</th>
                        <th class="py-3">File Upload</th>
                        <th class="py-3">Nilai</th>
                        <th class="py-3">Komentar</th>
                        <th class="py-3"></th>
                    </tr>
                </thead>
                <tbody id="submissionTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
    </div>
    <div id="nilaiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Input Nilai</h2>
            <form id="nilaiForm">
                <input
                    type="number"
                    id="nilaiInput"
                    class="w-full p-2 border border-gray-300 rounded-lg mb-4"
                    placeholder="Masukkan nilai (0-100)"
                    min="0"
                    max="100"
                    required
                />
                <div class="flex justify-end">
                    <button
                        type="button"
                        id="closeModalBtn"
                        class="bg-gray-300 py-2 px-4 rounded-lg mr-2"
                    >Batal</button>
                    <button
                        type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg"
                    >Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
</div>
<script>
    window.onload = function() {
        // Mengambil ID dari tugas pertama dalam daftar (tugas terbaru)
        const lastTaskId = {{ $tasks->first()->id ?? 'null' }};
        if (lastTaskId) {
            showTaskContent(lastTaskId);
        }
    };
</script>
<script>
    // Ambil data submission untuk setiap task
    const submissionsData = @json($tasks->mapWithKeys(function ($task) {
        return [$task->id => $task->submissions];
    }));
    
    function showTaskContent(taskId) {
        // Hapus warna aktif dari semua ChipContainer
        document.querySelectorAll('.chip-container').forEach(container => {
            container.classList.remove('bg-blue-500'); // Warna aktif
            container.classList.add('bg-green-800'); // Warna default
        });

        // Tambahkan warna aktif pada ChipContainer yang dipilih
        const selectedContainer = document.getElementById(`ChipContainer-${taskId}`);
        selectedContainer.classList.remove('bg-green-800'); // Hilangkan warna default
        selectedContainer.classList.add('bg-blue-500'); // Tambahkan warna aktif

        // Memperbarui konten tabel dengan data submission tugas yang dipilih
        const submissions = submissionsData[taskId];
        const tableBody = document.getElementById('submissionTableBody');
        
        // Clear existing table content
        tableBody.innerHTML = '';

        // Generate new rows
        if (submissions && submissions.length > 0) {
            submissions.forEach(submission => {
                const row = document.createElement('tr');
                row.classList.add('border', 'hover:bg-gray-100');
                
                row.innerHTML = `
                    <td>
                        <div class="p-3 flex items-center">
                            <div class="w-10 h-10 bg-black rounded-full"
                                style="background-image: url('${submission.user.profile_picture}'); 
                                        background-size: cover; 
                                        background-position: center;">
                            </div>
                            <p class="ml-3">${submission.user.name}</p>
                        </div>
                    </td>



                    <td>${new Date(submission.created_at).toLocaleString()}</td>
                    <td>
                        <a href="/storage/${submission.file_url}" 
                           target="_blank" 
                           class="text-blue-500 underline truncate block max-w-[200px]" 
                           title="${submission.file_url.split('/').pop()}">
                           ${submission.file_url.split('/').pop()}
                        </a>
                    </td>
                    <td>
                        <input type="number" name="nilai" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full" placeholder="Masukkan nilai (0-100)" min="0" max="100" value="${submission.nilai ?? ''}" required />
                    </td>
                    <td>
                        <textarea name="feedback" class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full" rows="4" placeholder="Masukkan feedback di sini" required>${submission.feedback ?? ''}</textarea>
                    </td>
                    <td class="text-center">
                        <form action="/submission/${submission.id}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-blue-500 px-5 py-2 text-white rounded-xl">Kirim</button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            // Show no data message
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-3 text-gray-500">
                        Belum ada yang mengumpulkan tugas.
                    </td>
                </tr>
            `;
        }
    }
</script>

@endsection

