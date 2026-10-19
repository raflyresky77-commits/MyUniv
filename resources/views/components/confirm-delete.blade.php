{{-- Menyediakan fungsi konfirmasi hapus yang dapat dipakai ulang --}}
@props([
    'functionName' => 'handleDeleteAssessment',
    'title' => 'Yakin ingin menghapus?',
    'text' => 'Data yang dihapus tidak dapat dikembalikan.',
    'confirmText' => 'Ya, Hapus!',
])

{{-- Mendaftarkan fungsi global agar bisa dipanggil dari onsubmit form --}}
<script>
    window[@json($functionName)] = function (event, cardId) {
        // Mencegah form langsung terkirim sebelum konfirmasi.
        event.preventDefault();

        const form = event.target.closest('form');
        const card = cardId ? document.getElementById(cardId) : null;

        // Berhenti jika form tidak ditemukan.
        if (!form) return;

        // Menampilkan dialog konfirmasi SweetAlert2.
        Swal.fire({
            title: @json($title),
            text: @json($text),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: @json($confirmText),
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-[24px]' }
        }).then((result) => {
            // Mengirim form hanya jika pengguna menyetujui.
            if (result.isConfirmed) {
                if (card) card.classList.add('deleting-animation');
                setTimeout(() => form.submit(), 400);
            }
        });
    };
</script>
