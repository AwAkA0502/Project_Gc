<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>File Upload</title>
</head>

<body class="h-screen w-full max-w-max  flex flex-col bg-[#E0FBE2]">
    <section id="Content" class="flex h-screen">
        @include('partials.sidebar') <!-- Memanggil partial sidebar.blade.php -->

        <div class="flex flex-col w-full gap-5 p-5">
            <div class="flex justify-between items-center">
                <h1 class="font-bold" style="color: #064420; font-size: 32px;">
                    Hello {{ Auth::user()->name ?? 'Guest' }}
                </h1>
                <div class="flex gap-4 justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="25"  height="25"  viewBox="0 0 24 24"  fill="#618264"  class="icon icon-tabler icons-tabler-filled icon-tabler-bell"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" /><path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" /></svg>
                    <div class="rounded-full bg-black" style="width: 40px; height: 40px; background-color: #89B88D;"> </div>
                </div>
            </div>
            <div class="flex flex-col">
            <div id="MainContent" class="flex gap-3 px-10">
                <div id="TabField" class="flex gap-3 px-10">
                    <div class="flex gap-3 relative">
                        <!-- Tab Forum -->
                        <a href="{{ route('class.forum', $kelas->id) }}" 
                            class="p-3 px-5 text-base cursor-pointer rounded-t-xl transition-all duration-200 
                            {{ Request::is("kelas/class-page/{$kelas->id}/forum") ? 'bg-[#618264] text-white font-bold' : 'bg-transparent text-[#618264] font-medium border-transparent' }}">
                            Forum
                        </a>
                        
                        <!-- Tab Nilai (Hanya untuk Guru) -->
                        @if (isset($isTeacher) && $isTeacher)
                        <a href="{{ route('class.nilai', $kelas->id) }}" 
                            class="p-3 px-5 text-base cursor-pointer rounded-t-xl transition-all duration-200 
                            {{ Request::is("kelas/class-page/{$kelas->id}/nilai") ? 'bg-[#618264] text-white font-bold' : 'bg-transparent text-[#618264] font-medium border-transparent' }}">
                            Nilai Tugas
                        </a>
                        @endif
                    </div>
                </div>
                </div>
                <div id="ContentField" class="flex flex-col w-full h-full border border-[#618264] rounded-[20px] gap-5 p-10 max-w-full overflow-hidden">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const modalNewTask = document.getElementById('modalNewTask');
    const newTaskButton = document.getElementById('NewTask');
    const closeModalBtns = document.querySelectorAll('#closeModalBtn, #closeModalBtnBottom'); // Semua tombol close
    const uploadButton = modalNewTask.querySelector('.uploadTaskButton');

    // Fungsi untuk membuka modal
    const openModal = () => {
        modalNewTask.classList.remove('hidden');
    };

    // Fungsi untuk menutup modal
    const closeModal = () => {
        modalNewTask.classList.add('hidden');
        resetModalInputs(); // Reset input pada modal saat ditutup
    };

    // Fungsi untuk mereset input modal
    const resetModalInputs = () => {
        document.getElementById('TitleInput').value = '';
        document.getElementById('DescInput').value = '';
        document.getElementById('DeadLineInput').value = '';
        document.getElementById('TimeInput').value = '';
        document.getElementById('ValueInput').value = '';
    };

    // Event listener untuk membuka modal
    newTaskButton.addEventListener('click', openModal);

    // Event listener untuk menutup modal
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    // Event listener untuk menutup modal jika klik di luar modal
    modalNewTask.addEventListener('click', (e) => {
        if (e.target === modalNewTask) {
            closeModal();
        }
    });

    // Event listener untuk tombol upload tugas
    uploadButton.addEventListener('click', () => {
        const title = document.getElementById('TitleInput').value;
        const description = document.getElementById('DescInput').value;
        const deadline = document.getElementById('DeadLineInput').value;
        const time = document.getElementById('TimeInput').value;
        const value = document.getElementById('ValueInput').value;
        const kelasId = 7; // Ganti dengan ID kelas yang dinamis

        // Validasi input
        if (!title || !description || !deadline || !time || !value) {
            alert('Semua field wajib diisi!');
            return;
        }

        // Kirim data ke backend
        fetch('/add-task', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                judul: title,
                deskripsi: description,
                deadline: deadline,
                time: time,
                nilai: value,
                kelas_id: kelasId,
            }),
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        throw new Error(err.message || 'Terjadi kesalahan.');
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data.message === 'Task successfully created') {
                    alert('Tugas berhasil dibuat!');
                    closeModal(); // Tutup modal
                    addTaskToUI(data.task); // Tambahkan tugas ke UI
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
    });
});
</script>

    
</html>