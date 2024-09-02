<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Topic;
use App\Models\Student;
use App\Models\Seminar;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userauth = Auth::user();

        $lecture = DB::table('lecturers')->where('user_id', $userauth->id)->first(); // Mengambil table lecture

        $topic = Topic::find($id);

        //terdapat eagerload disini !!!
        $user = Student::with('program')->join('users', 'students.user_id', '=', 'users.id')->where('users.id', $topic->user_id)->first();
        // dd($topic);

        $sempro = DB::table('topics')->join('seminar', 'topics.id', '=', 'seminar.topic_id')->where('topics.id', $id)->Where('seminar.seminar', '=', 'SEMPRO')->first();
        $semhas = DB::table('topics')->join('seminar', 'topics.id', '=', 'seminar.topic_id')->where('topics.id', $id)->Where('seminar.seminar', '=', 'SEMHAS')->first();

        // $seminar = Seminar::join('topics', 'seminar.topic_id', '=', 'topics.id')
        //     ->where('topics.id', $id)->first();

        // dd($seminar);

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

        return view('topic.show', compact('topic', 'user',  'namadosen_awal', 'namadosen_akhir', 'lecture', 'sempro', 'semhas'));
    }
}
