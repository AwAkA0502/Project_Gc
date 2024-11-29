<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Tambahkan namespace ini
use Illuminate\Http\Request;
use App\Models\Kelas;

class ClassController extends Controller
{
        public function index()
    {
        // Ambil semua kelas yang dibuat oleh guru (atau pengguna yang login)
        $kelas = Kelas::where('guru_id', auth()->id())->get();

        return response()->json([
            'kelas' => $kelas,
        ]);
    }

    public function create(Request $request)
{
    $validated = $request->validate([
        'nama_kelas' => 'required|string|max:255',
        'nama_pelajaran' => 'required|string|max:255',
    ]);

    $kelas = Kelas::create([
        'nama_kelas' => $validated['nama_kelas'],
        'nama_pelajaran' => $validated['nama_pelajaran'],
        'kode_kelas' => strtoupper(substr(md5(uniqid()), 0, 6)), // Random kode kelas
        'guru_id' => auth()->id(), // ID pengguna yang membuat kelas
    ]);

    return response()->json([
        'message' => 'Kelas berhasil dibuat',
        'kelas' => $kelas,
    ]);
}

public function join(Request $request)
{
    $validated = $request->validate([
        'kode_kelas' => 'required|string|exists:kelas,kode_kelas', // Validasi kode kelas
    ]);

    $kelas = Kelas::where('kode_kelas', $validated['kode_kelas'])->first();

    if (!$kelas) {
        return response()->json(['message' => 'Kode kelas tidak ditemukan.'], 404);
    }

    $user = auth()->user();

    // Cek apakah user sudah tergabung di kelas
    if ($user->kelas()->where('kelas_id', $kelas->id)->exists()) {
        return response()->json(['message' => 'Anda sudah tergabung di kelas ini.'], 400);
    }

    // Tambahkan user ke kelas
    $user->kelas()->attach($kelas->id);

    return response()->json(['message' => 'Berhasil bergabung ke kelas']);
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

    return response()->json([
        'kelas' => $allClasses,
    ]);
}

public function show($id)
{
    $user = Auth::user();

    // Muat kelas beserta tugas-tugasnya
    $kelas = Kelas::with('tasks')->findOrFail($id);

    // Pastikan pengguna memiliki akses ke kelas ini
    $isTeacher = $kelas->guru_id === $user->id;
    $isMember = $isTeacher || $kelas->users()->where('id', $user->id)->exists();

    if (!$isMember) {
        abort(403, 'Anda tidak memiliki akses ke kelas ini.');
    }

    // Kirim data ke view
    return view('class-page', [
        'kelas' => $kelas,
        'isTeacher' => $isTeacher,
        'tasks' => $kelas->tasks, // Tugas dikirim sebagai variabel tasks
    ]);
}

    
}
