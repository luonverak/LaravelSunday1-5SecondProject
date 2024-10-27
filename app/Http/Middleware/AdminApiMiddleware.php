<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->token;
        
        if(!$token){
            return response()->json([
                "status"=>"failed",
                "msg"=>"Unauthenticated invalid token"
            ]);
        }

        $userToken = UserToken::where("token", $token)->first();
        if (!$userToken) {
            return response()->json([
                'status' => 'failed',
                'msg' => "Unauthenticated session expired"
            ]);
        }

        $user = User::where('id', $userToken->user_id)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'failed', 
                'msg' => "Unauthenticated user"
            ]);
        }

        Auth::login($user);

        return $next($request);
    }
}
