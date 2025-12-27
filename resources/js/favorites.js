document.addEventListener('DOMContentLoaded', function () {
    function toggleIcon(icon, status) {
        if (!icon) return;
        if (status === 'added') {
            icon.setAttribute('data-state', 'filled');
            icon.classList.remove('text-gray-400');
            icon.classList.add('text-red-500');
            icon.setAttribute('fill', 'currentColor');
            // simple scale animation
            icon.classList.add('transform', 'transition-transform', 'duration-200', 'scale-110');
            setTimeout(() => {
                icon.classList.remove('scale-110');
            }, 200);
        } else {
            icon.setAttribute('data-state', 'empty');
            icon.classList.remove('text-red-500');
            icon.classList.add('text-gray-400');
            icon.setAttribute('fill', 'none');
            icon.classList.add('transform', 'transition-transform', 'duration-200', 'scale-90');
            setTimeout(() => {
                icon.classList.remove('scale-90');
            }, 200);
        }
    }

    async function handleFavoriteClick(e) {
        const btn = e.currentTarget;
        const form = btn.closest('.favorite-form');
        if (!form) return;
        const url = form.getAttribute('action');
        const token = form.querySelector('input[name="_token"]').value;

        btn.disabled = true;
        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            });

            if (res.ok) {
                const data = await res.json();
                const icon = btn.querySelector('.favorite-icon') || btn.parentElement.querySelector('.favorite-icon');
                toggleIcon(icon, data.status);

                // optimistic update for sidebar counter
                const favCountEl = document.querySelector('[data-fav-count]');
                if (favCountEl) {
                    const current = parseInt(favCountEl.textContent || '0', 10);
                    if (data.status === 'added') {
                        favCountEl.textContent = String(current + 1);
                    } else if (data.status === 'removed') {
                        favCountEl.textContent = String(Math.max(0, current - 1));
                    }
                }
            }
        } catch (err) {
            console.error('Favorite toggle failed', err);
        } finally {
            btn.disabled = false;
        }
    }

    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', handleFavoriteClick);
    });
});
