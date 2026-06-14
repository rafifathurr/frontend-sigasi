<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('jwt_token')) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu.');
        }

        $response = Http::withToken(session('jwt_token'))->post(env('API_URL') . 'api/user');

        if ($response->unauthorized()) {
            return redirect()->route('logout')->with('error', 'Sesi anda telah habis.');
        }

        return $next($request);
    }
}
