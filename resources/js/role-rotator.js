const delay = (milliseconds) =>
    new Promise((resolve) => window.setTimeout(resolve, milliseconds));

export function initializeRoleRotator() {
    const roleElement = document.querySelector('[data-role-words]');

    if (!roleElement || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const roles = roleElement.dataset.roleWords
        .split(',')
        .map((role) => role.trim())
        .filter(Boolean);

    if (roles.length < 2) {
        return;
    }

    const animateRoles = async () => {
        let roleIndex = 0;

        while (true) {
            await delay(1800);

            const currentRole = roles[roleIndex];

            for (let length = currentRole.length - 1; length >= 0; length -= 1) {
                roleElement.textContent = currentRole.slice(0, length);
                await delay(75);
            }

            roleIndex = (roleIndex + 1) % roles.length;
            const nextRole = roles[roleIndex];

            for (let length = 1; length <= nextRole.length; length += 1) {
                roleElement.textContent = nextRole.slice(0, length);
                await delay(105);
            }
        }
    };

    animateRoles();
}
