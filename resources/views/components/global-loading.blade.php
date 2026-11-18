<div id="global-loading"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-white/80 backdrop-blur-sm">

    <div class="flex flex-col items-center gap-4">
        <l-bouncy size="48" color="#3650A2" speed="1.75"></l-bouncy>

        <div class="text-center">
            <p class="text-base font-bold text-[#3650A2]">MyUniv</p>
            <p class="text-sm text-gray-500">Sedang memuat halaman...</p>
        </div>
    </div>
</div>

<script>
(() => {
    // Download file tidak berpindah halaman, jadi jangan aktifkan global loading.
    // Listener capture ini mencegah listener loading global lain menangani link template.
    document.addEventListener('click', (event) => {
        const link = event.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href') || '';
        const isTemplateDownload =
            link.hasAttribute('download') ||
            /\/(?:admin\/)?majors\/import\/template(?:[?#]|$)/i.test(href) ||
            /\/(?:admin\/)?universities\/import\/template(?:[?#]|$)/i.test(href);

        if (isTemplateDownload) {
            event.stopImmediatePropagation();
            // Tidak preventDefault: browser tetap menjalankan unduhan normal.
        }
    }, true);
})();
</script>
