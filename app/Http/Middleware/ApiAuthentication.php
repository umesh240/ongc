<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = $request->id;
        if($user_id <= 0 || $user_id == ''){
            return response()->json(['status' => 401, 'message' => 'User id must be required.']);
        }
        $auth = @$request->auth;
        $userFind = DB::table('users')->where('id', $user_id)->first();
        $user_token = $userFind->login_token;
        $bearerToken = $request->header('Authorization');
        $token = trim(str_replace('Bearer ', '', $bearerToken));
        if(!empty($auth)){
            $token = $auth;
        }
        if (!$token || $token !== $user_token) {
            return response()->json(['status' => 401, 'message' => 'Unauthorized']);
        }

        return $next($request);
    }
}


