<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Perguruan Tinggi - Admin MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        /* Custom Polygon Card Shape yang unik */
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
<body class="bg-[#F8FBFF] min-h-screen text-gray-800 flex overflow-x-hidden overflow-y-auto">

    {{-- Navigasi admin reusable --}}
    <x-admin-sidebar active="universities" />

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 w-full md:ml-72">

        {{-- Topbar admin reusable --}}
        <x-admin-topbar module="Modul Akademik" page-title="Kelola Perguruan Tinggi & Program Studi" />

        <!-- Page Body Content -->
        <main class="pt-24 sm:pt-28 p-4 sm:px-6 sm:pb-6 lg:px-8 lg:pb-8 max-w-7xl w-full min-w-0 mx-auto space-y-6 sm:space-y-8">
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

            {{-- Header halaman admin reusable --}}
            <x-admin-page-header
                label="Database Kampus & Mitra"
                title="Daftar Perguruan Tinggi Mitra"
                description="Kelola profil perguruan tinggi, lokasi pusat, catatan cabang, akreditasi, jenis, serta program studi."
                button-text="Tambah Perguruan Tinggi"
                button-onclick="openAddUniversityModal()"
            />

            <!-- Search Bar menggunakan component reusable dan tetap responsif -->
            <div class="bg-white p-3 sm:p-4 rounded-[24px] border border-[#E2E8F0] shadow-xs flex flex-col sm:flex-row items-stretch sm:items-center gap-3 min-w-0">
                {{-- Input search reusable dengan live filter saat mengetik --}}
                <x-search-input
                    id="searchInput"
                    placeholder="Cari berdasarkan nama perguruan tinggi, kota lokasi pusat, catatan cabang, atau program studi..."
                    onkeyup="filterUniversities()"
                    wrapper-class="relative flex-1 min-w-0 w-full"
                    input-class="w-full min-w-0 pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white transition"
                />

                {{-- Jumlah hasil ditampilkan di layar yang cukup lebar --}}
                <div id="searchCounter" class="text-xs font-bold text-gray-400 px-3 hidden sm:block whitespace-nowrap"></div>
            </div>

            <!-- List Perguruan Tinggi & Tabel Komprehensif -->
            <div class="space-y-6" id="universityContainer">
                @php $no = 1; @endphp
                @forelse($universities as $university)
                <div id="university-card-{{ $university->id }}" class="bg-white rounded-[24px] shadow-sm border border-[#E2E8F0] p-4 sm:p-6 space-y-5 sm:space-y-6 custom-card-shape relative overflow-hidden min-w-0">

                    <!-- Header Kartu Perguruan Tinggi -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-4">
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full text-xs font-extrabold border border-indigo-100 custom-badge-shape">
                                    {{ $university->type ?? 'Swasta' }}
                                </span>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-extrabold border border-emerald-100">
                                    Akreditasi PT: {{ $university->accreditation ?? 'Unggul' }}
                                </span>
                            </div>
                            <h2 class="text-xl font-black text-[#3650A2] mt-2">{{ $university->name }}</h2>
                            <div class="text-xs text-gray-500 font-medium space-y-0.5 mt-1">
                                <p class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Lokasi Pusat: <strong class="text-gray-700">{{ $university->location ?? '-' }}</strong>
                                </p>
                                @if(!empty($university->branch_notes))
                                <p class="text-gray-400 text-[11px] italic pl-4">
                                    Cabang: {{ $university->branch_notes }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <!-- Tombol Aksi PT -->
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="openEditUniversityModal({{ $university->id }}, '{{ addslashes($university->name) }}', '{{ $university->location }}', '{{ $university->accreditation }}', '{{ $university->type }}', '{{ addslashes($university->branch_notes ?? '') }}')" class="px-3.5 py-2 bg-amber-50 text-amber-700 hover:bg-amber-100 transition rounded-xl text-xs font-bold flex items-center gap-1 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit PT
                            </button>
                            <form action="{{ route('admin.universities.destroy', $university->id) }}" method="POST" onsubmit="handleDeleteUniversity(event, 'university-card-{{ $university->id }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3.5 py-2 bg-red-50 text-red-600 hover:bg-red-100 transition rounded-xl text-xs font-bold flex items-center gap-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus PT
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Detail Program Studi & Form Tambah -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-[#F9FBFF] border-b border-gray-100 text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">
                                        <th class="py-3 px-3 w-10 text-center">No</th>
                                        <th class="py-3 px-3">Perguruan Tinggi</th>
                                        <th class="py-3 px-3">Jenis/Status</th>
                                        <th class="py-3 px-3">Lokasi</th>
                                        <th class="py-3 px-3">Program Studi</th>
                                        <th class="py-3 px-3">Jenjang</th>
                                        <th class="py-3 px-3">Akreditasi</th>
                                        <th class="py-3 px-3 text-center">Aksi Prodi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-xs">
                                    @php $subNo = 1; @endphp
                                    @forelse($university->majors as $major)
                                    <tr id="major-row-{{ $major->id }}">
                                        <td class="py-3 px-3 text-center font-bold text-gray-400">{{ $subNo++ }}</td>
                                        <td class="py-3 px-3 font-bold text-gray-700">{{ $university->name }}</td>
                                        <td class="py-3 px-3 font-semibold text-gray-600">{{ $university->type ?? 'Swasta' }}</td>
                                        <td class="py-3 px-3 text-gray-500">{{ $university->location ?? '-' }}</td>
                                        <td class="py-3 px-3 font-bold text-gray-900">{{ $major->name }}</td>
                                        <td class="py-3 px-3 font-extrabold text-[#3650A2]">{{ $major->degree ?? 'S1' }}</td>
                                        <td class="py-3 px-3">
                                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 font-extrabold text-[10px] rounded">
                                                {{ $major->accreditation ?? 'Unggul' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <form action="{{ route('admin.majors.destroy.custom', $major->id) }}" method="POST" onsubmit="handleDeleteMajor(event, 'major-row-{{ $major->id }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold cursor-pointer">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="py-4 text-center text-gray-400 text-xs font-medium">Belum ada program studi terdaftar di perguruan tinggi ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Form Inline Tambah Prodi -->
                        <div class="bg-[#F8FBFF] p-4 rounded-2xl border border-indigo-50">
                            <h4 class="text-xs font-black text-[#3650A2] uppercase tracking-wider mb-3">+ Tambah Prodi ke PT Ini</h4>
                            <form action="{{ route('admin.universities.majors.store', $university->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <div>
                                    <input type="text" name="name" required placeholder="Nama Prodi (Cth: Sistem Informasi)" class="w-full px-3 py-2 rounded-xl border border-gray-200 text-xs font-medium bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <select name="degree" class="px-3 py-2 rounded-xl border border-gray-200 text-xs font-medium bg-white focus:outline-none">
                                        <option value="S1">Jenjang S1</option>
                                        <option value="D4">Jenjang D4</option>
                                        <option value="D3">Jenjang D3</option>
                                        <option value="S2">Jenjang S2</option>
                                    </select>
                                    <select name="accreditation" class="px-3 py-2 rounded-xl border border-gray-200 text-xs font-medium bg-white focus:outline-none">
                                        <option value="Unggul">Akreditasi Unggul</option>
                                        <option value="Baik Sekali">Akreditasi Baik Sekali</option>
                                        <option value="Baik">Akreditasi Baik</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full py-2 bg-gradient-myuniv text-white rounded-xl font-extrabold text-xs shadow-md hover:opacity-95 transition cursor-pointer">
                                    Simpan Prodi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-[24px] p-12 text-center border border-[#E2E8F0]">
                    <p class="text-gray-400 text-sm font-semibold">Belum ada data perguruan tinggi yang tersimpan.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>

    <!-- Modal Form Tambah Perguruan Tinggi -->
    <div id="addUniversityModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white w-full max-w-lg max-h-[90dvh] overflow-y-auto rounded-[28px] shadow-2xl border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#F9FBFF]">
                <h3 class="text-sm font-black text-[#3650A2]">Tambah Perguruan Tinggi Baru</h3>
                <button type="button" onclick="closeAddUniversityModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.universities.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Perguruan Tinggi</label>
                    <input type="text" name="name" required placeholder="Cth: Universitas Telkom" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Lokasi Pusat (Dataset Kota)</label>
                        <select name="location" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                            <option value="">Pilih Kota Utama</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Semarang">Semarang</option>
                            <option value="Depok">Depok</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Medan">Medan</option>
                            <option value="Makassar">Makassar</option>
                            <option value="Bali">Bali</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Perguruan Tinggi</label>
                        <select name="type" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                            <option value="Swasta">Swasta (PTS)</option>
                            <option value="Negeri">Negeri (PTN)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Akreditasi Perguruan Tinggi</label>
                    <select name="accreditation" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                        <option value="Unggul">Unggul</option>
                        <option value="Baik Sekali">Baik Sekali</option>
                        <option value="Baik">Baik</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Cabang Perguruan Tinggi <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <textarea name="branch_notes" rows="2" placeholder="Cth: Memiliki cabang di Jakarta, Bandung, dan Surabaya" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeAddUniversityModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Simpan Perguruan Tinggi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal edit menggunakan komponen generik; field mengikuti data perguruan tinggi. --}}
    <x-edit-modal
        id="editUniversityModal"
        title="Edit Profil Perguruan Tinggi"
        form-id="editUniversityForm"
        max-width="max-w-lg"
        close-function="closeEditUniversityModal()"
        method="PUT"
        class="space-y-4 p-6"
    >
        <div>
            <label class="block text-xs font-bold text-gray-700 mb-1">Nama Perguruan Tinggi</label>
            <input type="text" id="edit_name" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Lokasi Pusat (Dataset Kota)</label>
                <select id="edit_location" name="location" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                    <option value="Bandung">Bandung</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Malang">Malang</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Depok">Depok</option>
                    <option value="Bogor">Bogor</option>
                    <option value="Medan">Medan</option>
                    <option value="Makassar">Makassar</option>
                    <option value="Bali">Bali</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Perguruan Tinggi</label>
                <select id="edit_type" name="type" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                    <option value="Swasta">Swasta (PTS)</option>
                    <option value="Negeri">Negeri (PTN)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-700 mb-1">Akreditasi Perguruan Tinggi</label>
            <select id="edit_accreditation" name="accreditation" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:bg-white">
                <option value="Unggul">Unggul</option>
                <option value="Baik Sekali">Baik Sekali</option>
                <option value="Baik">Baik</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Cabang Perguruan Tinggi</label>
            <textarea id="edit_branch_notes" name="branch_notes" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white"></textarea>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
            <button type="button" onclick="closeEditUniversityModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition cursor-pointer">Batal</button>
            <button type="button" onclick="confirmEditUniversity(event)" class="px-6 py-2.5 bg-gradient-myuniv text-white rounded-xl text-xs font-extrabold shadow-md hover:opacity-95 transition cursor-pointer">Perbarui Perguruan Tinggi</button>
        </div>
    </x-edit-modal>

    {{-- Konfirmasi hapus reusable untuk perguruan tinggi dan program studi. --}}
    <x-confirm-delete
        function-name="handleDeleteUniversity"
        title="Hapus Perguruan Tinggi Ini?"
        text="Semua data program studi di dalam perguruan tinggi ini juga akan ikut terhapus!"
        confirm-text="Ya, Hapus PT!"
    />
    <x-confirm-delete
        function-name="handleDeleteMajor"
        title="Hapus Program Studi?"
        text="Data program studi ini akan dihapus permanen."
        confirm-text="Ya, Hapus!"
    />

    <!-- JavaScript Scripting -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function openAddUniversityModal() {
            document.getElementById('addUniversityModal').classList.remove('hidden');
        }
        function closeAddUniversityModal() {
            document.getElementById('addUniversityModal').classList.add('hidden');
        }

        function openEditUniversityModal(id, name, location, accreditation, type, branchNotes) {
            const modal = document.getElementById('editUniversityModal');
            const form = document.getElementById('editUniversityForm');

            form.action = `/admin/universities/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_accreditation').value = accreditation;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_branch_notes').value = branchNotes;

            modal.classList.remove('hidden');
        }
        function closeEditUniversityModal() {
            document.getElementById('editUniversityModal').classList.add('hidden');
        }

        function filterUniversities() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('[id^="university-card-"]');
            let visibleCount = 0;

            cards.forEach(card => {
                const textContent = card.textContent.toLowerCase();
                if (textContent.includes(filter)) {
                    card.style.display = "";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });

            const counter = document.getElementById('searchCounter');
            if (filter.length > 0) {
                counter.textContent = `Ditemukan ${visibleCount} kampus`;
                counter.classList.remove('hidden');
            } else {
                counter.classList.add('hidden');
            }
        }

        function confirmEditUniversity(event) {
            event.preventDefault();
            const form = document.getElementById('editUniversityForm');

            Swal.fire({
                title: 'Perbarui Data Perguruan Tinggi?',
                text: "Perubahan profil perguruan tinggi akan langsung diterapkan ke sistem.",
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

    </script>
</body>
</html>
