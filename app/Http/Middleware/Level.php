<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param mixed $level  [1. psik | 2. jurusan | 3. akademik | 4. dosen | 5. mahasiswa]
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$level)
    {
        if (auth()->user() && in_array(auth()->user()->roles_id, $level)) {
            return $next($request);
        }

        return redirect('/home');
    }
}
