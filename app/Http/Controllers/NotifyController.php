<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NotifyController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function formReset($token)
    {
        return view('auth.passwordlink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('status', 'Password berhasil dibuat, silahkan melakukan Login');
    }


    //Function notif untuk menolak proposal oleh Akdemik
    public function mailDenied($idpro)
    {
        $user = DB::table('users')->leftJoin('topics', 'users.id', '=', 'topics.user_id')->where('topics.id', $idpro)->select('email')->first();

        Mail::send('email.proposalDenied', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);

            $message->subject('Proposal Ditolak Oleh Akademik');
        });

        return redirect()->route('academic.index')->with('error', 'Proposal berhasil digagalkan!');
    }


    //function notif untuk proposal telah disetujui oleh Kaprodi
    public function mailApproved($idpro)
    {
        $user = DB::table('users')->leftJoin('topics', 'users.id', '=', 'topics.user_id')->where('topics.id', $idpro)->select('email')->first();

        Mail::send('email.proposalApproved', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);

            $message->subject('Proposal Telah Disetujui');
        });

        return redirect()->route('topic.show', [$idpro])->with('status', 'Proposal berhasil disetujui!');
    }
}
