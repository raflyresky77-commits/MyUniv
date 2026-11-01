<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil data pengguna yang sedang login
        $user = Auth::user();

        // 3. Mapping ID role berdasarkan database MyUniv
        $roleMap = [
            1 => 'student',
            2 => 'counselor',
            3 => 'admin',
        ];

        // 4. Ambil nama role pengguna
        $userRoleName = $roleMap[$user->role_id] ?? null;

        // 5. Tolak jika role tidak dikenal
        if (!$userRoleName) {
            abort(403, 'Role pengguna tidak valid.');
        }

        // 6. Periksa apakah role pengguna diizinkan mengakses route
        if (!in_array($userRoleName, $roles, true)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // 7. Lanjutkan jika role sesuai
        return $next($request);
    }
}
