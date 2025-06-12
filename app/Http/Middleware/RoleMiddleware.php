<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Parameter role dari route, contoh: 'pemilik'
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek jika user tidak login, langsung redirect.
        if (!Auth::check()) {
            return redirect('login');
        }

        $userRole = strtolower(trim(Auth::user()->role));
        $requiredRole = strtolower(trim($role));

        if ($userRole !== $requiredRole) {
            abort(403, 'Unauthorized. Peran Anda (' . $userRole . ') tidak sesuai dengan yang dibutuhkan (' . $requiredRole . ').');
        }

        return $next($request);
    }
}
