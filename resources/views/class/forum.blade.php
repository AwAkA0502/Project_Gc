@extends('layouts.class-page')

@section('title', 'Forum')

@section('forum-tab-class', 'font-bold')
@section('forum-tab-border', 'border-blue-500')

@section('content')
<div id="forumContent" class="tab-content gap-5 flex p-5 w-full">
    <div class="flex flex-col gap-10 w-full">
        <div class="w-full bg-[#89B88D] rounded-xl flex justify-start items-center px-6"
            style="height: 240px; background-image: url('assets/Bg_Tropical.jpg'); background-size: cover; background-position: center;">
            <div class="flex flex-col">
                <h1 class="font-bold text-4xl text-white">{{ $kelas->nama_kelas }}</h1>                   
                <p class="text-2xl text-white">{{ $kelas->nama_pelajaran }}</p>
            </div>
        </div>
        <div class="flex w-full gap-3">
            <div id="Forum" class="flex flex-col gap-4 w-full">
                <div class="w-full mx-auto rounded-lg border border-[#618264]">
                    <div class="text-input-container flex justify-between items-center rounded-lg px-4 py-3 gap-3">
                        <div class="flex justify-start items-center gap-3 w-full">
                            <img src="https://lh3.googleusercontent.com/a/ACg8ocLEisGP6WknDfqRaVv6yJDbwyNjwAk6UIoS6zPqctlJQ6EsyFsy=s40-c"
                                alt="Profile" class="h-12 w-12 rounded-full">
                            <input type="text" placeholder="Umumkan sesuatu kepada kelas anda"
                                class="w-full focus:outline-none border py-3 px-2 rounded-xl input-field bg-[#618264] placeholder:text-white/70">
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
                <div class="p-4 border border-[#618264] rounded-lg flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-fit h-fit p-3 bg-[#618264] rounded-full"><svg
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
                            viewBox="0 0 24 24" fill="none" stroke="#064420" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 border border-[#618264] rounded-lg flex flex-col justify-between gap-3 items-start">
                    <div class="flex justify-between items-center w-full">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 p-3 bg-[#819B83] opacity-40 rounded-full"></div>
                            <div class="flex flex-col flex-grow gap-1">
                                <p class="text-md font-medium text-[#064420]">Nama Pengajar</p>
                                <p class="text-sm text-[#064420]">18 Apr <span>(Diedit 18 Apr)</span></p>
                            </div>
                        </div>
                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#064420" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-[#064420] font-medium">Tugas 1</p>
                    <div class="flex border border-[#618264] rounded-xl overflow-hidden">
                        <div class="w-fit h-fit"><img src="Assets/Bg_Tropical.jpg" class=" w-28 h-20"></div>
                        <div class="flex flex-col gap-1 justify-center items-start pl-3 pr-6">
                            <p class="text-md font-medium text-[#064420]">Dokumen.Pdf</p>
                            <p class="text-sm text-[#064420]">Word</p>
                        </div>
                    </div>
                    <div id="Divider" class="h-0.5 w-full bg-[#618264] opacity-70 rounded-full"></div>
                    <div id="Commend_Field" class="w-full flex flex-col gap-6 px-4">
                        <div id="Comment" class="flex justify-between items-center w-full">
                            <div class="flex justify-between gap-3 items-center">
                                <div class="w-12 h-12 p-4 bg-[#819B83] opacity-40 rounded-full"
                                    style="background-image: url('Assets/User_Profile2.jpg'); background-size: cover; background-position: center ;">
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex gap-2">
                                        <p class=" font-medium text-[#064420]">Bedul</p>
                                        <p class="opacity-80 text-[#064420]">11 Sep 2020</p>
                                    </div>
                                    <div>
                                        <p class="text-[#064420]">Oke</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#064420" stroke-width="2"
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
                                <div class="w-12 h-12 p-4 bg-[#819B83] opacity-40 rounded-full"
                                    style="background-image: url('Assets/User_Profile.jpg'); background-size: cover; background-position: center ;">
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex gap-2">
                                        <p class=" font-medium text-[#064420]">M.Adin Nugroho</p>
                                        <p class="opacity-80 text-[#064420]">11 Sep 2020</p>
                                    </div>
                                    <div>
                                        <p class="text-[#064420]">Siap</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#618264" stroke-width="2"
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
                                    class="w-full focus:outline-none border py-3 px-2 rounded-xl input-field bg-[#779578] placeholder:text-white/70">
                                <button>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="#064420"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" /><path d="M6.5 12h14.5" /></svg>
                                </button>
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
        </div>
    </div>
    <div id="SideContent" class="flex flex-col gap-3 w-[600px]">
            <div class="w-full flex flex-col border border-[#618264] rounded-xl p-3 gap-3 bg-[#89B88D]">
                <div class="flex justify-between items-center">
                    <p class="text-white text-sm">Kode Kelas</p>
                    <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                    </button>
                </div>
                <h1 class="text-2xl font-medium text-white">{{ $kelas->kode_kelas }}</h1>
            </div>
            <div class="flex flex-col border border-[#618264] rounded-lg max-h-fit p-2 gap-3 bg-[#89B88D]">
                <p class="text-lg font-medium text-white">Daftar Tugas</p>
                <div id="TaskList" class="flex flex-col gap-3">
                    @forelse ($kelas->tasks as $task)
                        <!-- Link yang mengarah ke halaman task-page -->
                        <a href="{{ route('task_page', ['kelas' => $kelas->id, 'task' => $task->id]) }}" class="flex gap-2 justify-start items-center border border-[#618264] bg-[#B0D9B1] p-2 rounded-lg hover:bg-gray-200">
                            <div class="p-2 bg-[#618264] max-w-fit max-h-fit rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                </svg>
                            </div>
                            <div class="flex flex-col justify-start items-start gap-1">
                                <p class="text-base font-medium text-[#064420]">{{ $task->judul }}</p>
                                <p class="text-sm text-[#506C50]">Deadline: <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</span></p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada tugas untuk kelas ini.</p>
                    @endforelse
                </div>
            </div>
            <div id="People" class="flex flex-col gap-6 border  border-[#618264] rounded-xl p-3">
                <div id="Teacher" class="flex flex-col gap-3">
                    <div class="flex justify-between border-b border-[#064420] pb-3">
                        <h1 class="text-xl font-medium text-[#064420]">Pengajar</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="#064420" stroke-width="2"
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
                        <div class="h-8 w-8 bg-[#819B83] opacity-40 rounded-full"></div>
                        <p class="text-sm font-medium text-[#064420]">{{ $kelas->guru->name ?? 'Guru tidak ditemukan' }}</p>
                    </div>
                </div>
                <div id="Teacher" class="flex flex-col gap-3">
                    <div class="flex justify-between border-b border-[#064420] pb-3">
                        <h1 class="text-xl font-medium text-[#064420]">Siswa</h1>
                        <div class="flex gap-3">
                            <p class="text-md text-[#064420]"><span>{{ $kelas->users->count() }}</span> Siswa</p>                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#064420" stroke-width="2"
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
                                        <div class="h-8 w-8 bg-[#819B83] opacity-40 rounded-full">
                                            @if ($user->avatar)
                                                <img src="{{ $user->avatar }}" alt="Avatar {{ $user->name }}" class="h-8 w-8 rounded-full">
                                            @endif
                                        </div>
                                        <p class="text-sm font-medium text-[#064420]">{{ $user->name }}</p>
                                    </div>
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#064420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
@endsection