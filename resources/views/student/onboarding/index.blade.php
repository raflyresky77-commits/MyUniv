<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Data Diri | MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Background Gradasi Indah & Dinamis */
            background: linear-gradient(135deg, #E2EEFF 0%, #F4F7FF 50%, #FFF0EC 100%);
            min-height: 100vh;
        }
        .myuniv-gradient { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }

        /* Gaya Glassmorphism Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 20px 50px rgba(54, 80, 162, 0.1);
        }

        .field { width: 100%; border: 1.5px solid #D1DFF7; border-radius: 14px; padding: 12px 14px; background: rgba(255, 255, 255, 0.8); color: #1E2D62; font-size: 13px; font-weight: 600; outline: none; transition: all .25s ease; }
        .field:focus { background: white; border-color: #3650A2; box-shadow: 0 0 0 4px rgba(54,80,162,0.12); }
        .field-label { display: block; font-size: 12px; font-weight: 800; color: #34405B; margin-bottom: 6px; }
        .field-note { display: block; color: #8791A8; font-size: 11px; line-height: 1.4; margin-top: 5px; font-weight: 500; }
        .field-error { border-color: #FF7A59 !important; background: #FFF5F2 !important; }

        /* Keyframe Animasi Shake */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
        }
        .animate-shake {
            animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both;
        }

        /* Keyframe Animasi Pop-up Center */
        @keyframes popUp {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-popup {
            animation: popUp 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="text-slate-800 relative overflow-x-hidden selection:bg-brand-coral selection:text-white">

    @include('components.global-loading')

    <!-- Notifikasi Popup Tengah Layar -->
    <div id="validation-toast" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs hidden transition-all">
        <div class="bg-white/95 backdrop-blur-xl border border-rose-100 shadow-[0_20px_50px_rgba(30,45,98,0.2)] rounded-3xl p-6 max-w-sm w-full text-center relative animate-popup">
            <button type="button" onclick="hideToast()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>

            <div class="w-14 h-14 rounded-2xl bg-[#FFEBE6] text-[#FF7A59] flex items-center justify-center text-2xl mx-auto mb-4 shadow-sm shadow-orange-500/10">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <h4 class="text-base font-black text-[#1E2D62] mb-1">Perhatian!</h4>
            <p id="toast-message" class="text-xs text-slate-500 font-medium leading-relaxed mb-6">Mohon isi semua kolom yang wajib diisi sebelum melanjutkan.</p>

            <button type="button" onclick="hideToast()" class="myuniv-gradient w-full py-3 rounded-xl text-xs font-black text-white shadow-md hover:opacity-95 transition">
                Baik, Saya Lengkapi
            </button>
        </div>
    </div>

    <!-- Dekorasi Background Blobs Cahaya -->
    <div class="absolute top-10 left-10 w-[500px] h-[500px] bg-[#3650A2]/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-[#FF7A59]/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>

    <main class="min-h-screen px-4 py-8 sm:px-6 flex items-center justify-center relative z-10">
        <div class="w-full max-w-2xl">

            <!-- Header Ringkas -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2.5 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-white/80 backdrop-blur-md border border-indigo-100 p-2 shadow-sm">
                        <img src="{{ asset('images/icon.png') }}" onerror="this.src='https://placehold.co/100x100/F4FAFF/3650A2?text=M'" alt="MyUniv" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-black tracking-tight text-[#3650A2]">MyUniv<span class="text-[#FF7A59]">.</span></span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-[#1E2D62]">Lengkapi Data Dirimu</h1>
                <p class="mt-1 text-xs sm:text-sm text-slate-500 max-w-md mx-auto font-medium">
                    Isi informasi profil di bawah ini untuk mengaktifkan akses asesmen dan rekomendasi kampusmu.
                </p>
            </div>

            <!-- Card Utama Form (Glassmorphism) -->
            <section id="form-card" class="glass-card rounded-[28px] overflow-hidden">

                <!-- Indikator Langkah (Progress Bar) -->
                <div class="bg-white/50 px-6 py-4 border-b border-indigo-100/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span id="step-badge" class="w-7 h-7 rounded-lg bg-[#3650A2] text-white flex items-center justify-center text-xs font-black shadow-sm">1</span>
                        <div>
                            <h3 id="step-title" class="text-xs font-extrabold text-[#1E2D62]">Langkah 1: Informasi Pribadi</h3>
                            <p id="step-desc" class="text-[10px] text-slate-500 font-medium">Identitas dasar dan kontak</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span id="dot-1" class="w-6 h-2 rounded-full bg-[#3650A2] transition-all duration-300"></span>
                        <span id="dot-2" class="w-2 h-2 rounded-full bg-slate-300 transition-all duration-300"></span>
                    </div>
                </div>

                <form action="{{ route('student.onboarding.store') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50/80 p-3.5 text-xs text-red-700 flex items-start gap-2">
                            <i class="fa-solid fa-circle-exclamation text-base text-red-500 shrink-0"></i>
                            <div>
                                <p class="font-bold mb-1">Periksa kembali data yang kurang:</p>
                                <ul class="list-disc pl-3 space-y-0.5 font-semibold">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- SLIDE 1: Informasi Pribadi -->
                    <div id="slide-1" class="space-y-4 transition-all duration-300">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="field-label" for="name">Nama Lengkap</label>
                                <input class="field" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="field-label" for="email">Email Akun</label>
                                <input class="field bg-slate-100/70 text-slate-500 cursor-not-allowed" id="email" type="email" value="{{ $user->email }}" readonly>
                                <span class="field-note">Email terhubung otomatis dengan akun login.</span>
                            </div>

                            <div>
                                <label class="field-label">Gender</label>
                                <div class="grid grid-cols-2 gap-2" id="gender-container">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="gender" value="Laki-laki" class="peer hidden" @checked(old('gender', $student->gender) === 'Laki-laki') required>
                                        <div class="border-2 border-slate-200/80 peer-checked:border-[#3650A2] peer-checked:bg-indigo-50/70 rounded-xl p-3 text-center transition bg-white/50">
                                            <span class="block text-base mb-0.5">👦🏻</span>
                                            <span class="text-xs font-bold text-slate-700 peer-checked:text-[#3650A2]">Laki-laki</span>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="gender" value="Perempuan" class="peer hidden" @checked(old('gender', $student->gender) === 'Perempuan') required>
                                        <div class="border-2 border-slate-200/80 peer-checked:border-[#FF7A59] peer-checked:bg-orange-50/70 rounded-xl p-3 text-center transition bg-white/50">
                                            <span class="block text-base mb-0.5">👧🏻</span>
                                            <span class="text-xs font-bold text-slate-700 peer-checked:text-[#FF7A59]">Perempuan</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="field-label" for="birth_date">Tanggal Lahir</label>
                                <input class="field" id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}" max="{{ now()->toDateString() }}" required>
                            </div>

                            <div>
                                <label class="field-label" for="phone">Nomor Telepon / WhatsApp</label>
                                <input class="field" id="phone" name="phone" type="tel" value="{{ old('phone', $student->phone) }}" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div>
                                <label class="field-label" for="address">Kota / Domisili</label>
                                <input class="field" id="address" name="address" type="text" value="{{ old('address', $student->address) }}" placeholder="Contoh: Bandung" required>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="button" onclick="nextSlide()" class="myuniv-gradient rounded-xl px-6 py-3 text-xs font-black text-white shadow-md hover:opacity-95 transition flex items-center gap-2">
                                <span>Selanjutnya: Data Sekolah</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SLIDE 2: Data Sekolah (Disembunyikan default) -->
                    <div id="slide-2" class="space-y-4 hidden transition-all duration-300">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label" for="nisn">Nomor Induk Siswa Nasional (NISN)</label>
                                <input class="field" id="nisn" name="nisn" type="text" inputmode="numeric" maxlength="10" minlength="10" value="{{ old('nisn', $student->nisn) }}" placeholder="10 digit NISN" required>
                                <span class="field-note">NISN harus tepat 10 angka.</span>
                            </div>

                            <div>
                                <label class="field-label" for="class">Kelas Saat Ini</label>
                                <input class="field" id="class" name="class" type="text" value="{{ old('class', $student->class) }}" placeholder="Contoh: XII RPL-2" required>
                                <span class="field-note">Contoh format: XII RPL-2.</span>
                            </div>
                        </div>

                        <div class="bg-indigo-50/70 backdrop-blur-sm rounded-2xl p-4 border border-indigo-100 flex items-center gap-3 mt-4">
                            <span class="text-xl">💡</span>
                            <p class="text-xs text-[#3650A2] font-semibold leading-relaxed">
                                Pastikan NISN dan Kelas yang kamu masukkan sudah benar agar terhubung dengan data guru BK sekolah.
                            </p>
                        </div>

                        <div class="pt-4 flex items-center justify-between">
                            <button type="button" onclick="prevSlide()" class="bg-white/80 hover:bg-white text-slate-600 rounded-xl px-5 py-3 text-xs font-extrabold transition border border-slate-200 flex items-center gap-2 shadow-xs">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span>Kembali</span>
                            </button>

                            <button type="submit" onclick="validateSubmit(event)" class="myuniv-gradient rounded-xl px-6 py-3 text-xs font-black text-white shadow-lg hover:opacity-95 transition flex items-center gap-2">
                                <span class="font-extrabold">Simpan & Masuk ke MyUniv</span>
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </section>

            <p class="text-center text-[10px] text-slate-500 mt-6 font-medium">© {{ date('Y') }} MyUniv · Sistem Informasi Peminatan Siswa</p>
        </div>
    </main>

    <!-- Script Interaktif Slider & Notifikasi Pop-up Tengah -->
    <script>
        function showValidationAlert(msg) {
            const toast = document.getElementById('validation-toast');
            const card = document.getElementById('form-card');
            const messageEl = document.getElementById('toast-message');

            if(msg) messageEl.textContent = msg;

            // Tampilkan Modal Popup di Tengah
            toast.classList.remove('hidden');

            // Trigger Efek Shake pada Card Form di belakangnya
            card.classList.remove('animate-shake');
            void card.offsetWidth; // Force Reflow
            card.classList.add('animate-shake');
        }

        function hideToast() {
            const toast = document.getElementById('validation-toast');
            toast.classList.add('hidden');
        }

        function nextSlide() {
            const name = document.getElementById('name');
            const phone = document.getElementById('phone');
            const address = document.getElementById('address');
            const birthDate = document.getElementById('birth_date');
            const gender = document.querySelector('input[name="gender"]:checked');

            let isValid = true;
            let firstInvalidInput = null;

            // Reset status error
            [name, phone, address, birthDate].forEach(input => input.classList.remove('field-error'));

            // Validasi Input Slide 1
            if (!name.value.trim()) { name.classList.add('field-error'); isValid = false; if(!firstInvalidInput) firstInvalidInput = name; }
            if (!birthDate.value) { birthDate.classList.add('field-error'); isValid = false; if(!firstInvalidInput) firstInvalidInput = birthDate; }
            if (!phone.value.trim()) { phone.classList.add('field-error'); isValid = false; if(!firstInvalidInput) firstInvalidInput = phone; }
            if (!address.value.trim()) { address.classList.add('field-error'); isValid = false; if(!firstInvalidInput) firstInvalidInput = address; }
            if (!gender) { isValid = false; }

            if (!isValid) {
                showValidationAlert("Lengkapi semua kolom Informasi Pribadi terlebih dahulu ya!");
                if(firstInvalidInput) firstInvalidInput.focus();
                return;
            }

            // Pindah Slide ke 2
            document.getElementById('slide-1').classList.add('hidden');
            document.getElementById('slide-2').classList.remove('hidden');

            // Update Indikator Header
            document.getElementById('step-badge').textContent = '2';
            document.getElementById('step-title').textContent = 'Langkah 2: Data Sekolah';
            document.getElementById('step-desc').textContent = 'Informasi pendidikan asal';
            document.getElementById('dot-1').className = 'w-2 h-2 rounded-full bg-slate-300 transition-all duration-300';
            document.getElementById('dot-2').className = 'w-6 h-2 rounded-full bg-[#FF7A59] transition-all duration-300';
        }

        function prevSlide() {
            document.getElementById('slide-2').classList.add('hidden');
            document.getElementById('slide-1').classList.remove('hidden');

            // Update Indikator Header
            document.getElementById('step-badge').textContent = '1';
            document.getElementById('step-title').textContent = 'Langkah 1: Informasi Pribadi';
            document.getElementById('step-desc').textContent = 'Identitas dasar dan kontak';
            document.getElementById('dot-1').className = 'w-6 h-2 rounded-full bg-[#3650A2] transition-all duration-300';
            document.getElementById('dot-2').className = 'w-2 h-2 rounded-full bg-slate-300 transition-all duration-300';
        }

        function validateSubmit(e) {
            const nisn = document.getElementById('nisn');
            const studentClass = document.getElementById('class');

            [nisn, studentClass].forEach(input => input.classList.remove('field-error'));

            if (!nisn.value.trim() || nisn.value.length < 10 || !studentClass.value.trim()) {
                e.preventDefault();
                if (!nisn.value.trim() || nisn.value.length < 10) nisn.classList.add('field-error');
                if (!studentClass.value.trim()) studentClass.classList.add('field-error');

                showValidationAlert("NISN (10 angka) dan Kelas wajib terisi dengan benar!");
            }
        }
    </script>
</body>
</html>
