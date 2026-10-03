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
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Mapping role_id ke nama role string agar fleksibel
        // 3 = admin, 2 = counselor, 1 = student
        $roleMap = [
            3 => 'admin',
            2 => 'counselor',
            1 => 'student',
        ];

        $userRoleName = $roleMap[$user->role_id] ?? 'student';

        // Jika user mencoba masuk ke halaman yang tidak sesuai rolenya, paksa redirect!
        if ($user->role_id == 3 && !$request->is('admin*')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role_id == 2 && !$request->is('counselor*')) {
            return redirect()->route('counselor.dashboard');
        }

        if ($user->role_id == 1 && ($request->is('admin*') || $request->is('counselor*'))) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
