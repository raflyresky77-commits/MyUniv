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
<body class="bg-[#F8FBFF] min-h-screen text-gray-800 flex overflow-x-hidden">

    <!-- Backdrop Sidebar Mobile -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.03)] h-screen sticky top-0">
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
                    Dashboard Utama
                </a>

                <a href="{{ route('admin.assessments.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Bank Soal Asesmen
                </a>

                <a href="{{ route('admin.universities.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Kelola Perguruan Tinggi</span>
                </a>

                <a href="{{ route('admin.majors.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Program Studi & Jurusan
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen Pengguna
                </a>
            </nav>
        </div>

        <div class="p-5 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50/80 rounded-xl transition font-bold group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Navbar -->
        <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-6 flex justify-between items-center sticky top-0 z-30 shadow-xs w-full">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleSidebar()" class="md:hidden relative z-40 p-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Modul Akademik</span>
                <span class="text-gray-300 font-light hidden sm:inline">/</span>
                <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Kelola Perguruan Tinggi & Program Studi</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-extrabold text-gray-900 leading-tight">Administrator Utama</div>
                    <div class="text-xs font-semibold text-gray-400">admin@myuniv.test</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-200/50">AD</div>
            </div>
        </header>

        <!-- Page Body Content -->
        <main class="p-8 max-w-7xl w-full mx-auto space-y-8">
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

            <!-- Header Section dengan Desain Gradien Oval Estetik -->
            <div class="bg-gradient-myuniv text-white p-8 sm:p-10 rounded-[28px] shadow-xl shadow-indigo-900/10 relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <!-- Aksen Gradien Oval Dekoratif -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#FF7A59]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-indigo-400/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full mb-4 shadow-md shadow-orange-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Database Kampus & Mitra
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight mb-2">Daftar Perguruan Tinggi Mitra</h2>
                    <p class="text-indigo-100 text-sm leading-relaxed font-medium">Kelola profil perguruan tinggi, lokasi pusat, catatan cabang, akreditasi, jenis, serta program studi.</p>
                </div>
                <div class="relative z-10">
                    <button type="button" onclick="openAddUniversityModal()" class="px-6 py-3.5 bg-[#FF7A59] hover:bg-[#e06848] text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-orange-500/30 transition-all flex items-center gap-2.5 cursor-pointer whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Perguruan Tinggi</span>
                    </button>
                </div>
            </div>

            <!-- Search Bar Interaktif -->
            <div class="bg-white p-4 rounded-[24px] border border-[#E2E8F0] shadow-xs flex items-center gap-3">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="searchInput" onkeyup="filterUniversities()" placeholder="Cari berdasarkan nama perguruan tinggi, kota lokasi pusat, catatan cabang, atau program studi..." class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white transition">
                </div>
                <div id="searchCounter" class="text-xs font-bold text-gray-400 px-3 hidden sm:block whitespace-nowrap"></div>
            </div>

            <!-- List Perguruan Tinggi & Tabel Komprehensif -->
            <div class="space-y-6" id="universityContainer">
                @php $no = 1; @endphp
                @forelse($universities as $university)
                <div id="university-card-{{ $university->id }}" class="bg-white rounded-[24px] shadow-sm border border-[#E2E8F0] p-6 space-y-6 custom-card-shape relative overflow-hidden">

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
        <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl border border-gray-100 overflow-hidden">
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

                <div class="grid grid-cols-2 gap-4">
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

    <!-- Modal Form Edit Perguruan Tinggi -->
    <div id="editUniversityModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-[#F9FBFF]">
                <h3 class="text-sm font-black text-[#3650A2]">Edit Profil Perguruan Tinggi</h3>
                <button type="button" onclick="closeEditUniversityModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg cursor-pointer">&times;</button>
            </div>

            <form id="editUniversityForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Perguruan Tinggi</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-medium bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:bg-white">
                </div>

                <div class="grid grid-cols-2 gap-4">
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
            </form>
        </div>
    </div>

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

        function handleDeleteUniversity(event, cardId) {
            event.preventDefault();
            const form = event.target.closest('form');
            const card = document.getElementById(cardId);

            Swal.fire({
                title: 'Hapus Perguruan Tinggi Ini?',
                text: "Semua data program studi di dalam perguruan tinggi ini juga akan ikut terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus PT!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[24px]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (card) card.classList.add('deleting-animation');
                    setTimeout(() => {
                        form.submit();
                    }, 400);
                }
            });
        }

        function handleDeleteMajor(event, rowId) {
            event.preventDefault();
            const form = event.target.closest('form');
            const row = document.getElementById(rowId);

            Swal.fire({
                title: 'Hapus Program Studi?',
                text: "Data program studi ini akan dihapus permanen.",
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
