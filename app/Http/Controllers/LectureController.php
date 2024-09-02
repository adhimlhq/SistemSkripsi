<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Logbook;
use App\Models\Progress;
use App\Models\Seminar;
use App\Models\Student;
use App\Models\Topic;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class LectureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Type $var = null)
    {
        if (request()->user()->hasRole('dosen')) {
            $lecture = DB::table('lecturers')->where('user_id', Auth::user()->id)->first();

            if ($lecture->previllege == "DOSEN") {
                $bimbingan1 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('dosen1_id', '=', Auth::user()->id)
                    ->whereNotIn('status_id', [100, 900, 999])
                    ->count();

                $bimbingan2 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('dosen2_id', '=', Auth::user()->id)
                    ->whereNotIn('status_id', [100, 900, 999])
                    ->count();

                $bsempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                    ->where('seminar', '=', 'SEMPRO')
                    ->where('dosen1_id', '=', Auth::user()->id)
                    ->orwhere('seminar', '=', 'SEMPRO')
                    ->where('dosen2_id', '=', Auth::user()->id)
                    ->whereIn('status_id', [20, 21, 22, 23, 24, 25])
                    ->count();

                $bsemhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                    ->where('seminar', '=', 'SEMHAS')
                    ->where('dosen1_id', '=', Auth::user()->id)
                    ->orwhere('seminar', '=', 'SEMHAS')
                    ->where('dosen2_id', '=', Auth::user()->id)
                    ->whereIn('status_id', [70, 71, 72, 73, 74, 75])
                    ->count();

                return view('lecture.beranda', [
                    'lecture' => $lecture,
                    'bimbingan1' => $bimbingan1,
                    'bimbingan2' => $bimbingan2,
                    'bsempro' => $bsempro,
                    'bsemhas' => $bsemhas
                ]);
            } else {
                if ($lecture->previllege == "KAPRODI_PSP") {
                    $topic = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('program_id', '=', 1)
                        ->count();
                    $sempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMPRO')
                        ->whereIn('status_id', [21, 22, 23])
                        ->count();
                    $semhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMHAS')
                        ->whereIn('status_id', [71, 72, 73])
                        ->count();
                    $bimbingan1 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->whereNotIn('status_id', [100, 900, 999])
                        ->count();
                    $bimbingan2 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereNotIn('status_id', [100, 900, 999])
                        ->count();
                    $bsempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMPRO')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->orwhere('seminar', '=', 'SEMPRO')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereIn('status_id', [20, 21, 22, 23, 24, 25])
                        ->count();
                    $bsemhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMHAS')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->orwhere('seminar', '=', 'SEMHAS')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereIn('status_id', [70, 71, 72, 73, 74, 75])
                        ->count();

                    return view('lecture.beranda', [
                        'lecture' => $lecture,
                        'topic' => $topic,
                        'sempro' => $sempro,
                        'semhas' => $semhas,
                        'bimbingan1' => $bimbingan1,
                        'bimbingan2' => $bimbingan2,
                        'bsempro' => $bsempro,
                        'bsemhas' => $bsemhas
                    ]);
                } else {
                    $topic = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('program_id', '=', 2)
                        ->count();

                    $sempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMPRO')
                        ->whereIn('status_id', [21, 22, 23])
                        ->count();

                    $semhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMHAS')
                        ->whereIn('status_id', [71, 72, 73])
                        ->count();

                    $bimbingan1 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->whereNotIn('status_id', [100, 900, 999])
                        ->count();
                    $bimbingan2 = Topic::join('users', 'topics.user_id', '=', 'users.id')
                        ->join('students', 'students.user_id', '=', 'users.id')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereNotIn('status_id', [100, 900, 999])
                        ->count();
                    $bsempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMPRO')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->orwhere('seminar', '=', 'SEMPRO')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereIn('status_id', [20, 21, 22, 23, 24, 25])
                        ->count();
                    $bsemhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                        ->where('seminar', '=', 'SEMHAS')
                        ->where('dosen1_id', '=', Auth::user()->id)
                        ->orwhere('seminar', '=', 'SEMHAS')
                        ->where('dosen2_id', '=', Auth::user()->id)
                        ->whereIn('status_id', [70, 71, 72, 73, 74, 75])
                        ->count();


                    return view('lecture.beranda', [
                        'lecture' => $lecture,
                        'topic' => $topic,
                        'sempro' => $sempro,
                        'semhas' => $semhas,
                        'bimbingan1' => $bimbingan1,
                        'bimbingan2' => $bimbingan2,
                        'bsempro' => $bsempro,
                        'bsemhas' => $bsemhas
                    ]);
                }
            }
        } else {
            return redirect('/');
        }
    }

    //function khusus kaprodi 
    public function indexKaprodi()
    {
        //cek dosen yg login dengan previllege nya
        $lecture = DB::table('lecturers')->where('user_id', Auth::user()->id)->first();

        //cek apakah lecture bukan dosen
        if ($lecture->previllege != 'DOSEN') {
            //cek lecture berdasarkan previllege, untuk menampilkan data student berdasarkn  program studi
            if ($lecture->previllege == 'KAPRODI_PSP') {
                $topics = Topic::with('statuses')
                    ->join('users', 'users.id', '=', 'topics.user_id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('students.program_id', '=', 1)
                    ->get();

                // dd($topics);
                return view('lecture.kaprodi.index', compact('topics', 'lecture'));
            } else {
                $topics = Topic::with('statuses')
                    ->join('users', 'users.id', '=', 'topics.user_id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('students.program_id', '=', 2)
                    ->get();

                // dd($topics);
                return view('lecture.kaprodi.index', compact('topics', 'lecture'));
            }
        }
        return redirect()->back()->with('error', 'Anda Tidak Memiliki Hak Akses');
    }

    //function khusus kaprodi
    public function showdosen()
    {
        $user = DB::table('users')
            ->leftJoin('lecturers', 'users.id', '=', 'lecturers.user_id')
            ->where('users.roles_id', '=', 4)
            ->get();

        // dd($user);

        return Datatables::of($user)->addColumn('action', function ($user) {
            // dd($user);
        })->make(true);
    }

    //function khusus kaprodi
    public function editDosbing($id)
    {
        $topic = Topic::find($id);
        $lecture = User::where('users.roles_id', '=', 4)
            ->get();

        // dd($lecture, $topic);
        return view('topic.edit-dosen', compact('lecture', 'topic'));
    }

    //function untuk kaprodi mengganti dosen
    public function updateDosbing(Request $request, $id)
    {
        Topic::where('id', $id)->update([
            'dosen1_id' => $request->dosen1_id,
            'dosen2_id' => $request->dosen2_id
        ]);
    }

    //function khusus kaprodi menyetujui proposal
    public function approved($id)
    {
        $topic = Topic::where('id', $id);

        try {
            $topic->update([
                'status_id' => 12
            ]);
            return redirect()->route('mailApproved', [$id]);
        } catch (\Throwable $th) {
            \Session::flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    // Kaprodi menyetujui Seminar Proposal Mhs
    public function verifySeminar($id)
    {
        $lecture = DB::table('lecturers')->where('user_id', Auth::user()->id)->first();

        if ($lecture->previllege != 'DOSEN') {
            $seminar = Seminar::join('topics', 'seminar.topic_id', '=', 'topics.id')
                ->where('topics.id', $id)->first();

            if ($seminar->status_id == 23) {
                Topic::where('id', $id)->update([
                    'status_id' => 24
                ]);
            } elseif ($seminar->status_id == 73) {
                Topic::where('id', $id)->update([
                    'status_id' => 74
                ]);
            }
            return redirect()->back()->with('status', 'Berhasil Menyetujui Pengajuan Seminar Proposal');
        }
        return redirect()->back()->with('error', 'Anda Tidak Memiliki Hak Akses');
    }


    // 
    // Controller Dosen Pembimbing
    // 

    // fungsi khusus dosen pembimbing, menngambil data topic berdasarkan dosen1_id yg sama dengan user.id
    public function indexGuidance(Type $var = null)
    {
        $lecture =
            Lecture::where('user_id', Auth::user()->id)->first();

        $topics_1 =
            User::join('topics', 'users.id', '=', 'topics.user_id')
            ->where('dosen1_id', Auth::user()->id)
            ->where('status_id', '!=', 999)
            ->get();

        $topics_2 =
            User::join('topics', 'users.id', '=', 'topics.user_id')
            ->where('dosen2_id', Auth::user()->id)
            ->where('status_id', '!=', 999)
            ->get();

        // dd($lecture, $topics);

        return view('lecture.indexGuide', compact('lecture', 'topics_1', 'topics_2'));
    }

    // menampilkan fungsi(page) mahasiswa bimbingan
    public function guidance($id)
    {
        $topic = Topic::find($id);
        $progres = Progress::where('topic_id', $id)->first();
        $lecture = Lecture::where('user_id', Auth::user()->id)->first();

        if ($topic->dosen1_id == Auth::user()->id || $topic->dosen2_id == Auth::user()->id) {
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

            $user = DB::table('users')
                ->where('users.id', $topic->user_id)
                ->first();

            $student = Student::where('students.user_id', $topic->user_id)
                ->first();

            $logbook = DB::table('logbook')
                ->where('topic_id', $id)
                ->orderBy('status_lb', 'asc')
                ->get();

            $dosbing_id = array($topic->dosen1_id, $topic->dosen2_id);

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

            return view('topic.showGuide', compact(
                'progres',
                'namadosen_awal',
                'namadosen_akhir',
                'lecture',
                'topic',
                'student',
                'user',
                'sempro',
                'semhas',
                'logbook'
            ));
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki akses');
    }

    public function indexGuideSempro()
    {
        $lecture = Lecture::where('user_id', Auth::user()->id)->first();

        $topics = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->where('seminar', '=', 'SEMPRO')
            ->where('dosen1_id', '=', Auth::user()->id)
            ->orwhere('seminar', '=', 'SEMPRO')
            ->where('dosen2_id', '=', Auth::user()->id)
            ->whereIn('status_id', [20, 21, 22, 23, 24, 25])
            ->get();

        return view('lecture.indexSempro', compact('topics', 'lecture'));
    }


    public function indexGuideSemhas()
    {
        $lecture = Lecture::where('user_id', Auth::user()->id)->first();

        $topics = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->where('seminar', '=', 'SEMHAS')
            ->where('dosen1_id', '=', Auth::user()->id)
            ->orwhere('seminar', '=', 'SEMHAS')
            ->where('dosen2_id', '=', Auth::user()->id)
            ->whereIn('status_id', [70, 71, 72, 73, 74, 75])
            ->get();

        return view('lecture.indexSempro', compact('topics', 'lecture'));
    }


    //Dosen Pembimbing Menyetujui Kemajuan 1
    public function aprov1(Request $request, $id)
    {
        $progres = Progress::join('topics', 'progress.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();

        //sistem mengecek apakah dospem1 atau dospem 2
        if ($progres->dosen1_id == Auth::user()->id) {
            // data diupdate berdasarkan kondisi status topik
            if ($progres->status_id == 30) {
                $progres->update([
                    'update_I' => $request->update_I,
                    'ulasan_I' => $request->ulasan_I,

                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 31
                ]);
            } else {
                $progres->update([
                    'update_I' => $request->update_I,
                    'ulasan_I' => $request->ulasan_I
                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 33
                ]);
            }
        } else {
            if ($progres->status_id == 31) {
                Topic::where('id', $id)->update([
                    'status_id' => 33
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 32
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Dokumen Kemajuan I');
    }

    public function aprov2(Request $request, $id)
    {
        $progres = Progress::join('topics', 'progress.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();

        if ($progres->dosen1_id == Auth::user()->id) {
            if ($progres->status_id == 40) {
                $progres->update([
                    'update_II' => $request->update_II,
                    'ulasan_II' => $request->ulasan_II,

                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 41
                ]);
            } else {
                $progres->update([
                    'update_II' => $request->update_II,
                    'ulasan_II' => $request->ulasan_II
                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 43
                ]);
            }
        } else {
            if ($progres->status_id == 41) {
                Topic::where('id', $id)->update([
                    'status_id' => 43
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 42
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Dokumen Kemajuan II');
    }

    public function aprov3(Request $request, $id)
    {
        $progres = Progress::join('topics', 'progress.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();

        if ($progres->dosen1_id == Auth::user()->id) {
            if ($progres->status_id == 50) {
                $progres->update([
                    'update_III' => $request->update_III,
                    'ulasan_III' => $request->ulasan_III,

                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 51
                ]);
            } else {
                $progres->update([
                    'update_III' => $request->update_III,
                    'ulasan_III' => $request->ulasan_III
                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 53
                ]);
            }
        } else {
            if ($progres->status_id == 51) {
                Topic::where('id', $id)->update([
                    'status_id' => 53
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 52
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Dokumen Kemajuan III');
    }

    public function aprov4(Request $request, $id)
    {
        $progres = Progress::join('topics', 'progress.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();

        if ($progres->dosen1_id == Auth::user()->id) {
            if ($progres->status_id == 60) {
                $progres->update([
                    'update_IV' => $request->update_IV,
                    'ulasan_IV' => $request->ulasan_IV,

                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 61
                ]);
            } else {
                $progres->update([
                    'update_IV' => $request->update_IV,
                    'ulasan_IV' => $request->ulasan_IV
                ]);
                Topic::where('id', $id)->update([
                    'status_id' => 63
                ]);
            }
        } else {
            if ($progres->status_id == 61) {
                Topic::where('id', $id)->update([
                    'status_id' => 63
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 62
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Dokumen Kemajuan IV');
    }

    //fungsi dosen untuk menyetujui pengajuan sempro
    public function verifSempro($id)
    {
        $sempro = Seminar::join('topics', 'seminar.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();


        if ($sempro->dosen1_id == Auth::user()->id) { //untuk dospem 1
            if ($sempro->status_id == 20) {
                Topic::where('id', $id)->update([
                    'status_id' => 21
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 23
                ]);
            }
        } else {
            if ($sempro->status_id == 21) {
                Topic::where('id', $id)->update([
                    'status_id' => 23
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 22
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Pengajuan Seminar Proposal');
    }

    //fungsi dosen untuk menyetujui pengajuan semhas
    public function verifSemhas($id)
    {
        $semhas = Seminar::join('topics', 'seminar.topic_id', '=', 'topics.id')
            ->where('topics.id', $id)->first();

        if ($semhas->dosen1_id == Auth::user()->id) { //untuk dospem 1
            if ($semhas->status_id == 70) {
                Topic::where('id', $id)->update([
                    'status_id' => 71
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 73
                ]);
            }
        } else {  //dospem 2
            if ($semhas->status_id == 71) {
                Topic::where('id', $id)->update([
                    'status_id' => 73
                ]);
            } else {
                Topic::where('id', $id)->update([
                    'status_id' => 72
                ]);
            }
        }

        return redirect()->back()->with('status', 'Berhasil Menyetujui Pengajuan Seminar Hasil');
    }

    //aprove logbook
    public function aproveLogbook($id)
    {
        $logbook = Logbook::find($id);

        $logbook->update([
            'status_lb' => 'APPROVE'
        ]);

        return redirect()->back()->with('status', 'Berhasil Kartu Bimbingan Mahasiswa');
    }


    public function destroyLogbook($id)
    {
        $kartu = Logbook::find($id);

        if ($kartu->status_lb == 'APPROVE') {
            //
        } else {
            $kartu->forceDelete();
            return redirect()->back()->with('error', 'Berhasil menghapus kartu kendali');
        }
    }
}
