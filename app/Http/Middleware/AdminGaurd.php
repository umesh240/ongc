<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminGaurd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$user = Auth()->user();
		//print_r($user);
		$user_type = $user->user_type;
		if($user_type > 1 || $user_type < 0){
			/// i.e.  $user_type == 1 || $user_type == 0
			Auth::logout();
			session()->flush();
			return redirect('/');
		}
        return $next($request);
    }
}
