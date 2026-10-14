<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Memeriksa apakah sesi pengguna sudah terotentikasi (login)
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // 2. Mapping role_id dari database Supabase ke nama role string
        // 3 = admin, 2 = counselor (guru BK), 1 = student (siswa)
        $roleMap = [
            3 => 'admin',
            2 => 'counselor',
            1 => 'student',
        ];

        $userRoleName = $roleMap[$user->role_id] ?? 'student';

        // 3. Batasan hak akses (Authorization Guard) berdasarkan pola URL / Route

        // Mencegah Admin masuk ke area selain rute yang berawalan admin*
        if ($user->role_id == 3 && !$request->is('admin*')) {
            abort(403);
        }

        // Mencegah Guru BK masuk ke area selain rute yang berawalan counselor*
        if ($user->role_id == 2 && !$request->is('counselor*')) {
            abort(403);
        }

        // Mencegah Siswa masuk ke area terlarang (admin atau counselor)
        if ($user->role_id == 1 && ($request->is('admin*') || $request->is('counselor*'))) {
            abort(403);
        }

        return $next($request);
    }
}
