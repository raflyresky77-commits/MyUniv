<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Admin MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .custom-card-shape {
            clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        }
        .deleting-animation {
            transition: all 0.4s ease-in-out !important;
            opacity: 0 !important;
            transform: scale(0.95) !important;
            background-color: #fee2e2 !important;
        }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- Backdrop Sidebar Mobile -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.03)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5">
                <div class="h-10 flex items-center justify-center">
                    <img src="{{ asset('images/icon.png') }}" alt="MyUniv Logo" class="h-10 w-auto object-contain">
                </div>
                <div>
                    <span class="text-lg font-black text-[#3650A2] tracking-tight leading-none block">MyUniv</span>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-1 block">Enterprise OS</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.assessments.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Bank Soal Asesmen
                </a>

                <a href="{{ route('admin.universities.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Perguruan Tinggi
                </a>

                <a href="{{ route('admin.majors.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    <span>Program Studi & Jurusan</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Manajemen Pengguna</span>
                </a>
            </nav>
        </div>

        <div class="p-5 border-t border-gray-100 bg-white">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50/80 rounded-xl transition font-bold group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-6 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden relative z-50 p-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Panel Kontrol</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Manajemen Pengguna</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">Administrator Utama</div>
                <div class="text-xs font-semibold text-gray-400">admin@myuniv.test</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-200/50">AD</div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-24 min-h-screen flex flex-col flex-1">
        <main class="p-6 md:p-8 space-y-8 max-w-7xl w-full mx-auto flex-1">

            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 2500,
                        showConfirmButton: false,
                        customClass: { popup: 'rounded-[24px]' }
                    });
                });
            </script>
            @endif

            @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal!',
                        text: "Mohon periksa kembali form input Anda.",
                        customClass: { popup: 'rounded-[24px]' }
                    });
                });
            </script>
            @endif

            <!-- Hero Banner Estetik -->
            <div class="bg-gradient-myuniv text-white p-8 sm:p-10 rounded-[28px] shadow-xl shadow-indigo-900/10 relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#FF7A59]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-indigo-400/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full mb-4 shadow-md shadow-orange-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Kontrol Akses Sistem
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight mb-2">Kelola Akun Pengguna</h2>
                    <p class="text-indigo-100 text-sm leading-relaxed font-medium">Atur hak akses akun sistem untuk Admin, Counselor (Guru BK), dan Student (Siswa) dengan aman dan terstruktur.</p>
                </div>

                <!-- Tombol Tambah Pengguna Baru -->
                <div class="relative z-10">
                    <button type="button" onclick="openAddUserModal()" class="inline-flex items-center gap-2 px-6 py-3.5 bg-white text-[#3650A2] hover:bg-indigo-50 font-black rounded-2xl shadow-lg transition duration-200 text-xs cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Pengguna Baru
                    </button>
                </div>
            </div>

            <!-- Search Bar Interaktif -->
            <div class="bg-white p-4 rounded-[24px] border border-[#E2E8F0] shadow-xs flex items-center gap-3">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="searchInput" onkeyup="filterUsers()" placeholder="Cari berdasarkan nama atau email pengguna..." class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white transition">
                </div>
                <div id="searchCounter" class="text-xs font-bold text-gray-400 px-3 hidden sm:block whitespace-nowrap"></div>
            </div>

            <!-- Tabel Data Pengguna -->
            <div class="bg-white rounded-[24px] border border-[#E2E8F0] shadow-sm overflow-hidden custom-card-shape">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FBFF] border-b border-[#E2E8F0] text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">
                                <th class="py-4 px-6">Nama & Email</th>
                                <th class="py-4 px-6">Role Akses</th>
                                <th class="py-4 px-6">Tanggal Terdaftar</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-600" id="usersTableBody">
                            @forelse($users as $user)
                            <tr id="user-row-{{ $user->id }}" class="hover:bg-[#F8FBFF]/80 transition">
                                <td class="py-4 px-6">
                                    <div class="font-extrabold text-gray-900 text-sm">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-400 font-medium">{{ $user->email }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $roleName = '';
                                        if (is_object($user->role)) {
                                            $roleName = strtolower($user->role->name ?? $user->role->slug ?? '');
                                        } else {
                                            $roleName = strtolower((string) ($user->role ?? ''));
                                        }

                                        $roleId = is_object($user->role) ? ($user->role->id ?? 1) : (int)($user->role ?? 1);

                                        if (str_contains($roleName, 'admin') || $roleId === 3) {
                                            $badgeColor = 'bg-purple-50 text-purple-700 border-purple-100';
                                            $roleLabel = 'Admin';
                                            $roleValue = 'admin';
                                        } elseif (str_contains($roleName, 'counselor') || str_contains($roleName, 'guru') || str_contains($roleName, 'bk') || $roleId === 2) {
                                            $badgeColor = 'bg-blue-50 text-blue-700 border-blue-100';
                                            $roleLabel = 'Counselor';
                                            $roleValue = 'counselor';
                                        } else {
                                            $badgeColor = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                            $roleLabel = 'Student';
                                            $roleValue = 'student';
                                        }
                                    @endphp
                                    <span class="px-3 py-1 rounded-xl text-[10px] font-extrabold border {{ $badgeColor }}">
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500 font-medium">
                                    {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                    <!-- Tombol Edit Modal Tanpa Pindah Halaman -->
                                    <button type="button" onclick="openEditUserModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $roleValue }}')" class="inline-flex items-center gap-1 px-3.5 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-xl transition text-xs cursor-pointer">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="handleDeleteUser(event, 'user-row-{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3.5 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl transition text-xs cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400 font-medium text-xs">Belum ada data pengguna yang terdaftar di sistem.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Form Tambah Pengguna -->
    <div id="addUserModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#F9FBFF]">
                <h3 class="text-sm font-black text-[#3650A2]">Tambah Akun Pengguna Baru</h3>
                <button type="button" onclick="closeAddUserModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form id="addUserForm" action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" required placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Role Akses Sistem</label>
                    <select name="role" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                        <option value="student">Student (Siswa)</option>
                        <option value="counselor">Counselor (Guru BK)</option>
                        <option value="admin">Admin (Administrator)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Akun</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeAddUserModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="button" onclick="confirmAddUser(event)" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Form Edit Pengguna -->
    <div id="editUserModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#F9FBFF]">
                <h3 class="text-sm font-black text-[#3650A2]">Edit Akun Pengguna</h3>
                <button type="button" onclick="closeEditUserModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form id="editUserForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" id="edit_email" name="email" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Role Akses Sistem</label>
                    <select id="edit_role" name="role" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                        <option value="student">Student (Siswa)</option>
                        <option value="counselor">Counselor (Guru BK)</option>
                        <option value="admin">Admin (Administrator)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Baru <span class="text-gray-400 font-normal">(Opsional, kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeEditUserModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="button" onclick="confirmEditUser(event)" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Fungsionalitas -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        // Modal Tambah Pengguna
        function openAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
        }

        function confirmAddUser(event) {
            event.preventDefault();
            const form = document.getElementById('addUserForm');

            Swal.fire({
                title: 'Tambah Pengguna Baru?',
                text: "Akun baru akan langsung terdaftar di dalam sistem.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3650A2',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[24px]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Modal Edit Pengguna
        function openEditUserModal(id, name, email, role) {
            const modal = document.getElementById('editUserModal');
            const form = document.getElementById('editUserForm');

            form.action = `/admin/users/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;

            modal.classList.remove('hidden');
        }

        function closeEditUserModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }

        function confirmEditUser(event) {
            event.preventDefault();
            const form = document.getElementById('editUserForm');

            Swal.fire({
                title: 'Perbarui Akun Pengguna?',
                text: "Perubahan data akun akan langsung disimpan ke sistem.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3650A2',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Perbarui!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[24px]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function filterUsers() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTableBody tr[id^="user-row-"]');
            let visibleCount = 0;

            rows.forEach(row => {
                const textContent = row.textContent.toLowerCase();
                if (textContent.includes(filter)) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });

            const counter = document.getElementById('searchCounter');
            if (filter.length > 0) {
                counter.textContent = `Ditemukan ${visibleCount} pengguna`;
                counter.classList.remove('hidden');
            } else {
                counter.classList.add('hidden');
            }
        }

        function handleDeleteUser(event, rowId, userName) {
            event.preventDefault();
            const form = event.target.closest('form');
            const row = document.getElementById(rowId);

            Swal.fire({
                title: 'Hapus Akun Pengguna?',
                text: `Apakah Anda yakin ingin menghapus akun ${userName} ini? Tindakan ini permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[24px]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (row) row.classList.add('deleting-animation');
                    setTimeout(() => {
                        form.submit();
                    }, 400);
                }
            });
        }
    </script>
</body>
</html>
