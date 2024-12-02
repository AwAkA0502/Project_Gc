<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Tambahkan namespace ini
use Illuminate\Http\Request;
use App\Models\Kelas;

use App\Models\Submission; // Tambahkan ini


class ClassController extends Controller
{
    public function index()
    {
        // Ambil semua kelas yang dibuat oleh guru (atau pengguna yang login)
        $kelas = Kelas::where('guru_id', auth()->id())->get();
    
        // Kirim data ke view
        return view('personal_page', compact('kelas'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nama_pelajaran' => 'required|string|max:255',
        ]);
    
        $user = auth()->user();
    
        // Buat kelas baru
        $kelas = Kelas::create([
            'nama_kelas' => $validated['nama_kelas'],
            'nama_pelajaran' => $validated['nama_pelajaran'],
            'kode_kelas' => strtoupper(substr(md5(uniqid()), 0, 6)), // Random kode kelas
            'guru_id' => $user->id, // ID pengguna yang membuat kelas
        ]);
    
        // Tambahkan pengguna sebagai anggota kelas secara otomatis
        $kelas->users()->attach($user->id);
    
        // Redirect dengan pesan sukses
        return redirect()->route('personal_page')->with('success', 'Kelas berhasil dibuat dan Anda telah bergabung ke kelas!');
    }

    public function join(Request $request)
    {
        // Validasi input kode kelas
        $validated = $request->validate([
            'kode_kelas' => 'required|string|exists:kelas,kode_kelas',
        ]);
    
        // Cari kelas berdasarkan kode_kelas
        $kelas = Kelas::where('kode_kelas', $validated['kode_kelas'])->first();
    
        // Periksa apakah pengguna sudah tergabung dalam kelas
        if ($kelas->users()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->withErrors(['Anda sudah tergabung dalam kelas ini.']);
        }
    
        // Tambahkan pengguna ke kelas melalui tabel pivot
        $kelas->users()->attach(auth()->id());
    
        // Redirect dengan pesan sukses
        return redirect()->route('personal_page')->with('success', 'Berhasil bergabung ke kelas!');
    }

public function myClasses()
{
    $user = auth()->user();

    // Ambil semua kelas yang diikuti user
    $kelas = $user->kelas()->get();

    return response()->json([
        'kelas' => $kelas,
    ]);
}

    public function getMyClasses()
    {
        $user = auth()->user();

        // Kelas yang dibuat oleh user (sebagai guru)
        $createdClasses = Kelas::where('guru_id', $user->id)->get();

        // Kelas yang diikuti oleh user (melalui tabel pivot user_kelas)
        $joinedClasses = $user->kelas()->get();

        // Gabungkan hasil dari kedua query
        $allClasses = $createdClasses->merge($joinedClasses)->unique('id');

        // Kirim data ke view
        return view('personal_page', compact('allClasses'));
    }

public function show($id)
{
    $user = Auth::user();

    // Muat kelas beserta tugas-tugasnya
    $kelas = Kelas::with('tasks')->findOrFail($id);

    // Pastikan pengguna memiliki akses ke kelas ini
    $isTeacher = $kelas->guru_id === $user->id;

    // Gunakan `users.id` untuk menghindari ambiguitas
    $isMember = $isTeacher || $kelas->users()->where('users.id', $user->id)->exists();

    if (!$isMember) {
        abort(403, 'Anda tidak memiliki akses ke kelas ini.');
    }

    // Ambil semua tugas dan submissions
    $submissions = [];
    $userSubmissionStatus = [];
    $tasks = $kelas->tasks; // Semua tugas dalam kelas ini

    // Jika guru, ambil semua submissions
    if ($isTeacher) {
        $taskIds = $tasks->pluck('id'); // Ambil ID semua tugas
        $submissions = Submission::with('user')
            ->whereIn('tugas_id', $taskIds)
            ->whereNotNull('file_url')
            ->get();
    } else {
        // Jika siswa, ambil status pengumpulan masing-masing tugas
        foreach ($tasks as $task) {
            $userSubmissionStatus[$task->id] = Submission::where('tugas_id', $task->id)
                ->where('siswa_id', $user->id) // Change user_id to siswa_id
                ->first();
        }
    }

    // Kirim data ke view
    return view('class-page', [
        'kelas' => $kelas,
        'isTeacher' => $isTeacher,
        'tasks' => $tasks,
        'submissions' => $submissions,
        'userSubmissionStatus' => $userSubmissionStatus, // Status untuk siswa
    ]);
}

    
}
