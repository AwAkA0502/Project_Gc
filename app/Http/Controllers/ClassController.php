<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function createClass(Request $request)
    {
        // Validasi data input
        $request->validate([
            'class_name' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
        ]);

        // Generate class code secara acak
        $classCode = $this->generateClassCode();

        // Simpan data kelas ke database
        $class = ClassModel::create([
            'class_name' => $request->input('class_name'),
            'subject_name' => $request->input('subject_name'),
            'class_code' => $classCode,
        ]);

        return redirect()->route('class_page')->with('message', 'Class created successfully with code: ' . $classCode);
    }

    public function joinClass(Request $request, $classCode)
    {
        // Mencari kelas berdasarkan kode
        $class = ClassModel::where('class_code', $classCode)->first();

        if ($class) {
            // Bergabung dengan kelas
            Auth::user()->classes()->attach($class->id);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function deleteClass($classCode)
    {
        // Mencari kelas berdasarkan kode
        $class = ClassModel::where('class_code', $classCode)->first();

        if ($class) {
            // Menghapus kelas
            $class->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    // Fungsi untuk menghasilkan kode kelas acak
    private function generateClassCode($length = 8)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($chars), 0, $length);
    }
}
