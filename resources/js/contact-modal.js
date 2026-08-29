export function initializeContactModal() {
    const modal = document.getElementById('contactModal');

    if (!modal) {
        return;
    }

    const openContactModal = () => {
        modal.style.display = 'grid';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closeContactModal = () => {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    window.openContactModal = openContactModal;
    window.closeContactModal = closeContactModal;

    document.querySelectorAll('[data-contact-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            openContactModal();
        });
    });

    document.querySelectorAll('[data-contact-close]').forEach((button) => {
        button.addEventListener('click', closeContactModal);
    });

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeContactModal();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeContactModal();
        }
    });

    if (document.querySelector('.contact-success, .contact-error')) {
        openContactModal();
    }

    if (document.getElementById('contactSuccessMessage')) {
        window.setTimeout(closeContactModal, 4000);
    }
}
