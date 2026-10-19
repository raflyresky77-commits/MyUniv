<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jurusan & Program Studi - Admin MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .custom-card-shape {
            clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        }
        .custom-badge-shape {
            clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
        }
        .deleting-animation {
            transition: all 0.4s ease-in-out !important;
            opacity: 0 !important;
            transform: scale(0.95) !important;
            background-color: #fee2e2 !important;
        }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased min-h-screen overflow-x-hidden">

    <x-admin-sidebar active="majors" />

    <x-admin-topbar module="Modul Akademik" page-title="Manajemen Program Studi" />


    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-6 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden relative z-50 p-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Modul Akademik</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Manajemen Program Studi</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">Administrator Utama</div>
                <div class="text-xs font-semibold text-gray-400">admin@myuniv.test</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-200/50">AD</div>
        </div>
    </header>

    <!-- Konten utama diberi jarak dari topbar fixed agar tidak tertutup. -->
    <div class="md:ml-72 pt-24 sm:pt-28 min-h-screen">
        <main class="p-4 sm:p-6 lg:p-8 space-y-6 sm:space-y-8 max-w-7xl w-full mx-auto">

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

            <x-admin-page-header
                label="Database Peminatan & Jurusan"
                title="Daftar Program Studi / Jurusan"
                description="Kelola direktori lengkap program studi, fakultas, jenjang pendidikan, serta deskripsi untuk rekomendasi asesmen siswa."
                button-text="Tambah Jurusan Baru"
                button-onclick="openAddMajorModal()"
            />

            <!-- Pencarian reusable dengan filter langsung saat mengetik. -->
            <div class="flex min-w-0 flex-col items-stretch gap-3 rounded-[24px] border border-[#E2E8F0] bg-white p-3 shadow-xs sm:flex-row sm:items-center sm:p-4">
                <x-search-input
                    id="searchInput"
                    placeholder="Cari nama prodi, fakultas, atau deskripsi..."
                    onkeyup="filterMajors()"
                    wrapper-class="relative min-w-0 w-full flex-1"
                    input-class="w-full min-w-0 rounded-xl border border-gray-200 bg-gray-50/50 py-3 pl-11 pr-4 text-xs font-medium transition focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20"
                />
                <div id="searchCounter" class="hidden whitespace-nowrap px-3 text-xs font-bold text-gray-400 sm:block"></div>
            </div>

            <!-- Tabel Data Jurusan -->
            <div class="bg-white rounded-[24px] border border-[#E2E8F0] shadow-sm overflow-hidden custom-card-shape">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FBFF] border-b border-[#E2E8F0] text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">
                                <th class="py-4 px-6 w-12 text-center">No</th>
                                <th class="py-4 px-6">Nama Program Studi / Jurusan</th>
                                <th class="py-4 px-6">Fakultas / Bidang</th>
                                <th class="py-4 px-6">Jenjang</th>
                                <th class="py-4 px-6">Deskripsi Singkat</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-600" id="majorsTableBody">
                            @php $no = 1; @endphp
                            @forelse($majors ?? [] as $major)
                            <tr id="major-row-{{ $major->id }}" class="hover:bg-[#F8FBFF]/80 transition">
                                <td class="py-4 px-6 text-center font-bold text-gray-400">{{ $no++ }}</td>
                                <td class="py-4 px-6 font-extrabold text-gray-900 text-sm">
                                    {{ $major->name }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 bg-indigo-50 text-[#3650A2] font-extrabold rounded-xl text-[10px] border border-indigo-100">
                                        {{ $major->faculty ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-extrabold text-[#3650A2]">
                                        {{ $major->degree ?? 'S1' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500 max-w-xs truncate">
                                    {{ $major->description ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                    <button type="button" onclick='openEditMajorModal({{ $major->id }}, @json($major->name), @json($major->faculty ?? ""), @json($major->degree ?? "S1"), @json($major->description ?? ""))' class="inline-flex items-center gap-1 px-3.5 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-xl transition text-xs cursor-pointer">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" class="inline-block" onsubmit="handleDeleteMajor(event, 'major-row-{{ $major->id }}')">
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
                                <td colspan="6" class="py-12 text-center text-gray-400 font-medium text-xs">Belum ada data program studi atau jurusan yang tersimpan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Form Tambah Jurusan -->
    <div id="addMajorModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#F9FBFF]">
                <h3 class="text-sm font-black text-[#3650A2]">Tambah Program Studi Baru</h3>
                <button type="button" onclick="closeAddMajorModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.majors.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Program Studi / Jurusan</label>
                    <input type="text" name="name" required placeholder="Cth: Teknik Informatika" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Fakultas / Bidang</label>
                        <input type="text" name="faculty" required placeholder="Cth: Fakultas Teknik" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenjang Pendidikan</label>
                        <select name="degree" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                            <option value="S1">S1 (Sarjana)</option>
                            <option value="D4">D4 (Sarjana Terapan)</option>
                            <option value="D3">D3 (Diploma Tiga)</option>
                            <option value="S2">S2 (Magister)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Singkat <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <textarea name="description" rows="3" placeholder="Penjelasan ringkas mengenai fokus program studi..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeAddMajorModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Simpan Program Studi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal edit menggunakan komponen generik; field khusus prodi tetap di halaman ini. -->
    <x-edit-modal
        id="editMajorModal"
        title="Edit Program Studi"
        form-id="editMajorForm"
        max-width="max-w-lg"
        close-function="closeEditMajorModal()"
        method="PUT"
        class="space-y-4 p-6"
    >
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Program Studi / Jurusan</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Fakultas / Bidang</label>
                        <input type="text" id="edit_faculty" name="faculty" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenjang Pendidikan</label>
                        <select id="edit_degree" name="degree" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                            <option value="S1">S1 (Sarjana)</option>
                            <option value="D4">D4 (Sarjana Terapan)</option>
                            <option value="D3">D3 (Diploma Tiga)</option>
                            <option value="S2">S2 (Magister)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea id="edit_description" name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeEditMajorModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="button" onclick="confirmEditMajor(event)" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Perbarui Program Studi</button>
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

        function openAddMajorModal() {
            document.getElementById('addMajorModal').classList.remove('hidden');
        }
        function closeAddMajorModal() {
            document.getElementById('addMajorModal').classList.add('hidden');
        }

        function openEditMajorModal(id, name, faculty, degree, description) {
            const modal = document.getElementById('editMajorModal');
            const form = document.getElementById('editMajorForm');

            form.action = `/admin/majors/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_faculty').value = faculty;
            document.getElementById('edit_degree').value = degree;
            document.getElementById('edit_description').value = description;

            modal.classList.remove('hidden');
        }
        function closeEditMajorModal() {
            document.getElementById('editMajorModal').classList.add('hidden');
        }

        function filterMajors() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll('#majorsTableBody tr[id^="major-row-"]');
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
                counter.textContent = `Ditemukan ${visibleCount} prodi`;
                counter.classList.remove('hidden');
            } else {
                counter.classList.add('hidden');
            }
        }

        function confirmEditMajor(event) {
            event.preventDefault();
            const form = document.getElementById('editMajorForm');

            Swal.fire({
                title: 'Perbarui Program Studi?',
                text: "Perubahan data jurusan akan langsung disimpan ke sistem.",
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

        function handleDeleteMajor(event, rowId) {
            event.preventDefault();
            const form = event.target.closest('form');
            const row = document.getElementById(rowId);

            Swal.fire({
                title: 'Hapus Program Studi?',
                text: "Data jurusan ini akan dihapus permanen dari sistem.",
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
