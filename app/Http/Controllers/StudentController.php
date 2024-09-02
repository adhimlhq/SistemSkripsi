<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Program;
use App\Models\Progress;
use App\Models\Student;
use App\Models\Topic;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display dashboard dari mahasiswa.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (request()->user()->hasRole('mahasiswa')) {
            return view('student.beranda');
        } else {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);

        $student = Student::where('user_id', Auth::user()->id)->first();

        $topic = DB::table('status')
            ->join('topics', 'topics.status_id', '=', 'status.id')
            ->where('topics.user_id', Auth::user()->id)
            ->get();

        // dd($student, $user, $topic);

        return view('student.index', ['users' => $user, 'students' => $student, 'topics' => $topic]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editprofil($id)
    {
        $user = User::find($id);
        $student = Student::where('user_id', Auth::user()->id)->first();

        Hash::check(request('password'), $user->password);

        $program = Program::all();
        // dd($student, $user, $program);

        return view('student.profil', ['users' => $user, 'students' => $student, 'programs' => $program]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateprofil(Request $request, $id)
    {
        $request->validate([
            "password" => "required",
            "no_HP" => "required|digits_between:9,12",
            "alamat" => "required",
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        // Jika student mengganti passwornya password 
        if ($user->password != $request->password) {
            $user->update([
                "password" => Hash::make($request->password),
                "no_HP" => $request->no_HP
            ]);

            if ($user->save()) {

                $student = Student::where('user_id', Auth::user()->id)->first();
                $student->alamat = $request->get('alamat');

                if ($request->file('avatar')) {
                    if ($student->avatar && file_exists(storage_path('app/public/' . $student->avatar))) {
                        \Storage::delete('public/' . $student->avatar);
                    }
                    $file = $request->file('avatar')->store('avatars', 'public');
                    $student->avatar = $file;
                }
                $student->save();
            }
        } else {
            // Jika student tidak mengganti passwordnya
            $user->update([
                "password" => $request->password,
                "no_HP" => $request->no_HP
            ]);

            if ($user->save()) {

                $student = Student::where('user_id', Auth::user()->id)->first();
                $student->alamat = $request->get('alamat');

                if ($request->file('avatar')) {
                    if ($student->avatar && file_exists(storage_path('app/public/' . $student->avatar))) {
                        \Storage::delete('public/' . $student->avatar);
                    }
                    $file = $request->file('avatar')->store('avatars', 'public');
                    $student->avatar = $file;
                }
                $student->save();
            }
        }

        // dd($user, $student);

        return redirect()->route('student.dashboard', compact('user', 'student'))
            ->with('status', 'Profil Berhasil Diperbaharui!');
    }


    public function createtopic(Type $var = null)
    {
        $lecture = DB::table('users')
            ->where('roles_id', '=', 4)
            ->get();

        // dd($lecture);
        return view('student.createtopic', compact('lecture'));
    }

    public function storetopic(Request $request)
    {
        \Validator::make($request->all(), [
            "judul" => "required|min:3|max:150",
            "abstrak" => "required",
            "sks" => "required|integer",
            "proposal" => "required|mimes:pdf,doc,docx|max:2000",
            "dosen1_id" => "required",
            "dosen2_id" => "required",
            "pkm" => "required|mimes:pdf,doc,docx|max:2000",
        ])->validate();

        $topic = new \App\Models\Topic;

        $topic->user_id = Auth::user()->id;
        $topic->judul = $request->get('judul');
        $topic->abstrak = $request->get('abstrak');
        $topic->sks = $request->get('sks');
        $topic->dosen1_id = $request->get('dosen1_id');
        $topic->dosen2_id = $request->get('dosen2_id');
        $topic->status_id = 10;

        if ($request->file('pkm')) {
            $file = $request->file('pkm')->store('file_pkm', 'public');
            $topic->pkm = $file;
        }

        if ($request->file('proposal')) {
            $file = $request->file('proposal')->store('file_proposal', 'public');
            $topic->proposal = $file;
        }

        if ($topic->save()) {
            Progress::create([
                'topic_id' => $topic->id,
            ]);

            $student = Student::where('user_id', Auth::user()->id)->first();

            $student->update([
                'status_ta' => 'ACTIVE'
            ]);
            $student->save();
        }
        return redirect()->route('student.index', [Auth::user()->id])->with('status', 'Topik penelitian anda berhasil diunggah');
    }

    public function show($id)
    {
        $idtopic = Topic::find($id);

        $sempro = DB::table('topics')
            ->join('seminar', 'topics.id', '=', 'seminar.topic_id')
            ->where('topics.id', $id)
            ->Where('seminar.seminar', '=', 'SEMPRO')
            ->first();

        $semhas = DB::table('topics')
            ->join('seminar', 'topics.id', '=', 'seminar.topic_id')
            ->where('topics.id', $id)
            ->Where('seminar.seminar', '=', 'SEMHAS')
            ->first();

        $logbook = DB::table('logbook')->where('topic_id', $id)->get();

        if ($idtopic->user_id == Auth::user()->id) {
            $user = DB::table('users')
                ->join('students', 'users.id', '=', 'students.user_id')
                ->where('users.id', Auth::user()->id)->first();

            $topic = Topic::where('id', $idtopic->id)->first();
            $progres = DB::table('progress')->where('topic_id', '=', $idtopic->id)->first();

            $dosbing_id = array($topic->dosen1_id, $topic->dosen2_id);

            // dd($idtopic);

            $namadosen_awal = array(2); //Mencari Nama Awal Dosen
            for ($i = 0; $i < 2; $i++) {
                $namadosen = DB::table("users")->get();
                foreach ($namadosen as $nados) {
                    if ($nados->id == $dosbing_id[$i]) {
                        $namadosen_awal[$i] = $nados->nama;
                    }
                }
            }

            $namadosen_akhir = array(2); //Mencari nama belakang dosen
            for ($i = 0; $i < 2; $i++) {
                $namadosen = DB::table("users")->get();
                foreach ($namadosen as $nados) {
                    if ($nados->id == $dosbing_id[$i]) {
                        $namadosen_akhir[$i] = $nados->nama_b;
                    }
                }
            }
            // dd($progres, $user, $topic, $namadosen_akhir, $namadosen_awal);

            return view('student.show', [
                'users' => $user,
                'progres' => $progres,
                'topics' => $topic,
                'awal' => $namadosen_awal,
                'akhir' => $namadosen_akhir,
                'sempro' => $sempro,
                'semhas' => $semhas,
                'logbook' => $logbook,
                'idtopic' => $idtopic
            ]);
        }
        return redirect()->back();
    }

    //menambahkan dokumen kemajuan 1
    public function addProgres1(Request $request, $id)
    {
        $progres = Progress::findOrFail($id);
        // dd($progres);

        if ($request->file('kemajuan_I')) {
            if ($progres->kemajuan_I && file_exists(storage_path('app/public/' . $progres->kemajuan_I))) {
                \Storage::delete(storage_path('app/public/' . $progres->kemajuan_I));
            }
            $file = $request->file('kemajuan_I')->store('kemajuan1', 'public');
            $progres->kemajuan_I = $file;
        }
        $progres->save();

        return redirect()->back()->with('status', 'Berhasil Menambahkan Dokumen Kemajuan I');
    }

    //menambahkan dokumen kemajuan 2
    public function addProgres2(Request $request, $id)
    {
        $progres = Progress::findOrFail($id);
        // dd($progres);

        if ($request->file('kemajuan_II')) {
            if ($progres->kemajuan_II && file_exists(storage_path('app/public/' . $progres->kemajuan_II))) {
                \Storage::delete(storage_path('app/public/' . $progres->kemajuan_II));
            }
            $file = $request->file('kemajuan_II')->store('kemajuan2', 'public');
            $progres->kemajuan_II = $file;
        }
        $progres->save();


        return redirect()->back()->with('status', 'Berhasil Menambahkan Dokumen Kemajuan II');
    }

    //menambahkan dokumen kemajuan 3
    public function addProgres3(Request $request, $id)
    {
        $progres = Progress::findOrFail($id);
        // dd($progres);

        if ($request->file('kemajuan_III')) {
            if ($progres->kemajuan_III && file_exists(storage_path('app/public/' . $progres->kemajuan_III))) {
                \Storage::delete(storage_path('app/public/' . $progres->kemajuan_III));
            }
            $file = $request->file('kemajuan_III')->store('kemajuan3', 'public');
            $progres->kemajuan_III = $file;
        }
        $progres->save();

        return redirect()->back()->with('status', 'Berhasil Menambahkan Dokumen Kemajuan III');
    }

    //menambahkan dokumen kemajuan 4
    public function addProgres4(Request $request, $id)
    {
        $progres = Progress::findOrFail($id);
        // dd($progres);

        if ($request->file('kemajuan_IV')) {
            if ($progres->kemajuan_IV && file_exists(storage_path('app/public/' . $progres->kemajuan_IV))) {
                \Storage::delete(storage_path('app/public/' . $progres->kemajuan_IV));
            }
            $file = $request->file('kemajuan_IV')->store('kemajuan4', 'public');
            $progres->kemajuan_IV = $file;
        }
        $progres->save();

        return redirect()->back()->with('status', 'Berhasil Menambahkan Dokumen Kemajuan IV');
    }

    // public function addLogBook(Type $var = null)
    // {
    //     //
    // }

    public function createSempro($id)
    {
        $user = Topic::find($id);

        if ($user != null) {
            if ($user->user_id == Auth::user()->id) {
                $topic = DB::table('users')
                    ->join('topics', 'topics.user_id', '=', 'users.id')
                    ->where('topics.id', $id)->select('topics.id', 'topics.judul', 'topics.surat_tugas')->first();

                // dd($topic);

                return view('topic.sempro', compact('topic'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function storeSempro(Request $request, $id)
    {
        $topic = Topic::find($id);

        $sempro = new \App\Models\Seminar;

        $request->validate(
            [
                "nama_moderator" => "required|min:5|max:150",
            ]
        );

        // dd($request->all());

        $sempro->user_id = Auth::user()->id;
        $sempro->topic_id = $topic->id;
        $sempro->seminar = 'SEMPRO';
        $sempro->waktu = $request->get('waktu');
        $sempro->nama_moderator = $request->get('nama_moderator');

        $sempro->save();

        Topic::where('id', $id)->update([
            'status_id' => 20
        ]);

        // dd($sempro, $topic);
        return redirect()->route('student.show', $id)->with('status', 'Berhasil mengajukan seminar proposal');
    }


    public function createSemhas($id)
    {
        $user = Topic::find($id);

        if ($user != null) {
            if ($user->user_id == Auth::user()->id) {
                $topic = DB::table('users')
                    ->join('topics', 'topics.user_id', '=', 'users.id')
                    ->join('progress', 'progress.topic_id', '=', 'topics.id')
                    ->where('topics.id', $id)->select('topics.id', 'topics.judul', 'progress.kemajuan_IV')
                    ->first();

                // dd($topic);

                return view('topic.semhas', compact('topic'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function storeSemhas(Request $request, $id)
    {
        $topic = Topic::find($id);

        $sempro = new \App\Models\Seminar;

        $request->validate(
            [
                "nama_moderator" => "required|min:5|max:150",
            ]
        );
        // dd($request->all());

        $sempro->user_id = Auth::user()->id;
        $sempro->topic_id = $topic->id;
        $sempro->seminar = 'SEMHAS';
        $sempro->waktu = $request->get('waktu');
        $sempro->nama_moderator = $request->get('nama_moderator');

        $sempro->save();

        Topic::where('id', $id)->update([
            'status_id' => 70
        ]);

        // dd($sempro, $topic);
        return redirect()->route('student.show', $id)->with('status', 'Berhasil mengajukan seminar proposal');
    }


    public function createLogbook($id)
    {

        // echo $id;
        $topic = Topic::find($id);

        $dosbing_id = array($topic->dosen1_id, $topic->dosen2_id);

        // dd($dosbing_id);

        $awal = array(2); //Mencari Nama Awal Dosen
        for ($i = 0; $i < 2; $i++) {
            $namadosen = DB::table("users")->get();
            foreach ($namadosen as $nados) {
                if ($nados->id == $dosbing_id[$i]) {
                    $awal[$i] = $nados->nama;
                }
            }
        }

        $akhir = array(2); //Mencari nama belakang dosen
        for ($i = 0; $i < 2; $i++) {
            $namadosen = DB::table("users")->get();
            foreach ($namadosen as $nados) {
                if ($nados->id == $dosbing_id[$i]) {
                    $akhir[$i] = $nados->nama_b;
                }
            }
        }
        // dd($topic);
        return view('topic.create-kartu', compact('topic', 'awal', 'akhir', 'dosbing_id'));
    }


    //
    public function storeLogbook(Request $request, $id)
    {
        $topic = Topic::find($id);

        $data = new \App\Models\Logbook;

        $data->topic_id = $topic->id;
        $data->user_id = Auth::user()->id;
        $data->dospem_id = $request->dospem_id;
        $data->waktu = $request->waktu;
        $data->ruangan = $request->ruangan;
        $data->catatan = $request->catatan;

        $data->save();

        return redirect()->route('student.show', [$id])->with('status', 'Berhasil menambahkan data kartu bimbingan');
    }
}
