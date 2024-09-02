<?php

namespace App\Http\Controllers;

use App\Models\Topic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class DepartementController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (request()->user()->hasRole('jurusan')) {
            return view('departement.beranda');
        } else {
            return redirect('/');
        }
    }


    public function indextopic()
    {
        $topics = Topic::with('statuses')
            ->join('users', 'users.id', '=', 'topics.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->where('topics.surat_tugas', '=', null)
            ->get();

        return view('departement.indextopic', compact('topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadSurat(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        \Validator::make($request->all(), [
            "surat_tugas" => "required|mimes:pdf,doc,docx|max:2000",
        ])->validate();

        if ($request->file('surat_tugas')) {
            $file = $request->file('surat_tugas')->store('surat_tugas', 'public');
            $topic->surat_tugas = $file;
        }

        $topic->save();

        return redirect()->route('departement.indextopic', [$id])
            ->with('status', 'Berhasil Diunggah');
    }


    public function indexSurat(Type $var = null)
    {
        # code...
    }
}
