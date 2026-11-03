<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeacherBk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private function roleId(string $role): int
    {
        return match ($role) {
            'student' => 1,
            'counselor' => 2,
            'admin' => 3,
            default => abort(422, 'Role pengguna tidak valid.'),
        };
    }

    private function ensureRoleProfile(User $user, int $roleId): void
    {
        if ($roleId === 1) {
            Student::firstOrCreate(['user_id' => $user->id], ['nisn' => null]);
        } elseif ($roleId === 2) {
            TeacherBk::firstOrCreate(['user_id' => $user->id]);
        }
    }

    public function index()
    {
        $users = User::with('role')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['student', 'counselor', 'admin'])],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'role.in' => 'Role pengguna tidak valid.',
        ]);

        DB::transaction(function () use ($validated) {
            $roleId = $this->roleId($validated['role']);
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $roleId,
            ]);
            $this->ensureRoleProfile($user, $roleId);
        });

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', Rule::in(['student', 'counselor', 'admin'])],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'role.in' => 'Role pengguna tidak valid.',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $roleId = $this->roleId($validated['role']);
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role_id' => $roleId,
            ];
            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }
            $user->update($data);
            $this->ensureRoleProfile($user, $roleId);
        });

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
