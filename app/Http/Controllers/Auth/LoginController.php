<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login dengan username
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('id');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';
        request()->merge([$field => $login]);
        return $field;
    }

    // /**
    //  * Login dengan request status aktif.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    protected function credentials(Request $request)
    {
        $user = $this->username();
        if (!$user == "email") {
            return [$this->username() => $request->{$this->username('id')}, 'password' => $request->password, 'status' => 1];
        }
        return [$this->username() => $request->{$this->username('email')}, 'password' => $request->password, 'status' => 1];
    }

    protected function sendFailedLoginResponse(Request $request)
    {

        $errors = new MessageBag([
            'id' => ['Email or Username invalid!'],
            'password' => ['Password do not match!'],
        ]);

        return redirect()->back()->withErrors($errors);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login')
            ->with('status', 'Terima kasih, semoga sukses!');
    }
}
