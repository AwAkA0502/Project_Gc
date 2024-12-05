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

<body class="h-screen overflow-y-hidden flex flex-col bg-[#E0FBE2]">
    <section id="Content" class="flex h-screen">
        @include('partials.sidebar') <!-- Memanggil partial sidebar.blade.php -->

        <div class="flex flex-col w-full gap-5">
            <div id="MainContent" class="w-full h-fit flex justify-between items-center pr-10 gap-3 border-b border-black">
                <div id="TabField" class="flex justify-between px-3">
                    <div class="flex gap-3 relative">
                        <a href="{{ route('class.forum', $kelas->id) }}" 
                           class="p-3 {{ Request::is("kelas/{$kelas->id}/forum") ? 'font-bold border-b-2 border-blue-500' : 'font-medium' }}">
                            Forum
                        </a>
                        @if (isset($isTeacher) && $isTeacher)
                        <a href="{{ route('class.nilai', $kelas->id) }}" 
                           class="p-3 {{ Request::is("kelas/{$kelas->id}/nilai") ? 'font-bold border-b-2 border-blue-500' : 'font-medium' }}">
                            Nilai
                        </a>
                        @endif
                    </div>
                </div>
                <button type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    </svg>
                </button>
            </div>
            <div id="ContentField" class="w-full h-full pb-10">
                 @yield('content')
            </div>
        </div>
    </section>
</body>
<script>
    // Ambil elemen
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('nilaiModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const nilaiText = document.getElementById('nilaiText');
    const nilaiForm = document.getElementById('nilaiForm');
    const nilaiInput = document.getElementById('nilaiInput');

    // Buka modal
    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Tutup modal
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Submit nilai
    nilaiForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Mencegah reload halaman
        const nilai = nilaiInput.value;
        if (nilai >= 0 && nilai <= 100) {
            nilaiText.textContent = `${nilai}/100`;
            modal.classList.add('hidden'); // Tutup modal
            nilaiInput.value = ''; // Kosongkan input
        } else {
            alert('Masukkan nilai antara 0-100.');
        }
    });
</script>
<script>

