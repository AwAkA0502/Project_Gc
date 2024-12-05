<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Kelas;

use App\Models\Submission; 


class ClassController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('guru_id', auth()->id())->get();
    
        return view('personal_page', compact('kelas'));
    }

    public function forum($id)
{
    $user = auth()->user();

    $kelas = Kelas::with('tasks')->findOrFail($id);

    $isTeacher = $kelas->guru_id === $user->id;
    $isMember = $isTeacher || $kelas->users()->where('users.id', $user->id)->exists();

    if (!$isMember) {
        abort(403, 'Anda tidak memiliki akses ke kelas ini.');
    }

    return view('class.forum', compact('kelas', 'isTeacher'));
}

public function nilai($id)
{
    $user = auth()->user();
    $kelas = Kelas::with(['tasks.submissions.user'])->findOrFail($id);

    $isTeacher = $kelas->guru_id === $user->id;

    $tasks = $kelas->tasks()->orderBy('created_at', 'desc')->get()->map(function ($task) {
        $task->submissions = $task->submissions->map(function ($submission) {
            return [
                'id' => $submission->id,
                'user' => [
                    'name' => $submission->user->name ?? 'Tidak diketahui',
                    'profile_picture' => $submission->user->profile_picture ?? '/Assets/User_Profile2.jpg',
                ],
                'created_at' => $submission->created_at,
                'file_url' => $submission->file_url,
                'nilai' => $submission->nilai,
                'feedback' => $submission->feedback,
            ];
        });
        return $task;
    });

    $submissions = $tasks->flatMap(function ($task) {
        return $task->submissions;
    });

    return view('class.nilai', compact('kelas', 'tasks', 'submissions', 'isTeacher'));
}



    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nama_pelajaran' => 'required|string|max:255',
        ]);
    
        $user = auth()->user();
    
        $kelas = Kelas::create([
            'nama_kelas' => $validated['nama_kelas'],
            'nama_pelajaran' => $validated['nama_pelajaran'],
            'kode_kelas' => strtoupper(substr(md5(uniqid()), 0, 6)),
            'guru_id' => $user->id,
        ]);
    
        $kelas->users()->attach($user->id);
    
        return redirect()->route('personal_page')->with('success', 'Kelas berhasil dibuat dan Anda telah bergabung ke kelas!');
    }

    public function join(Request $request)
    {
        $validated = $request->validate([
            'kode_kelas' => 'required|string|exists:kelas,kode_kelas',
        ]);
    
        $kelas = Kelas::where('kode_kelas', $validated['kode_kelas'])->first();
    
        if ($kelas->users()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->withErrors(['Anda sudah tergabung dalam kelas ini.']);
        }
    
        $kelas->users()->attach(auth()->id());
    
        return redirect()->route('personal_page')->with('success', 'Berhasil bergabung ke kelas!');
    }

public function myClasses()
{
    $user = auth()->user();

    $kelas = $user->kelas()->get();

    return response()->json([
        'kelas' => $kelas,
    ]);
}

    public function getMyClasses()
    {
        $user = auth()->user();

        $createdClasses = Kelas::where('guru_id', $user->id)->get();

        $joinedClasses = $user->kelas()->get();

        $allClasses = $createdClasses->merge($joinedClasses)->unique('id');

        return view('personal_page', compact('allClasses'));
    }

public function show($id)
{
    $user = Auth::user();

    $kelas = Kelas::with('tasks')->findOrFail($id);

    $isTeacher = $kelas->guru_id === $user->id;

    $isMember = $isTeacher || $kelas->users()->where('users.id', $user->id)->exists();

    if (!$isMember) {
        abort(403, 'Anda tidak memiliki akses ke kelas ini.');
    }

    $submissions = [];
    $userSubmissionStatus = [];
    $tasks = $kelas->tasks; 

    if ($isTeacher) {
        $taskIds = $tasks->pluck('id'); 
        $submissions = Submission::with('user')
            ->whereIn('tugas_id', $taskIds)
            ->whereNotNull('file_url')
            ->get();
    } else {
        foreach ($tasks as $task) {
            $userSubmissionStatus[$task->id] = Submission::where('tugas_id', $task->id)
                ->where('siswa_id', $user->id) 
                ->first();
        }
    }

    return view('class.forum', [
        'kelas' => $kelas,
        'isTeacher' => $isTeacher,
        'tasks' => $tasks,
        'submissions' => $submissions,
        'userSubmissionStatus' => $userSubmissionStatus,
    ]);
}

    
}
