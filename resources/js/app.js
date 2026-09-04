import './bootstrap';

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch((error) => {
            console.warn('Service worker registration failed:', error);
        });
    });
}

// Shared dialog accessibility for legacy page modals. Business event handlers
// continue to own open/confirm actions; this layer adds semantics and Escape.
document.addEventListener('DOMContentLoaded', () => {
    const returnFocus = new WeakMap();
    const modals = document.querySelectorAll('.modal-overlay');

    modals.forEach((modal) => {
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-modal', 'true');
        modal.setAttribute('aria-hidden', modal.style.display === 'flex' ? 'false' : 'true');

        const observer = new MutationObserver(() => {
            const isOpen = getComputedStyle(modal).display !== 'none';
            modal.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            const wasOpen = modal.dataset.uiOpen === 'true';
            modal.dataset.uiOpen = isOpen ? 'true' : 'false';
            if (isOpen && !wasOpen) {
                returnFocus.set(modal, document.activeElement);
                const focusTarget = modal.querySelector('button, a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                focusTarget?.focus();
            } else if (!isOpen && wasOpen) {
                returnFocus.get(modal)?.focus?.();
            }
        });
        observer.observe(modal, { attributes: true, attributeFilter: ['style', 'class'] });
    });

    document.addEventListener('keydown', (event) => {
        const openModal = Array.from(modals).find((modal) => getComputedStyle(modal).display !== 'none');
        if (!openModal) return;

        if (event.key === 'Tab') {
            const controls = Array.from(openModal.querySelectorAll('button:not([disabled]), a[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'));
            if (!controls.length) return;
            const first = controls[0];
            const last = controls[controls.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
            return;
        }

        if (event.key !== 'Escape') return;
        const closeControl = openModal.querySelector('.modal-done, .btn-m-cancel, [data-modal-close]');
        if (closeControl) closeControl.click();
        else openModal.style.display = 'none';
        returnFocus.get(openModal)?.focus?.();
    });
});
