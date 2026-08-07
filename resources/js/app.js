import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-nav');
    const navigationLinks = document.querySelectorAll('.main-nav a');

    if (menuButton && navigation) {
        menuButton.addEventListener('click', () => {
            const isOpen = navigation.classList.toggle('open');

            menuButton.setAttribute('aria-expanded', String(isOpen));
            menuButton.setAttribute(
                'aria-label',
                isOpen ? 'Close navigation' : 'Open navigation'
            );

            document.body.classList.toggle('menu-open', isOpen);
        });

        navigationLinks.forEach((link) => {
            link.addEventListener('click', () => {
                navigation.classList.remove('open');
                document.body.classList.remove('menu-open');
                menuButton.setAttribute('aria-expanded', 'false');
                menuButton.setAttribute('aria-label', 'Open navigation');
            });
        });
    }

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.main-nav a');

    const updateActiveLink = () => {
        let currentSection = 'home';

        sections.forEach((section) => {
            const sectionTop =
                section.getBoundingClientRect().top + window.scrollY - 160;

            if (window.scrollY >= sectionTop) {
                currentSection = section.id;
            }
        });

        navLinks.forEach((link) => {
            const target = link.getAttribute('href');

            link.classList.toggle(
                'active',
                target === `#${currentSection}`
            );
        });
    };

    window.addEventListener('scroll', updateActiveLink, {
        passive: true,
    });

    updateActiveLink();
});
