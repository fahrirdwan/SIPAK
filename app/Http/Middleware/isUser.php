<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Melakukan check sudah login atau belum
        if(!Auth::check()){
            // Jika belum login akan di redirect ke login
            return redirect()->route('login');
        }

        if(Auth::user()->id_role !== 2){
            // Jika id_role bukan 2, jalankan kode
            echo "Kamu Bukan User!"; die;
        }
        // Jika id_role 2, jalankan kode
        return $next($request);
    }
}
