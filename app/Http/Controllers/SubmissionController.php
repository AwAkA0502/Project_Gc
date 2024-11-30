<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth; // Tambahkan ini


class SubmissionController extends Controller
{
    public function index($id)
{
    // Ambil data submissions berdasarkan ID kelas
    $submissions = Submission::with('user') // Relasi ke tabel users
        ->where('kelas_id', $id) // Filter berdasarkan kelas_id
        ->whereNotNull('file_url') // Hanya yang sudah mengunggah file
        ->get();

    // Kirim data ke view
    return view('submission.index', compact('submissions', 'id'));
}

public function store(Request $request, $kelas, $task)
{
    $request->validate([
        'file' => 'required|file|mimes:pdf,docx,txt|max:2048',
    ]);

    $user = Auth::user();

    // Cek apakah pengguna sudah mengirimkan tugas ini
    $existingSubmission = Submission::where('tugas_id', $task)
        ->where('siswa_id', $user->id) // Gunakan siswa_id
        ->first();

    if ($existingSubmission) {
        return redirect()->back()->withErrors('Anda sudah mengirimkan tugas ini.');
    }

    // Simpan file
    $filePath = $request->file('file')->store('submissions', 'public');

    // Simpan ke database
    Submission::create([
        'tugas_id' => $task,
        'siswa_id' => $user->id,
        'file_url' => $filePath,
    ]);

    return redirect()->back()->with('success', 'Tugas berhasil diserahkan.');
}

public function showTask($kelasId, $taskId)
{
    $user = Auth::user();

    // Periksa apakah tugas sudah dikumpulkan oleh user
    $submission = Submission::where('kelas_id', $kelasId)
        ->where('tugas_id', $taskId)
        ->where('user_id', $user->id)
        ->first();

    $kelas = Kelas::findOrFail($kelasId);
    $task = Task::findOrFail($taskId);

    return view('task-page', [
        'kelas' => $kelas,
        'task' => $task,
        'submission' => $submission, // Data submission untuk validasi
    ]);
}

public function destroy($id)
{
    $submission = Submission::findOrFail($id);

    // Pastikan hanya pengirim yang bisa menghapus
    if ((int) $submission->siswa_id !== (int) Auth::id()) {
        dd('403 error triggered, siswa_id:', $submission->siswa_id, 'auth_id:', Auth::id());
    }

    $submission->delete();

    return back()->with('success', 'Pengiriman berhasil dibatalkan.');
}
}