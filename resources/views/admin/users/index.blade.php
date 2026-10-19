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
<body class="bg-[#F8FBFF] text-gray-800 antialiased min-h-screen">

    <x-admin-sidebar active="users" />

    <x-admin-topbar module="Panel Kontrol" page-title="Manajemen Pengguna" />

    <!-- Main Content Area -->
    <div class="w-full min-w-0 pt-24 md:ml-72 md:w-[calc(100%-18rem)]">
        <main class="mx-auto w-full max-w-7xl min-w-0 space-y-6 p-4 sm:space-y-8 sm:p-6 lg:p-8">

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

            <x-admin-page-header
                label="Kontrol Akses Sistem"
                title="Kelola Akun Pengguna"
                description="Atur hak akses akun sistem untuk Admin, Counselor (Guru BK), dan Student (Siswa) dengan aman dan terstruktur."
            >
                <x-slot:action>
                    <button type="button" onclick="openAddUserModal()" class="inline-flex items-center gap-2 rounded-2xl bg-[#FF7A59] px-5 py-3.5 text-xs font-extrabold text-white shadow-lg shadow-orange-500/30 transition hover:bg-[#e06848] cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah Pengguna Baru
                    </button>
                </x-slot:action>
            </x-admin-page-header>

            <div class="flex min-w-0 flex-col gap-3 rounded-[24px] border border-[#E2E8F0] bg-white p-3 shadow-sm sm:flex-row sm:items-center sm:p-4">
                <x-search-input
                    id="searchInput"
                    placeholder="Cari berdasarkan nama atau email pengguna..."
                    onkeyup="filterUsers()"
                    wrapper-class="relative w-full min-w-0 flex-1"
                    input-class="w-full min-w-0 rounded-xl border border-gray-200 bg-gray-50/50 py-3 pl-11 pr-4 text-xs font-medium transition focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20"
                />
                <div id="searchCounter" class="hidden whitespace-nowrap px-3 text-xs font-bold text-gray-400 sm:block"></div>
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
                                    <button
                                        type="button"
                                        onclick="openEditUserModal(this)"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $roleValue }}"
                                        class="inline-flex items-center gap-1 px-3.5 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-xl transition text-xs cursor-pointer"
                                    >
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
        <div class="max-h-[90dvh] w-full max-w-lg overflow-y-auto rounded-[28px] border border-gray-100 bg-white shadow-2xl">
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

    <!-- Modal edit menggunakan komponen generik -->
    <x-edit-modal
        id="editUserModal"
        title="Edit Akun Pengguna"
        form-id="editUserForm"
        max-width="max-w-lg"
        close-function="closeEditUserModal()"
    >
        <div>
            <label class="mb-1 block text-xs font-bold text-gray-700">Nama Lengkap</label>
            <input type="text" id="edit_name" name="name" required class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20">
        </div>
        <div>
            <label class="mb-1 block text-xs font-bold text-gray-700">Alamat Email</label>
            <input type="email" id="edit_email" name="email" required class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20">
        </div>
        <div>
            <label class="mb-1 block text-xs font-bold text-gray-700">Role Akses Sistem</label>
            <select id="edit_role" name="role" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-xs font-medium focus:bg-white focus:outline-none">
                <option value="student">Student (Siswa)</option>
                <option value="counselor">Counselor (Guru BK)</option>
                <option value="admin">Admin (Administrator)</option>
            </select>
        </div>
        <div>
            <label class="mb-1 block text-xs font-bold text-gray-700">Password Baru <span class="font-normal text-gray-400">(Opsional, kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password" autocomplete="new-password" placeholder="••••••••" class="w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20">
        </div>
        <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
            <button type="button" onclick="closeEditUserModal()" class="cursor-pointer rounded-xl px-4 py-2.5 text-xs font-bold text-gray-500 transition hover:bg-gray-100">Batal</button>
            <button type="button" onclick="confirmEditUser(event)" class="cursor-pointer rounded-xl bg-gradient-myuniv px-6 py-2.5 text-xs font-extrabold text-white shadow-md transition hover:opacity-95">Perbarui Akun</button>
        </div>
    </x-edit-modal>

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
        function openEditUserModal(button) {
            const modal = document.getElementById('editUserModal');
            const form = document.getElementById('editUserForm');

            if (!modal || !form || !button) return;

            const { id, name, email, role } = button.dataset;
            form.action = `/admin/users/${encodeURIComponent(id)}`;

            document.getElementById('edit_name').value = name || '';
            document.getElementById('edit_email').value = email || '';
            document.getElementById('edit_role').value = role || 'student';

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
