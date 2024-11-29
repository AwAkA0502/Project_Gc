<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Models\Kelas;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function showTaskPage($kelasId, $taskId)
{
    // Ambil kelas berdasarkan kelasId
    $kelas = Kelas::findOrFail($kelasId);

    // Ambil tugas berdasarkan taskId
    $task = Task::findOrFail($taskId);

    // Kirim data tugas dan kelas ke view
    return view('task-page', [
        'kelas' => $kelas,
        'task' => $task, // Pastikan data tugas dikirim ke view
    ]);
}

    public function show($id)
    {
        $kelas = Kelas::with('tasks')->findOrFail($id);

        return view('class-page', compact('kelas'));
    }

    public function store(Request $request, $kelas)
{
    // Debugging: Pastikan parameter $kelas diterima
    if (!$kelas) {
        abort(400, 'ID kelas diperlukan.');
    }

    // Validasi input
    $validatedData = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'deadline' => 'required|date',
        'waktu' => 'nullable|date_format:H:i',
        'nilai' => 'nullable|integer|min:0|max:100',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Validasi kelas (pastikan kelas ID valid dan pengguna berhak)
    $kelasObj = Kelas::find($kelas);
    if (!$kelasObj) {
        abort(404, 'Kelas tidak ditemukan.');
    }

    // Opsional: Pastikan hanya guru kelas yang dapat menambahkan tugas
    if (auth()->user()->id !== $kelasObj->guru_id) {
        abort(403, 'Anda tidak memiliki hak untuk menambahkan tugas di kelas ini.');
    }

    // Simpan file jika ada
    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('uploads/tugas', 'public');
    }

    // Simpan data ke tabel tugas
    $task = Task::create([
        'kelas_id' => $kelas, // Ambil kelas_id dari parameter route
        'judul' => $validatedData['judul'],
        'deskripsi' => $validatedData['deskripsi'],
        'deadline' => $validatedData['deadline'],
        'waktu' => $validatedData['waktu'],
        'nilai' => $validatedData['nilai'],
        'file_path' => $filePath,
    ]);

    // Berikan respons JSON atau redirect sesuai kebutuhan
    return redirect()->route('class.page', ['id' => $kelas])->with('success', 'Tugas berhasil ditambahkan.');

}

public function destroy($id)
{
    $task = Task::findOrFail($id);

    // Validasi bahwa pengguna hanya dapat menghapus tugas di kelasnya sendiri (opsional)
    if (auth()->user()->id !== $task->kelas->guru_id) {
        abort(403, 'Anda tidak memiliki hak untuk menghapus tugas ini.');
    }

    $task->delete();

    return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
}

public function deleteFile($taskId)
    {
        // Temukan tugas berdasarkan ID
        $task = Task::findOrFail($taskId);

        // Hapus file dari server jika file ada
        if (Storage::disk('public')->exists($task->file_path)) {
            Storage::disk('public')->delete($task->file_path);
        }

        // Update kolom file_path menjadi null setelah file dihapus (opsional)
        $task->file_path = null;
        $task->save();

        return back()->with('success', 'File berhasil dihapus.');
    }


}