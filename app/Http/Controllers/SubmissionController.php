<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth; // Tambahkan ini


class SubmissionController extends Controller
{
    public function getSubmissions($taskId)
{
    $task = Task::findOrFail($taskId);
    $submissions = Submission::with('user')->where('tugas_id', $taskId)->get();

    return view('components.task-content', compact('submissions', 'task'));
}


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

    // Simpan file ke storage
    $file = $request->file('file');
    $fileName = $file->getClientOriginalName(); // Hanya nama file
    $filePath = $file->storeAs('submissions', $fileName, 'public'); // Simpan dengan nama file asli

    // Simpan ke database
    Submission::create([
        'tugas_id' => $task,
        'siswa_id' => $user->id,
        'file_url' => $fileName, // Hanya nama file
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

public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'feedback' => 'required|string',
        ]);

        // Cari submission berdasarkan ID
        $submission = Submission::find($id);
        if (!$submission) {
            return response()->json(['message' => 'Submission not found'], 404);
        }

        // Update data submission
        $submission->nilai = $request->input('nilai');
        $submission->feedback = $request->input('feedback');
        $submission->save();

        return response()->json(['message' => 'Submission updated successfully'], 200);
    }
}