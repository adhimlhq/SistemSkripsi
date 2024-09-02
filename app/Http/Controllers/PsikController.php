<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PsikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        if (request()->user()->hasRole('psik')) {
            return view('psik.beranda');
        } else {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = User::where('roles_id', '=', 1)
            ->count();
        $karyawan = User::where('roles_id', '=', 3)
            ->orWhere('roles_id', '=', 2)
            ->count();
        $dosen = User::where('roles_id', '=', 4)
            ->count();
        $mahasiswa = User::where('roles_id', '=', 5)
            ->count();

        $users = DB::table('users')
            ->where('roles_id', '!=', 1)
            ->get();

        // dd($users);

        return view('psik.index', compact('admin', 'karyawan', 'dosen', 'mahasiswa', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEmploye()
    {
        $admin = User::where('roles_id', '=', 1)
            ->count();
        $karyawan = User::where('roles_id', '=', 3)
            ->orWhere('roles_id', '=', 2)
            ->count();
        $dosen = User::where('roles_id', '=', 4)
            ->count();
        $mahasiswa = User::where('roles_id', '=', 5)
            ->count();

        $users = DB::table('users')
            ->where('roles_id', '=', 2)
            ->orWhere('roles_id', '=', 3)
            ->orderBy('status')
            ->get();

        return view('psik.employe', compact('admin', 'karyawan', 'dosen', 'mahasiswa', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLecture()
    {
        $admin = User::where('roles_id', '=', 1)
            ->count();
        $karyawan = User::where('roles_id', '=', 3)
            ->orWhere('roles_id', '=', 2)
            ->count();
        $dosen = User::where('roles_id', '=', 4)
            ->count();
        $mahasiswa = User::where('roles_id', '=', 5)
            ->count();

        $users = DB::table('users')
            ->where('roles_id', '=', 4)
            ->orderBy('status')
            ->get();

        return view('psik.lecture', compact('admin', 'karyawan', 'dosen', 'mahasiswa', 'users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStudent()
    {
        $admin = User::where('roles_id', '=', 1)
            ->count();
        $karyawan = User::where('roles_id', '=', 3)
            ->orWhere('roles_id', '=', 2)
            ->count();
        $dosen = User::where('roles_id', '=', 4)
            ->count();
        $mahasiswa = User::where('roles_id', '=', 5)
            ->count();

        $users = User::leftJoin('students', 'users.id', '=', 'students.user_id')
            ->select('users.*', 'students.program_id')
            ->where('users.roles_id', '=', 5)
            ->get();

        // dd($users);

        // if (request()->ajax()) {
        //     return Datatables::of($users)
        //         ->addColumn('action', function ($row) {
        //             $btn = '<a href="#" class="edit btn btn-primary btn-sm">Detail</a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        return view('psik.student', compact('users', 'admin', 'karyawan', 'dosen', 'mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.createEmp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "id" => "required",
            "nama" => "required|min:3|max:100",
            "nama_b" => "required|min:3|max:100",
            "email" => "required|unique:users",
            "roles_id" => "required",
            "no_HP" => "required|digits_between:9,12|unique:users",
        ]);

        User::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'nama_b' => $request->nama_b,
            'email' => $request->email,
            'roles_id' => $request->roles_id,
            'no_HP' => $request->no_HP,
            'status' => 0,
        ]);

        return redirect()->route('psik.index')
            ->with('status', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLec()
    {
        $field = Field::all();
        return view('users.createLec', ['field' => $field]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLec(Request $request)
    {
        $request->validate([
            "id" => "required",
            "nama" => "required|min:3|max:100",
            "nama_b" => "required|min:3|max:100",
            "email" => "required|unique:users",
            "previllege" => "required",
        ]);

        $user = User::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'nama_b' => $request->nama_b,
            'email' => $request->email,
            'roles_id' => 4,
            'no_HP' => $request->no_HP,
            'status' => 0,
        ]);

        $lecture = Lecture::create([
            'user_id' => $user->id,
            'previllege' => $request->previllege,
            'ruangan' => $request->ruangan,
        ]);

        $lecture->field()->attach($request->input('field'));

        return redirect()->route('psik.index', compact('user', 'lecture'))
            ->with('status', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);

        return view('psik.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Validator::make($request->all(), [
            "nama" => "required|min:3|max:100",
            "nama_b" => "required|min:3|max:100",
            "status" => "required|integer",
            "no_HP" => "digits_between:9,12",
        ])->validate();

        $user = \App\Models\User::findOrFail($id);

        $user->nama = $request->get('nama');
        $user->nama_b = $request->get('nama_b');
        $user->status = $request->get('status');
        $user->no_HP = $request->get('no_HP');

        $user->save();

        return redirect()->route('psik.index', [$id])
            ->with('status', 'Pengguna Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);

        if ($users->status == 1) {
            return redirect()->route('psik.index')->with('error', 'Tidak dapat menghapus pengguna yang sedang aktif');
        } else {
            $users->forceDelete();
            return redirect()->back()->with('status', 'Pengguna berhasil dihapus');
        }
    }


    public function approved($id)
    {
        try {
            User::where('id', $id)->update([
                'status' => 1
            ]);

            return redirect()->route('psik.makePassword', [$id])
                ->with('status', 'Pengguna berhasil diaktifkan!');
        } catch (\Throwable $th) {
            \Session::flash('error', $th->getMessage());
        }
        return redirect()->back();
    }


    public function makePassword($id)
    {
        $user = User::findOrFail($id);

        return view('auth.createpassword', ['user' => $user]);
    }

    public function sendMail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Create Password');
        });

        return redirect()->route('psik.index')->with('status', 'Berhasil mengirim link password kepada pengguna!');
    }
}
