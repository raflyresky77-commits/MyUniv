import './bootstrap';
import 'ldrs/bouncy';

// Global Loading MyUniv
document.addEventListener('DOMContentLoaded', () => {
    const loading = document.getElementById('global-loading');

    // Jika komponen loading tidak tersedia di halaman, hentikan
    if (!loading) return;

    let loadingTimer = null;
    let loadingCount = 0;

    function showLoading() {
        loadingCount++;

        clearTimeout(loadingTimer);

        loadingTimer = setTimeout(() => {
            loading.classList.remove('hidden');
            loading.classList.add('flex');
        }, 150);
    }

    function hideLoading() {
        loadingCount = Math.max(0, loadingCount - 1);

        if (loadingCount > 0) return;

        clearTimeout(loadingTimer);

        loading.classList.add('hidden');
        loading.classList.remove('flex');
    }

    function resetLoading() {
        loadingCount = 0;
        clearTimeout(loadingTimer);

        loading.classList.add('hidden');
        loading.classList.remove('flex');
    }

    // API Global Loading
    window.MyUnivLoading = {
        show: showLoading,
        hide: hideLoading,
        reset: resetLoading
    };

    // Loading saat berpindah halaman
    document.addEventListener('click', (event) => {
        const link = event.target.closest('a');

        if (!link) return;

        if (
            event.defaultPrevented ||
            event.button !== 0 ||
            event.ctrlKey ||
            event.shiftKey ||
            event.altKey ||
            event.metaKey ||
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            link.hasAttribute('data-no-loading')
        ) {
            return;
        }

        const url = new URL(link.href, window.location.href);

        if (
            url.origin !== window.location.origin ||
            (
                url.pathname === window.location.pathname &&
                url.search === window.location.search &&
                url.hash
            )
        ) {
            return;
        }

        queueMicrotask(() => {
            if (!event.defaultPrevented) {
                showLoading();
            }
        });
    });

    // Loading saat form dikirim secara normal
    document.addEventListener('submit', (event) => {
        const form = event.target;

        if (
            form.hasAttribute('data-no-loading') ||
            form.target === '_blank'
        ) {
            return;
        }

        queueMicrotask(() => {
            if (!event.defaultPrevented) {
                showLoading();
            }
        });
    });

    // Sembunyikan loading setelah halaman selesai dimuat kembali
    window.addEventListener('pageshow', resetLoading);
});
