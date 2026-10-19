{{-- Reusable modal peringatan asesmen: resources/views/components/student/assessment-warning-modal.blade.php --}}
@props([
    'modalId' => 'assessmentWarningModal',
    'messageId' => 'assessmentWarningMessage',
    'title' => 'Peringatan: Belum Selesai!',
    'initialMessage' => 'Masih ada beberapa soal yang belum kamu selesaikan. Silakan lengkapi terlebih dahulu sebelum melanjutkan.',
    'closeAction' => null,
    'continueAction' => null,
    'cancelText' => 'Periksa Kembali',
    'confirmText' => 'Tetap Kirim',
])

@php
    $closeHandler = $closeAction ?: 'closeAssessmentWarning';
    $continueHandler = $continueAction ?: 'submitAssessmentAnyway';
    $confirmModalId = $modalId . 'Confirm';
@endphp

<div id="{{ $modalId }}" data-warning-modal class="fixed inset-0 z-[100] hidden place-items-center bg-slate-950/55 p-4 backdrop-blur-sm" style="display: none; place-items: center;" role="dialog" aria-modal="true" aria-labelledby="{{ $modalId }}Title">
    <button type="button" class="absolute inset-0 h-full w-full cursor-default" aria-label="Tutup modal" onclick="{{ $closeHandler }}()"></button>
    <section data-warning-content class="relative z-10 w-full max-w-md scale-95 overflow-hidden rounded-[28px] border border-white/70 bg-white shadow-[0_30px_90px_-20px_rgba(15,23,42,0.5)] transition-all duration-200">
        <div class="h-2 w-full bg-gradient-to-r from-[#FF7A59] via-orange-400 to-[#3650A2]"></div>
        <div class="p-6 text-center sm:p-8">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-[22px] bg-orange-50 text-[#E85D3A] ring-8 ring-orange-50/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.86 1.82 18.5A1.7 1.7 0 0 0 3.3 21h17.4a1.7 1.7 0 0 0 1.48-2.5L13.7 3.86a1.96 1.96 0 0 0-3.4 0Z"/></svg>
            </div>
            <p class="mt-5 text-[10px] font-extrabold uppercase tracking-[0.22em] text-[#FF7A59]">Perlu diperiksa</p>
            <h2 id="{{ $modalId }}Title" class="mt-2 text-xl font-extrabold tracking-tight text-[#1E2D62] sm:text-2xl">{{ $title }}</h2>
            <p id="{{ $messageId }}" class="mx-auto mt-3 max-w-sm text-sm leading-6 text-slate-600">{{ $initialMessage }}</p>
            <div class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <button type="button" onclick="{{ $closeHandler }}()" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 transition hover:border-slate-300 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg>{{ $cancelText }}
                </button>
                <button type="button" onclick="openAssessmentConfirmModal(@js($modalId), @js($confirmModalId))" class="inline-flex min-h-12 items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-[#FF7A59] to-[#E85D3A] px-4 py-3 text-sm font-extrabold text-white shadow-lg shadow-orange-500/25 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-orange-500/30 focus:outline-none focus:ring-4 focus:ring-orange-200">
                    {{ $confirmText }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
            <p class="mt-4 text-[11px] leading-5 text-slate-400">Pastikan kamu sudah memeriksa jawaban sebelum mengirim asesmen.</p>
        </div>
    </section>
</div>

<div id="{{ $confirmModalId }}" data-warning-confirm class="fixed inset-0 z-[110] hidden place-items-center bg-slate-950/60 p-4 backdrop-blur-sm" style="display: none; place-items: center;" role="dialog" aria-modal="true" aria-labelledby="{{ $confirmModalId }}Title">
    <button type="button" class="absolute inset-0 h-full w-full cursor-default" aria-label="Batalkan konfirmasi" onclick="closeAssessmentConfirmModal(@js($modalId), @js($confirmModalId))"></button>
    <section class="relative z-10 w-full max-w-sm overflow-hidden rounded-[28px] border border-white/70 bg-white shadow-[0_30px_90px_-20px_rgba(15,23,42,0.5)]">
        <div class="h-2 bg-gradient-to-r from-[#3650A2] to-[#FF7A59]"></div>
        <div class="p-6 text-center sm:p-7">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-[#3650A2] ring-8 ring-indigo-50/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-5l-5 5v-5Z"/></svg>
            </div>
            <h2 id="{{ $confirmModalId }}Title" class="mt-5 text-xl font-extrabold text-[#1E2D62]">Kirim asesmen sekarang?</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">Masih ada jawaban yang kosong. Jika tetap dikirim, kamu mungkin tidak bisa mengubah jawaban setelah berpindah tahap.</p>
            <div class="mt-6 grid grid-cols-2 gap-3">
                <button type="button" onclick="closeAssessmentConfirmModal(@js($modalId), @js($confirmModalId))" class="min-h-11 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200">Batal</button>
                <button type="button" onclick="runAssessmentContinueAction(@js($continueHandler), @js($confirmModalId))" class="min-h-11 rounded-2xl bg-[#3650A2] px-4 py-3 text-sm font-extrabold text-white shadow-lg shadow-indigo-900/20 transition hover:bg-[#1E2D62] focus:outline-none focus:ring-4 focus:ring-indigo-200">Ya, Kirim</button>
            </div>
        </div>
    </section>
</div>

<script>
    // Fungsi umum untuk modal reusable; ID tiap pemakaian bisa berbeda.
    function openAssessmentConfirmModal(warningId, confirmId) {
        const warning = document.getElementById(warningId);
        const confirmModal = document.getElementById(confirmId);
        if (warning) { warning.style.display = 'none'; warning.classList.add('hidden'); }
        if (confirmModal) { confirmModal.classList.remove('hidden'); confirmModal.style.display = 'grid'; }
    }

    function closeAssessmentConfirmModal(warningId, confirmId) {
        const confirmModal = document.getElementById(confirmId);
        const warning = document.getElementById(warningId);
        if (confirmModal) { confirmModal.style.display = 'none'; confirmModal.classList.add('hidden'); }
        if (warning) { warning.classList.remove('hidden'); warning.style.display = 'grid'; }
    }

    function runAssessmentContinueAction(actionName, confirmId) {
        const confirmModal = document.getElementById(confirmId);
        if (confirmModal) { confirmModal.style.display = 'none'; confirmModal.classList.add('hidden'); }
        if (typeof window[actionName] === 'function') window[actionName]();
        else console.error('Aksi komponen asesmen tidak ditemukan:', actionName);
    }
</script>
