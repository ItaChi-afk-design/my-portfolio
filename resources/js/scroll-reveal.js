export function initializeScrollReveal() {
    const revealItems = document.querySelectorAll('[data-scroll-reveal]');

    if (!revealItems.length) {
        return;
    }

    const revealAll = () => {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    };

    if (
        !('IntersectionObserver' in window) ||
        window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        revealAll();
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        {
            rootMargin: '0px 0px -70px',
            threshold: 0.12,
        }
    );

    revealItems.forEach((item) => observer.observe(item));
}
