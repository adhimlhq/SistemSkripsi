<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Topic;
use App\Models\Seminar;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicController extends Controller
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

    /**
     * Tampilkan beranda akademik.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (request()->user()->hasRole('akademik')) {

            $topic = Topic::count();

            $sempro = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                ->where('seminar', '=', 'SEMPRO')
                ->whereIn('status_id', [23, 24, 25])
                ->count();

            $semhas = Topic::join('seminar', 'seminar.topic_id', '=', 'topics.id')
                ->where('seminar', '=', 'SEMHAS')
                ->whereIn('status_id', [73, 74, 75])
                ->count();

            return view('academic/beranda', compact('semhas', 'sempro', 'topic'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with('statuses')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->get();

        // dd($topics);

        return view('academic.index', compact('topics'));
    }

    //method untuk verifikasi proposal topic oleh akademik
    public function verifProposal($idpro)
    {
        $topic = Topic::where('id', $idpro);

        try {
            $topic->update([
                'status_id' => 11
            ]);

            return redirect()->back()->with('status', 'Berhasil Melakukan Verifikasi Dokumen');
        } catch (\Throwable $th) {
            \Session::flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    //method untuk menolak proposal topic oleh akademik
    public function tolakProposal($idpro)
    {
        $topic = Topic::where('id', $idpro);

        try {
            $topic->update([
                'status_id' => 110
            ]);
            return redirect()->route('mailDenied', [$idpro]);
        } catch (\Throwable $th) {
            \Session::flash('error', $th->getMessage());
        }
        return redirect()->back();
    }

    public function approveSeminar(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);

        if ($user->roles_id == 3) {
            $seminar = Seminar::join('topics', 'seminar.topic_id', '=', 'topics.id')
                ->where('topics.id', $id)->first();
            if ($seminar->status_id == 24) {
                Seminar::where('topic_id', $id)
                    ->where('seminar', '=', 'SEMPRO')->update([
                        'ruangan' => $request->ruangan,
                    ]);
                Topic::where('id', $id)->update([
                    'status_id' => 25
                ]);
            } elseif ($seminar->status_id == 74) {
                Seminar::where('topic_id', $id)
                    ->where('seminar', '=', 'SEMHAS')->update([
                        'ruangan' => $request->ruangan,
                    ]);
                Topic::where('id', $id)->update([
                    'status_id' => 75
                ]);
            }
            return redirect()->back()->with('status', 'Berhasil Melakukan Persetujuan Seminar');
        }
        return redirect()->back();
    }

    public function indexSempro()
    {
        $topics = Topic::with('statuses')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->join('seminar', 'seminar.topic_id', '=', 'topics.id')
            ->where('seminar', '=', 'SEMPRO')
            ->whereIn('status_id', [23, 24])
            ->get();

        // dd($topics);
        return view('academic.indexSempro', compact('topics'));
    }


    public function indexSemhas()
    {
        $topics = Topic::with('statuses')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->join('seminar', 'seminar.topic_id', '=', 'topics.id')
            ->where('seminar', '=', 'SEMHAS')
            ->whereIn('status_id', [73, 74])
            ->get();

        // dd($topics);
        return view('academic.indexSemhas', compact('topics'));
    }

    public function rejectSempro($id)
    {
        Seminar::where('topic_id', '=', $id)->where('Seminar', '=', 'SEMPRO')->forceDelete();

        Topic::find($id)->update([
            'status_id' => 200
        ]);

        return redirect()->route('topic.show', [$id])->with('error', 'Berhasil menolak pengajuan sempro');
    }

    public function rejectSemhas($id)
    {
        Seminar::where('topic_id', '=', $id)->where('Seminar', '=', 'SEMHAS')->forceDelete();

        Topic::find($id)->update([
            'status_id' => 700
        ]);

        return redirect()->route('topic.show', [$id])->with('error', 'Berhasil menolak pengajuan sempro');
    }
}
