<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('psik')) {
            return redirect()->route('psik.dashboard');
        } elseif ($request->user()->hasRole('jurusan')) {
            return redirect()->route('departement.dashboard');
        } elseif ($request->user()->hasRole('akademik')) {
            return redirect()->route('academic.dashboard');
        } elseif ($request->user()->hasRole('dosen')) {
            return redirect()->route('lecture.dashboard');
        } elseif ($request->user()->hasRole('mahasiswa')) {
            return redirect()->route('student.dashboard');
        } else {
            return view('home');
        }
    }
}
