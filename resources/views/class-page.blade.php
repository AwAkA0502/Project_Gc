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

<body class="bg-white h-screen overflow-y-hidden flex flex-col">
    <section id="Content" class="flex h-screen">
        <div id="Sidebar" class="flex flex-col py-2 border-r border-black px-2 gap-3" style="width: 400px;">
            <div id="Beranda" class="flex gap-4 justify-start items-center px-4 py-2 hover:bg-gray-200 rounded-xl" onclick="history.back()">
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
        <div id="MainContent" class="w-full h-full flex flex-col gap-3 pb-5 overflow-y-auto">
            <div id="TabField" class="flex justify-between border-b border-black px-3">
                <div class="flex gap-3 relative">
                    <div id="forumTab" class="p-3 font-bold border-b-2 border-blue-500 cursor-pointer"
                        onclick="switchTab('forum')">Forum</div>
                    @if ($isTeacher)
                        <div id="nilaiTab" class="p-3 font-medium cursor-pointer" onclick="switchTab('nilai')">Nilai</div>
                    @endif        
                    {{-- <div id="nilaiTab" class="p-3 font-medium cursor-pointer" onclick="switchTab('nilai')">Nilai</div> --}}
   
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
                <div id="forumContent" class="tab-content gap-3 flex flex-col px-24 pb-10">
                    <div class="w-full bg-purple-600 rounded-xl flex justify-start items-end p-6"
                        style="height: 240px; background-image: url('assets/Bg_Tropical.jpg'); background-size: cover; background-position: center;">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-4xl text-white">{{ $kelas->nama_kelas }}</h1>                        </h1>
                            <p class="text-2xl text-white">{{ $kelas->nama_pelajaran }}</p>
                        </div>
                    </div>
                    <div class="flex w-full gap-3">
                        <div id="Forum" class="flex flex-col gap-2 w-full">
                            <div class="w-full mx-auto border rounded-lg">
                                <div class="text-input-container flex justify-between items-center rounded-lg px-4 py-3 gap-3">
                                    <div class="flex justify-start items-center gap-3 w-full">
                                        <img src="https://lh3.googleusercontent.com/a/ACg8ocLEisGP6WknDfqRaVv6yJDbwyNjwAk6UIoS6zPqctlJQ6EsyFsy=s40-c"
                                            alt="Profile" class="h-12 w-12 rounded-full">
                                        <input type="text" placeholder="Umumkan sesuatu kepada kelas anda"
                                            class="w-full focus:outline-none border py-3 px-2 rounded-xl input-field">
                                    </div>
                                </div>
                                <div class="text-editor hidden bg-white border-2 rounded-lg overflow-hidden">
                                    <div class="p-4 border-b">
                                        <div class="flex items-center">
                                            <img src="https://lh3.googleusercontent.com/a/ACg8ocLEisGP6WknDfqRaVv6yJDbwyNjwAk6UIoS6zPqctlJQ6EsyFsy=s40-c"
                                                alt="Profile" class="h-12 w-12 rounded-full">
                                            <div class="ml-2 flex-grow">
                                                <div contenteditable="true"
                                                    class="bg-gray-100 p-2 rounded-md border border-gray-300 outline-none placeholder-gray-500"
                                                    placeholder="Umumkan sesuatu kepada kelas Anda"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex gap-3">
                                                <button onclick="formatText('bold')"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Tebal"><b>B</b></button>
                                                <button onclick="formatText('italic')"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Miring"><i>I</i></button>
                                                <button onclick="formatText('underline')"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Garis bawah"><u>U</u></button>
                                                <button onclick="formatText('insertUnorderedList')"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Daftar berbutir">• List</button>
                                                <button onclick="addGoogleDriveFile()"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Tambahkan file Google Drive">Drive</button>
                                                <button onclick="addYouTubeVideo()"
                                                    class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                    title="Menambahkan video YouTube">YouTube</button>
                                            </div>
                                            <div class="flex gap-3">
                                                <button onclick="cancelPost(this)"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                                                <button onclick="postAnnouncement(this)"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-md">Posting</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 border rounded-lg flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <div class="w-fit h-fit p-3 bg-blue-400 rounded-full"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                        </svg></div>
                                    <div class="flex flex-col flex-grow gap-1">
                                        <p class="text-md font-medium">Nama memposting tugas baru: Tugas 2</p>
                                        <p class="text-sm">18 Apr <span>(Diedit 18 Apr)</span></p>
                                    </div>
                                </div>
                                <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 border rounded-lg flex flex-col justify-between gap-3 items-start">
                                <div class="flex justify-between items-center w-full">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 p-3 bg-blue-400 rounded-full"></div>
                                        <div class="flex flex-col flex-grow gap-1">
                                            <p class="text-md font-medium">Nama Pengajar</p>
                                            <p class="text-sm">18 Apr <span>(Diedit 18 Apr)</span></p>
                                        </div>
                                    </div>
                                    <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        </svg>
                                    </button>
                                </div>
                                <p>Tugas 1</p>
                                <div class="flex border rounded-xl overflow-hidden">
                                    <div class="w-fit h-fit"><img src="Assets/Bg_Tropical.jpg" class=" w-28 h-20"></div>
                                    <div class="flex flex-col gap-1 justify-center items-start pl-3 pr-6">
                                        <p class="text-md font-medium">Dokumen.Pdf</p>
                                        <p class="text-sm">Word</p>
                                    </div>
                                </div>
                                <div id="Divider" class="h-0.5 w-full bg-gray-200 rounded-full"></div>
                                <div id="Commend_Field" class="w-full flex flex-col gap-6 px-4">
                                    <div id="Comment" class="flex justify-between items-center w-full">
                                        <div class="flex justify-between gap-3 items-center">
                                            <div class="w-12 h-12 p-4 bg-black rounded-full"
                                                style="background-image: url('Assets/User_Profile2.jpg'); background-size: cover; background-position: center ;">
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="flex gap-2">
                                                    <p class=" font-medium">Bedul</p>
                                                    <p class="opacity-80">11 Sep 2020</p>
                                                </div>
                                                <div>
                                                    <p>Tai Lu</p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="Comment" class="flex justify-between items-center w-full">
                                        <div class="flex justify-between gap-3 items-center">
                                            <div class="w-12 h-12 p-4 bg-black rounded-full"
                                                style="background-image: url('Assets/User_Profile.jpg'); background-size: cover; background-position: center ;">
                                            </div>
                                            <div class="flex flex-col">
                                                <div class="flex gap-2">
                                                    <p class=" font-medium">M.Adin Nugroho</p>
                                                    <p class="opacity-80">11 Sep 2020</p>
                                                </div>
                                                <div>
                                                    <p>Woi tai</p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full mx-auto">
                                    <div class="text-input-container flex justify-between items-center rounded-lg px-4 py-3 gap-3">
                                        <div class="flex justify-start items-center gap-3 w-full">
                                            <img src="https://lh3.googleusercontent.com/a/ACg8ocLEisGP6WknDfqRaVv6yJDbwyNjwAk6UIoS6zPqctlJQ6EsyFsy=s40-c"
                                                alt="Profile" class="h-12 w-12 rounded-full">
                                            <input type="text" placeholder="Umumkan sesuatu kepada kelas anda"
                                                class="w-full focus:outline-none border py-3 px-2 rounded-xl input-field">
                                        </div>
                                    </div>
                                    <div class="text-editor hidden bg-white border-2 rounded-lg overflow-hidden">
                                        <div class="p-4 border-b">
                                            <div class="flex items-center">
                                                <img src="https://lh3.googleusercontent.com/a/ACg8ocLEisGP6WknDfqRaVv6yJDbwyNjwAk6UIoS6zPqctlJQ6EsyFsy=s40-c"
                                                    alt="Profile" class="h-12 w-12 rounded-full">
                                                <div class="ml-2 flex-grow">
                                                    <div contenteditable="true"
                                                        class="bg-gray-100 p-2 rounded-md border border-gray-300 outline-none placeholder-gray-500"
                                                        placeholder="Umumkan sesuatu kepada kelas Anda"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex gap-3">
                                                    <button onclick="formatText('bold')"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Tebal"><b>B</b></button>
                                                    <button onclick="formatText('italic')"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Miring"><i>I</i></button>
                                                    <button onclick="formatText('underline')"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Garis bawah"><u>U</u></button>
                                                    <button onclick="formatText('insertUnorderedList')"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Daftar berbutir">• List</button>
                                                    <button onclick="addGoogleDriveFile()"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Tambahkan file Google Drive">Drive</button>
                                                    <button onclick="addYouTubeVideo()"
                                                        class="text-blue-500 px-3 py-2 rounded-md hover:bg-blue-100"
                                                        title="Menambahkan video YouTube">YouTube</button>
                                                </div>
                                                <div class="flex gap-3">
                                                    <button onclick="cancelPost(this)"
                                                        class="bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                                                    <button onclick="postAnnouncement(this)"
                                                        class="bg-blue-500 text-white px-4 py-2 rounded-md">Posting</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="SideContent" class="flex flex-col gap-3" style="width: 368px;">
                            <div class="w-full flex flex-col border rounded-xl p-3 gap-3">
                                <div class="flex justify-between items-center">
                                    <p>Kode Kelas</p>
                                    <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        </svg>
                                    </button>
                                </div>
                                <h1 class="text-2xl font-medium">{{ $kelas->kode_kelas }}</h1>
                            </div>
                            <div class="flex flex-col border rounded-lg max-h-fit p-2 gap-3">
                                <p class="text-lg font-medium">Daftar Tugas</p>
                                <div id="TaskList" class="flex flex-col gap-3">
                                    @forelse ($kelas->tasks as $task)
                                        <!-- Link yang mengarah ke halaman task-page -->
                                        <a href="{{ route('task_page', ['kelas' => $kelas->id, 'task' => $task->id]) }}" class="flex gap-2 justify-start items-center border p-2 rounded-lg hover:bg-gray-200">
                                            <div class="p-2 bg-blue-500 max-w-fit max-h-fit rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                </svg>
                                            </div>
                                            <div class="flex flex-col justify-start items-start gap-1">
                                                <p class="text-base font-medium">{{ $task->judul }}</p>
                                                <p class="text-sm">Deadline: <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</span></p>
                                            </div>
                                        </a>
                                    @empty
                                        <p class="text-gray-500 text-sm">Belum ada tugas untuk kelas ini.</p>
                                    @endforelse
                                </div>
                            </div>
                            <div id="People" class="flex flex-col gap-6 border rounded-xl p-3">
                                <div id="Teacher" class="flex flex-col gap-3">
                                    <div class="flex justify-between border-b pb-3">
                                        <h1 class="text-xl font-medium">Pengajar</h1>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        </svg>
                                    </div>
                                    <div id="User" class="flex justify-start items-center gap-3">
                                        <div class="h-8 w-8 bg-gray-600 rounded-full"></div>
                                        <p class="text-sm font-medium">{{ $kelas->guru->name ?? 'Guru tidak ditemukan' }}</p>
                                    </div>
                                </div>
                                <div id="Teacher" class="flex flex-col gap-3">
                                    <div class="flex justify-between border-b pb-3">
                                        <h1 class="text-xl font-medium">Siswa</h1>
                                        <div class="flex gap-3">
                                            <p class="text-md"><span>{{ $kelas->users->count() }}</span> Siswa</p>                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16v6" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        @if ($kelas->users->isEmpty())
                                            <p class="text-gray-500 text-sm">Belum ada siswa yang bergabung di kelas ini.</p>
                                        @else
                                            @foreach ($kelas->users as $user)
                                                <div id="User" class="flex justify-between items-center gap-3">
                                                    <div class="flex gap-2 justify-start items-center">
                                                        <div class="h-8 w-8 bg-gray-600 rounded-full">
                                                            @if ($user->avatar)
                                                                <img src="{{ $user->avatar }}" alt="Avatar {{ $user->name }}" class="h-8 w-8 rounded-full">
                                                            @endif
                                                        </div>
                                                        <p class="text-sm font-medium">{{ $user->name }}</p>
                                                    </div>
                                                    <button type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="nilaiContent" class="tab-content flex flex-col gap-1 hidden px-4">
                    <div id="Chip_Field" class="flex p-3 gap-3">
                        @foreach ($tasks as $task)
                        <button id="Chip-{{ $task->id }}" class="chip flex gap-2 justify-center items-center px-3 py-2 bg-green-400 rounded-xl">
                            <p class="text-white font-medium">{{ $task->judul }}</p>
                            <!-- Form untuk menghapus tugas -->
                            <form method="POST" action="{{ route('task.destroy', ['task' => $task->id]) }}" onsubmit="return confirm('Hapus tugas ini?')" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-transparent border-none p-0">
                                    <!-- Tombol X -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </button>
                        @endforeach
                    
                        @if ($isTeacher)
                            <button id="NewTask" class="flex justify-center items-center px-3 py-2 border rounded-xl gap-2 bg-blue-500 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
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
                    <div id="Content_Field" class="p-3 w-full gap-3 flex flex-col">
                        <div class="flex w-full justify-between items-end">
                            <h1 class="font-semibold text-2xl">Nama Tugas</h1>
                            <div class="flex gap-3 justify-center items-end">
                                <p class="text-md font-medium">Deadline : <span> 5 Juni 2024</span></p>
                                <p class="text-md font-medium">Submited <span>.../30</span></p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <input type="search" class="w-full px-3 py-2 border-2 border-gray-500 rounded-xl focus:border-none focus:outline-none" placeholder="Cari...">
                            <button class="flex justify-between items-center border-2 border-gray-600 px-3 py-2 rounded-lg">
                                <p>Filter</p>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                            </button>
                        </div>
                        <div id="Content_Tugas1" class="content overflow-auto border-gray-300 border-2 rounded-xl shadow-lg">
                            <table class="table-fixed w-full">
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
                                <tbody>
                                    @forelse ($submissions as $submission)
                                    <tr class="border hover:bg-gray-100">
                                        <form action="{{ route('submission.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                            
                                            <!-- Nama User -->
                                            <td>
                                                <div class="p-3 flex items-center">
                                                    <!-- Foto Profil -->
                                                    <div class="w-10 h-10 bg-black rounded-full"
                                                        style="background-image: url('{{ $submission->user->profile_picture ?? asset('Assets/User_Profile2.jpg') }}'); background-size: cover; background-position: center;">
                                                    </div>
                                                    <!-- Nama -->
                                                    <p class="ml-3">{{ $submission->user->name ?? 'Tidak diketahui' }}</p>
                                                </div>
                                            </td>
                            
                                            <!-- Tanggal Upload -->
                                            <td>{{ $submission->created_at->format('d M Y, H:i') }}</td>
                            
                                            <!-- File Upload -->
                                            <td>
                                                <a href="{{ asset('storage/' . $submission->file_url) }}" 
                                                   target="_blank" 
                                                   class="text-blue-500 underline truncate block max-w-[200px]" 
                                                   title="{{ basename($submission->file_url) }}">
                                                   {{ basename($submission->file_url) }}
                                                </a>
                                            </td>
                            
                                            <!-- Nilai -->
                                            <td>
                                                <input
                                                    type="number"
                                                    name="nilai"
                                                    class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full"
                                                    placeholder="Masukkan nilai (0-100)"
                                                    min="0"
                                                    max="100"
                                                    value="{{ $submission->nilai }}"
                                                    required
                                                />
                                            </td>
                            
                                            <!-- Komentar -->
                                            <td>
                                                <textarea
                                                    name="feedback"
                                                    class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full"
                                                    rows="4"
                                                    placeholder="Masukkan feedback di sini"
                                                    required
                                                >{{ $submission->feedback }}</textarea>
                                            </td>
                            
                                            <!-- Hidden Input untuk user_id -->
                                            <input type="hidden" name="user_id" value="{{ $submission->user->id }}">
                            
                                            <!-- Submit Button -->
                                            <td class="text-center">
                                                <button
                                                    type="submit"
                                                    class="bg-blue-500 px-5 py-2 text-white rounded-xl"
                                                >
                                                    Kirim
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3 text-gray-500">
                                            Belum ada yang mengumpulkan tugas.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div id="Content_Tugas2" class="content hidden">Content for Tugas 2</div>
                        <div id="Content_Tugas3" class="content hidden">Content for Tugas 3</div>
                        <div id="Content_Tugas4" class="content hidden">Content for Tugas 4</div>
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