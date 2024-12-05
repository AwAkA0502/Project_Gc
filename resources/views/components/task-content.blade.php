<div id="Content_Tugas{{ $task->id }}" class="content overflow-auto border-gray-300 border-2 rounded-xl shadow-lg">
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
                <td>
                    <div class="p-3 flex items-center">
                        <div class="w-10 h-10 bg-black rounded-full"
                            style="background-image: url('{{ $submission->user->profile_picture ?? asset('Assets/User_Profile2.jpg') }}'); background-size: cover; background-position: center;">
                        </div>
                        <p class="ml-3">{{ $submission['user'] ?? 'Tidak diketahui' }}</p>
                    </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($submission['created_at'])->format('d M Y, H:i') }}</td>
                <td>
                    <a href="{{ asset('storage/' . $submission['file_url']) }}" 
                       target="_blank" 
                       class="text-blue-500 underline truncate block max-w-[200px]" 
                       title="{{ basename($submission['file_url']) }}">
                       {{ basename($submission['file_url']) }}
                    </a>
                </td>
                <td>
                    <input
                        type="number"
                        name="nilai"
                        class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full"
                        placeholder="Masukkan nilai (0-100)"
                        min="0"
                        max="100"
                        value="{{ $submission['nilai'] }}"
                        required
                    />
                </td>
                <td>
                    <textarea
                        name="feedback"
                        class="border-gray-300 border-2 rounded-lg py-2 px-2 w-full"
                        rows="4"
                        placeholder="Masukkan feedback di sini"
                        required
                    >{{ $submission['feedback'] }}</textarea>
                </td>
                <td class="text-center">
                    <form action="{{ route('submission.update', $submission['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button
                            type="submit"
                            class="bg-blue-500 px-5 py-2 text-white rounded-xl"
                        >
                            Kirim
                        </button>
                    </form>
                </td>
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