const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('fileInput');
        const uploadedFileContainer = document.getElementById('UploadedFile');

        uploadButton.addEventListener('click', () => {
            fileInput.click();
        });

        uploadButton.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadButton.classList.add('bg-gray-200');
        });

        uploadButton.addEventListener('dragleave', () => {
            uploadButton.classList.remove('bg-gray-200');
        });

        uploadButton.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadButton.classList.remove('bg-gray-200');

            if (event.dataTransfer.files.length > 0) {
                fileInput.files = event.dataTransfer.files;
                handleFileUpload(fileInput.files);
            }
        });

        fileInput.addEventListener('change', (event) => {
            if (event.target.files.length > 0) {
                handleFileUpload(event.target.files);
            }
        });

        function handleFileUpload(files) {
            uploadedFileContainer.innerHTML = ''; // Clear the container before adding new files
            Array.from(files).forEach(file => {
                const fileDiv = document.createElement('div');
                fileDiv.classList.add('flex', 'gap-2', 'border-2', 'border-gray-300', 'rounded-lg', 'justify-between', 'items-center', 'px-3', 'py-2', 'max-h-fit');

                const fileIcon = document.createElement('svg');
                fileIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                fileIcon.setAttribute('width', '28');
                fileIcon.setAttribute('height', '28');
                fileIcon.setAttribute('viewBox', '0 0 24 24');
                fileIcon.setAttribute('fill', 'none');
                fileIcon.setAttribute('stroke', 'currentColor');
                fileIcon.setAttribute('stroke-width', '2');
                fileIcon.setAttribute('stroke-linecap', 'round');
                fileIcon.setAttribute('stroke-linejoin', 'round');
                fileIcon.classList.add('icon', 'icon-tabler', 'icons-tabler-outline', 'icon-tabler-file-upload');
                fileIcon.innerHTML = '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/><path d="M12 11v6"/><path d="M9.5 13.5l2.5 -2.5l2.5 2.5"/>';

                const fileInfo = document.createElement('div');
                fileInfo.classList.add('flex', 'flex-col', 'gap-1');
                fileInfo.innerHTML = `<p class="text-sm">${file.name}</p><p class="text-xs">${file.type || 'Unknown'}</p>`;

                const removeButton = document.createElement('button');
                removeButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>';
                removeButton.addEventListener('click', () => {
                    uploadedFileContainer.removeChild(fileDiv);
                });

                fileDiv.appendChild(fileIcon);
                fileDiv.appendChild(fileInfo);
                fileDiv.appendChild(removeButton);
                uploadedFileContainer.appendChild(fileDiv);
            });

            // TODO: Implement the actual file upload logic here.
            console.log('Files ready for upload:', files);
        }
    
    document.addEventListener('DOMContentLoaded', () => {
        const numberInput = document.getElementById('numberInput');

        numberInput.addEventListener('input', () => {
            let value = parseInt(numberInput.value, 10);

            if (isNaN(value) || value < 0) {
                numberInput.value = '';
            } else if (value > 100) {
                numberInput.value = 100;
            }
        });
    });
    
    function openModal() {
            document.getElementById('modalNewTask').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalNewTask').classList.add('hidden');
            document.getElementById('numberInput').value = ''; // Reset input value
        }

        document.getElementById('NewTask').addEventListener('click', openModal);

        document.getElementById('closeModalBtn').addEventListener('click', closeModal);
        document.getElementById('closeModalBtnBottom').addEventListener('click', closeModal);

        document.getElementById('modalNewTask').addEventListener('click', function (event) {
            if (event.target === document.getElementById('modalNewTask')) {
                closeModal();
            }
        });

    document.addEventListener('DOMContentLoaded', () => {
    const openModalBtns = document.querySelectorAll('.openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalBtnBottom = document.getElementById('closeModalBtnBottom');
    const modal = document.getElementById('modalNilai');
    const numberInput = document.getElementById('numberInput');
    let currentSpan = null;

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', (event) => {
            modal.classList.remove('hidden');
            const span = event.currentTarget.querySelector('span');
            currentSpan = span;
            numberInput.value = span.textContent === '...' ? '' : span.textContent;
        });
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    closeModalBtnBottom.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });

    numberInput.addEventListener('input', () => {
        let value = parseInt(numberInput.value, 10);
        if (isNaN(value) || value < 0) {
            numberInput.value = '';
            currentSpan.textContent = '...';
        } else if (value > 100) {
            numberInput.value = 100;
            currentSpan.textContent = '100';
        } else {
            currentSpan.textContent = value;
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const chips = document.querySelectorAll('#Chip_Field .chip');
    const contents = document.querySelectorAll('#Content_Field .content');
    const modals = document.querySelectorAll('.modal');

    chips.forEach((chip, index) => {
        chip.addEventListener('click', () => {
            // Remove active class from all chips
            chips.forEach(c => {
                c.classList.remove('bg-green-400', 'text-white');
                c.classList.add('border', 'border-black', 'text-black');
                const chipText = c.querySelector('p');
                chipText.classList.remove('text-white');
                chipText.classList.add('text-black');

                // Reset SVG color to black
                const svg = c.querySelector('svg');
                if (svg) {
                    svg.setAttribute('stroke', '#000000'); // Change stroke color to black
                }
            });

            // Add active class to the clicked chip
            chip.classList.remove('border', 'border-black', 'text-black');
            chip.classList.add('bg-green-400', 'text-white');
            const chipText = chip.querySelector('p');
            chipText.classList.remove('text-black');
            chipText.classList.add('text-white');

            // Show the corresponding content and hide others
            contents.forEach((content, contentIndex) => {
                if (index === contentIndex) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });

            // Show the corresponding modal and hide others
            modals.forEach((modal, modalIndex) => {
                if (index === modalIndex) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            });

            // Change SVG color to red when chip is active
            const svg = chip.querySelector('svg');
            if (svg) {
                svg.setAttribute('stroke', '#FFFFFF'); // Change stroke color to red
            }
        });
    });
});



    document.querySelectorAll('.text-input-container .input-field').forEach((inputField, index) => {
    inputField.addEventListener('focus', () => {
        document.querySelectorAll('.text-editor')[index].classList.remove('hidden');
        document.querySelectorAll('.text-input-container')[index].classList.add('hidden');
    });
});

function cancelPost(button) {
    const editor = button.closest('.text-editor');
    const index = Array.from(document.querySelectorAll('.text-editor')).indexOf(editor);
    document.querySelectorAll('.text-editor')[index].classList.add('hidden');
    document.querySelectorAll('.text-input-container')[index].classList.remove('hidden');
}

function postAnnouncement(button) {
    // Implement your post announcement logic here
    alert('Announcement posted');
}

function formatText(command) {
    document.execCommand(command, false, null);
}

function addGoogleDriveFile() {
    // Implement your Google Drive file addition logic here
    alert('Add Google Drive File');
}

function addYouTubeVideo() {
    // Implement your YouTube video addition logic here
    alert('Add YouTube Video');
}

function moveLine(tab) {
    var forumTab = document.getElementById("forumTab");
    var nilaiTab = document.getElementById("nilaiTab");

    if (tab === 'forum') {
        forumTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        forumTab.classList.remove("font-medium");
        nilaiTab.classList.add("font-medium");
        nilaiTab.classList.remove("font-bold", "border-b-2", "border-blue-500");
    } else if (tab === 'nilai') {
        nilaiTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        nilaiTab.classList.remove("font-medium");
        forumTab.classList.add("font-medium");
        forumTab.classList.remove("font-bold", "border-b-2", "border-blue-500");
    }
}


document.addEventListener("DOMContentLoaded", function () {
    moveLine('forum');
});


function switchTab(tab) {
    var forumTab = document.getElementById("forumTab");
    var nilaiTab = document.getElementById("nilaiTab");
    var forumContent = document.getElementById("forumContent");
    var nilaiContent = document.getElementById("nilaiContent");

    if (tab === 'forum') {
        forumTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        forumTab.classList.remove("font-medium");
        nilaiTab.classList.add("font-medium");
        nilaiTab.classList.remove("font-bold", "border-b-2", "border-blue-500");

        forumContent.classList.remove("hidden");
        nilaiContent.classList.add("hidden");
    } else if (tab === 'nilai') {
        nilaiTab.classList.add("font-bold", "border-b-2", "border-blue-500");
        nilaiTab.classList.remove("font-medium");
        forumTab.classList.add("font-medium");
        forumTab.classList.remove("font-bold", "border-b-2", "border-blue-500");

        nilaiContent.classList.remove("hidden");
        forumContent.classList.add("hidden");
    }
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modalNewTask = document.getElementById('modalNewTask');
        const newTaskButton = document.getElementById('NewTask');
        const uploadButton = modalNewTask.querySelector('.bg-blue-500.text-white.font-medium.py-4');

        // Fungsi untuk membuka modal
        const openModal = () => {
            modalNewTask.classList.remove('hidden');
        };

        // Fungsi untuk menutup modal
        const closeModal = () => {
            modalNewTask.classList.add('hidden');
        };

        // Fungsi untuk menambahkan chip baru ke UI
        const addTaskToUI = (task) => {
            const chipField = document.getElementById('Chip_Field');
            
            // Buat elemen chip baru
            const newChip = document.createElement('button');
            newChip.id = `Chip-${task.id}`;
            newChip.className = 'chip flex gap-2 justify-center items-center px-3 py-2 bg-green-400 rounded-xl';
            
            // Tambahkan konten ke chip
            newChip.innerHTML = `
                <p class="text-white font-medium">${task.judul}</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            `;

            // Tambahkan chip baru ke chip field
            chipField.appendChild(newChip);

            // Tambahkan event listener untuk close button di chip
            newChip.querySelector('svg').addEventListener('click', () => {
                newChip.remove(); // Hapus chip dari UI
            });
        };

        // Event listener untuk membuka modal
        newTaskButton.addEventListener('click', openModal);

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
<script src="/Js/Nav.js"></script>
    
</html>