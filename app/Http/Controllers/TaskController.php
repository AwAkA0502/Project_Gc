<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show($id)
    {
        $kelas = Kelas::with('tasks')->findOrFail($id);

        return view('class-page', compact('kelas'));
    }
}