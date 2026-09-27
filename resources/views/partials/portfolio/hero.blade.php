<section class="hero" id="home">
    <div class="shell">
        <header class="site-header">
            <a href="#home" class="brand" aria-label="Billy Harion home">
                <span class="brand-mark" aria-hidden="true"><span>&lt;</span><span class="brand-slash">/</span><span>&gt;</span></span>
                <span class="brand-name">Billy Harion</span>
            </a>
            <div class="header-actions">
                <button class="theme-toggle" type="button" aria-label="Switch to dark mode" aria-pressed="false">
                    <svg class="theme-icon theme-icon-moon" aria-hidden="true"><use href="#moon"/></svg>
                    <svg class="theme-icon theme-icon-sun" aria-hidden="true"><use href="#sun"/></svg>
                </button>
                <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false"><svg><use href="#menu"/></svg></button>
            </div>
            <nav class="main-nav" aria-label="Main navigation">
                <a class="active" href="#home">Home</a><a href="#about">About</a><a href="#skills">Skills</a><a href="#projects">Projects</a><a href="#experience">Experience</a><a href="#contact">Contact</a>
            </nav>
        </header>

        <div class="hero-grid">
            <div class="hero-copy">
                <p class="eyebrow hero-eyebrow">Hello, I'm</p>
                <h1>Billy Harion</h1>
                <p class="hero-title">
                    <span class="hero-title-prefix">IT Graduate &amp;</span>
                    <span class="hero-role">
                        <span class="role-static">The </span><span class="role-slot"><span class="role-text" data-role-words="Developer.,Designer.,Founder.">Developer</span><span class="role-caret" aria-hidden="true"></span></span>
                    </span>
                </p>
                <p class="intro">I build clean, modern and user-friendly applications<br class="desktop-only"> with a passion for problem solving and continuous learning.</p>
                <div class="hero-actions">
                    <a href="{{ asset('cv/Resume.pdf') }}" class="button button-primary" download="Billy-Harion-CV.pdf">Download My CV <svg><use href="#download"/></svg></a>
                    <a href="#contact" class="button button-secondary" data-contact-trigger>Contact Me <svg><use href="#mail"/></svg></a>
                </div>
                <div class="socials">
                    <a href="https://github.com/ItaChi-afk-design" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><svg><use href="#github"/></svg></a>
                    <a href="https://www.linkedin.com/in/billy-joe-harion-60a588427/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg><use href="#linkedin"/></svg></a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg><use href="#facebook"/></svg></a>
                </div>
            </div>
            <div class="portrait-card" aria-label="Portrait of Billy Harion">
                <div class="portrait-glow"></div>
                <span class="dot-matrix" aria-hidden="true"></span>
                <img src="{{ asset('hero-portrait-natural.png') }}" alt="Portrait of Billy Harion">
            </div>
        </div>
    </div>
</section>
