<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#050914">
    <title>Billy Harion | Portfolio</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .contact {
            padding: 2rem 0 2.5rem;
        }

        .contact-grid {
            display: grid;
            gap: 1.2rem;
            grid-template-columns: 1fr;
        }

        .contact-info {
            display: grid;
            gap: 1.25rem;
            padding: 1.5rem;
            border-radius: 1.25rem;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            color: #0f172a;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }

        .contact-eyebrow {
            margin: 0;
            letter-spacing: 0.25em;
            color: #2563eb;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.78rem;
        }

        .contact-info h2 {
            margin: 0;
            font-size: clamp(1.8rem, 2.5vw, 2.4rem);
            line-height: 1.1;
            color: #0f172a;
        }

        .contact-text {
            margin: 0;
            max-width: 32rem;
            color: #475569;
            line-height: 1.75;
        }

        .contact-cards {
            display: grid;
            gap: 0.9rem;
        }

        .contact-card {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.85rem;
            align-items: center;
            padding: 0.95rem 1rem;
            border-radius: 1rem;
            background: #f8fafc;
            border: 1px solid rgba(148, 163, 184, 0.22);
        }

        .contact-icon {
            width: 2.7rem;
            height: 2.7rem;
            display: grid;
            place-items: center;
            border-radius: 0.95rem;
            background: rgba(37, 99, 235, 0.12);
        }

        .contact-icon svg {
            width: 1.2rem;
            height: 1.2rem;
            stroke: #2563eb;
            stroke-width: 1.5;
            fill: none;
        }

        .card-title {
            margin: 0 0 0.2rem;
            font-size: 0.92rem;
            color: #0f172a;
            font-weight: 700;
        }

        .card-value {
            margin: 0;
            color: #475569;
            font-size: 0.9rem;
            word-break: break-word;
        }

        .contact-socials {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-top: 0.75rem;
        }

        .contact-socials a {
            width: 3rem;
            height: 3rem;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .contact-socials svg {
            width: 1rem;
            height: 1rem;
            fill: #ffffff;
        }

        .contact-form {
            display: grid;
            gap: 1rem;
            padding: 1.5rem;
            border-radius: 1.25rem;
            background: #ffffff;
            border: 1px solid rgba(148, 163, 184, 0.24);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        }

        .contact-form .form-row {
            display: grid;
            gap: 1rem;
        }

        .contact-form label {
            display: grid;
            gap: 0.45rem;
            color: #0f172a;
            font-size: 0.9rem;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.95rem 1rem;
            border: 1px solid rgba(148, 163, 184, 0.3);
            border-radius: 0.95rem;
            background: #f8fafc;
            color: #0f172a;
            font: inherit;
            outline: none;
        }

        .contact-form textarea {
            min-height: 140px;
            resize: vertical;
        }

        .contact-form button {
            align-self: start;
            max-width: 220px;
        }

        .contact-success {
            padding: 1rem 1.2rem;
            border-radius: 1rem;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.28);
            color: #134e4a;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .contact-error {
            padding: 1rem 1.2rem;
            border-radius: 1rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.28);
            color: #991b1b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .contact-error p,
        .contact-error ul {
            margin: 0;
        }

        .contact-error ul {
            padding-left: 1.25rem;
        }

        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            z-index: 999;
            place-items: center;
            padding: 1.25rem;
        }

        .contact-modal {
            width: min(600px, 100%);
            background: #ffffff;
            border-radius: 1.75rem;
            padding: 2rem;
            box-shadow: 0 40px 80px rgba(15, 23, 42, 0.18);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
            border: none;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.08);
            color: #0f172a;
            font-size: 1.4rem;
            line-height: 1;
            cursor: pointer;
        }

        .modal-header {
            margin-bottom: 1.5rem;
        }

        .modal-header .contact-eyebrow {
            color: #2563eb;
            letter-spacing: 0.25em;
            font-size: 0.78rem;
            margin-bottom: 0.75rem;
        }

        .modal-header h2 {
            margin: 0 0 0.6rem;
            font-size: 2rem;
            color: #0f172a;
            line-height: 1.05;
        }

        .modal-header .contact-text {
            margin: 0;
            color: #475569;
            line-height: 1.7;
        }

        .modal-form label span {
            color: #0f172a;
            font-weight: 600;
            display: block;
        }

        .modal-form input,
        .modal-form textarea {
            background: #f8fafc;
            border: 1px solid rgba(148, 163, 184, 0.3);
            color: #0f172a;
        }

        .modal-form textarea {
            min-height: 150px;
        }

        @media (min-width: 1024px) {
            .contact-grid {
                grid-template-columns: 1.05fr 0.95fr;
                align-items: start;
                gap: 1.25rem;
            }

            .contact-info {
                padding: 2rem;
            }

            .contact-form {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <svg class="svg-defs" aria-hidden="true" focusable="false">
        <symbol id="arrow" viewBox="0 0 24 24"><path d="M5 12h13M13 6l6 6-6 6"/></symbol>
        <symbol id="download" viewBox="0 0 24 24"><path d="M12 3v11m0 0 4-4m-4 4-4-4M4 18v2h16v-2"/></symbol>
        <symbol id="mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></symbol>
        <symbol id="location" viewBox="0 0 24 24"><path d="M12 21s7-4.35 7-10A7 7 0 0 0 5 11c0 5.65 7 10 7 10Z"/><circle cx="12" cy="11" r="2.5"/></symbol>
        <symbol id="clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><path d="M12 8v4l3 2"/></symbol>
        <symbol id="external" viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8"/><path d="M19 14v4a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4"/></symbol>
        <symbol id="user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M5.5 20v-1.5a6.5 6.5 0 0 1 13 0V20"/></symbol>
        <symbol id="users" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2"/><path d="M3.5 19v-1a5.5 5.5 0 0 1 11 0v1M16 14.5a4.5 4.5 0 0 1 4.5 4.5"/></symbol>
        <symbol id="rocket" viewBox="0 0 24 24"><path d="M14 4c3-1 5-1 6-1 0 3 0 5-1 7l-7 7-5-5 7-7Z"/><path d="m8 15-4 1 1-4M12 20l-1 1-4-4 1-1M15 8l1 1"/></symbol>
        <symbol id="spark" viewBox="0 0 24 24"><path d="m12 3 1.5 5.5L19 10l-5.5 1.5L12 17l-1.5-5.5L5 10l5.5-1.5L12 3ZM19 16l.7 2.3L22 19l-2.3.7L19 22l-.7-2.3L16 19l2.3-.7L19 16Z"/></symbol>
        <symbol id="github" viewBox="0 0 24 24"><path d="M12 3a9 9 0 0 0-2.85 17.54c.45.08.61-.19.61-.43v-1.68c-2.5.54-3.03-1.05-3.03-1.05-.4-1.04-1-1.31-1-1.31-.82-.56.06-.55.06-.55.91.06 1.39.94 1.39.94.81 1.38 2.12.98 2.64.75.08-.58.31-.98.57-1.2-2-.23-4.11-1-4.11-4.45 0-.98.35-1.78.93-2.41-.1-.23-.4-1.14.09-2.38 0 0 .76-.24 2.48.92A8.6 8.6 0 0 1 12 6.44c.76 0 1.52.1 2.23.3 1.72-1.16 2.48-.92 2.48-.92.5 1.24.19 2.15.1 2.38.57.63.92 1.43.92 2.41 0 3.46-2.11 4.21-4.12 4.44.32.28.61.83.61 1.68v2.5c0 .24.16.52.62.43A9 9 0 0 0 12 3Z"/></symbol>
        <symbol id="linkedin" viewBox="0 0 24 24"><path d="M6.5 9.5V18M6.5 6.5v.01M10.5 18v-4.7c0-2.5 4.5-2.7 4.5 0V18M15 12.2c.5-1.8 4-2.8 4 1.2V18"/></symbol>
        <symbol id="facebook" viewBox="0 0 24 24"><path d="M14 20v-7h2.5l.5-3H14V8.5c0-.87.3-1.5 1.65-1.5H17V4.3c-.3-.04-1.1-.13-2.08-.13-2.06 0-3.47 1.25-3.47 3.56V10H9v3h2.45v7"/></symbol>
        <symbol id="menu" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></symbol>
    </svg>

    <section class="hero" id="home">
        <div class="shell">
            <header class="site-header">
                <a href="#home" class="brand" aria-label="Billy Harion home"><span class="brand-mark">B</span><span>Billy Harion</span></a>
                <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false"><svg><use href="#menu"/></svg></button>
                <nav class="main-nav" aria-label="Main navigation">
                    <a class="active" href="#home">Home</a><a href="#about">About</a><a href="#skills">Skills</a><a href="#projects">Projects</a><a href="#experience">Experience</a><a href="#contact" onclick="openContactModal(); return false;">Contact</a>
                </nav>
                <a class="cv-link" href="{{ asset('cv/Resume.pdf') }}" download="Billy-Harion-CV.pdf"><svg><use href="#download"/></svg>Download CV</a>
            </header>
            <div class="hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow hero-eyebrow">Hello, I'm</p><h1>Billy Harion</h1><p class="hero-title">IT Graduate &amp; Aspiring <span>Developer</span></p>
                    <p class="intro">I build clean, modern and user-friendly applications<br class="desktop-only"> with a passion for problem solving and continuous learning.</p>
                    <div class="hero-actions"><a href="#projects" class="button button-primary">View My Work <svg><use href="#arrow"/></svg></a><a href="#contact" class="button button-secondary" onclick="openContactModal(); return false;">Contact Me <svg><use href="#mail"/></svg></a></div>
                    <div class="socials"><a href="https://github.com/ItaChi-afk-design" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><svg><use href="#github"/></svg></a><a href="https://www.linkedin.com/in/billy-joe-harion-60a588427/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg><use href="#linkedin"/></svg></a><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg><use href="#facebook"/></svg></a><a href="mailto:harionbilly4@gmail.com" aria-label="Email"><svg><use href="#mail"/></svg></a></div>
                </div>
                <div class="portrait-card" aria-label="Portrait of Billy Harion"><div class="portrait-glow"></div><span class="dot-matrix" aria-hidden="true"></span><img src="{{ asset('hero-portrait-natural.png') }}" alt="Portrait of Billy Harion"></div>
            </div>
        </div>
    </section>
    <main class="page-light">
        <section class="about section shell" id="about">
            <div class="desk-scene"><img src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&amp;fit=crop&amp;w=1000&amp;q=85" alt="Computer monitor displaying code"><article class="focus-note"><span class="feature-icon"><svg><use href="#user"/></svg></span><p>Focused on<br><strong>building impactful</strong><br>solutions through<br>code and design.</p></article></div>
            <div class="about-copy"><p class="eyebrow">About Me</p><h2>Get to know me</h2><p class="about-intro">I'm an Information Technology Graduate with a strong interest in web and mobile development. I enjoy turning ideas into real world solutions through clean code and thoughtful design.</p><div class="qualities">
                <article><span class="feature-icon"><svg><use href="#users"/></svg></span><div><h3>Problem Solver</h3><p>I enjoy solving problems and<br>building efficient solutions.</p></div></article><article><span class="feature-icon"><svg><use href="#rocket"/></svg></span><div><h3>Fast Learner</h3><p>I'm always learning new<br>technologies and improving.</p></div></article><article><span class="feature-icon"><svg><use href="#spark"/></svg></span><div><h3>Team Player</h3><p>I value collaboration and<br>learning from others.</p></div></article><article><span class="feature-icon"><svg><use href="#spark"/></svg></span><div><h3>Detail Oriented</h3><p>I focus on writing clean code<br>and great user experience.</p></div></article>
            </div></div>
        </section>
        <section class="skills section" id="skills"><div class="section-heading center"><p class="eyebrow">My Skills</p><h2>Technologies I Work With</h2><span class="heading-rule"></span></div><div class="skill-list shell"><div class="skill"><span class="tech-logo html">5</span><p>HTML</p></div><div class="skill"><span class="tech-logo css">3</span><p>CSS</p></div><div class="skill"><span class="tech-logo js">JS</span><p>JavaScript</p></div><div class="skill"><span class="tech-logo react">⚛</span><p>React</p></div><div class="skill"><span class="tech-logo react">⚛</span><p>React Native</p></div><div class="skill"><span class="tech-logo php">php</span><p>PHP</p></div><div class="skill"><span class="tech-logo mysql">⌁</span><p>MySQL</p></div><div class="skill"><span class="tech-logo firebase">♦</span><p>Firebase</p></div></div></section>
        <section class="projects section shell" id="projects"><div class="projects-heading"><div><p class="eyebrow">My Projects</p><h2>Things I've Built</h2></div><a class="small-button" href="#contact">View All Projects <svg><use href="#arrow"/></svg></a></div><div class="project-grid">
            <article class="project-card"><div class="project-preview bible-preview"><div class="side-strip"></div><div class="preview-top"></div><div class="preview-dashboard"><span></span><div></div><div></div><div></div></div></div><div class="project-content"><a href="#contact" class="external" aria-label="Open Bible App"><svg><use href="#external"/></svg></a><h3>Bible App</h3><p class="project-stack">React Native - Firebase</p><p>A Bible app with offline access,<br>search, verse of the day and more.</p></div></article>
            <article class="project-card"><div class="project-preview attendance-preview"><div class="sidebar-bars"></div><div class="dashboard-head"></div><div class="bar-chart"><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div></div><div class="project-content"><a href="#contact" class="external" aria-label="Open Attendance System"><svg><use href="#external"/></svg></a><h3>Attendance System</h3><p class="project-stack">React Native - Firebase</p><p>Offline-first attendance system with<br>real-time sync and service tracking.</p></div></article>
            <article class="project-card"><div class="project-preview food-preview"><div class="food-menu"><b>Menu</b><span>🍔</span><span>🍟</span><span>🍕</span><span>🥪</span><span>🍗</span><span>🍜</span></div></div><div class="project-content"><a href="#contact" class="external" aria-label="Open Food Ordering System"><svg><use href="#external"/></svg></a><h3>Food Ordering System</h3><p class="project-stack">Java</p><p>Console-based food ordering system<br>with menu, orders and receipts.</p></div></article>
        </div></section>
        <section class="experience section shell" id="experience"><div class="section-heading center"><p class="eyebrow">My Experience</p><h2>My Journey So Far</h2></div><div class="timeline"><article><span class="timeline-dot"></span><div><h3>IT Support (OJT)</h3><p class="time-place">AKAIT · Jan 2026 – Mar 2026</p><p>Troubleshooting hardware/software issues, system<br>maintenance, network monitoring and user support.</p></div></article><article><span class="timeline-dot"></span><div><h3>Registrar (OJT)</h3><p class="time-place">PMFTC Inc. · Nov 2025 – Dec 2025</p><p>Processed student records, encoded data in the system<br>and supported office administrative tasks.</p></div></article></div></section>
        <div class="modal-backdrop" id="contactModal" aria-hidden="true">
            <div class="contact-modal" role="dialog" aria-modal="true" aria-labelledby="contactModalTitle">
                <button type="button" class="modal-close" aria-label="Close contact form" onclick="closeContactModal()">×</button>
                <div class="modal-header">
                    <p class="eyebrow contact-eyebrow">Contact Us</p>
                    <h2 id="contactModalTitle">Send us a message</h2>
                    <p class="contact-text">Fill up the form below to send us a message.</p>
                </div>
                @if(session('success'))
                    <div class="contact-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="contact-error" role="alert">
                        <p>Please correct the following:</p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="contact-form modal-form" method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <label>
                        <span>Full Name</span>
                        <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                    </label>
                    <label>
                        <span>Email Address</span>
                        <input type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}" required>
                    </label>
                    <label>
                        <span>Phone Number</span>
                        <input type="text" name="phone" placeholder="+1 (555) 1234-567" value="{{ old('phone') }}">
                    </label>
                    <label>
                        <span>Your Message</span>
                        <textarea name="message" placeholder="Your Message" required>{{ old('message') }}</textarea>
                    </label>
                    <button class="button button-primary" type="submit">Send Message</button>
                </form>
            </div>
        </div>
        <script>
            function openContactModal() {
                const modal = document.getElementById('contactModal');
                if (modal) {
                    modal.style.display = 'grid';
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeContactModal() {
                const modal = document.getElementById('contactModal');
                if (modal) {
                    modal.style.display = 'none';
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            }

            window.addEventListener('click', function(event) {
                const modal = document.getElementById('contactModal');
                if (modal && event.target === modal) {
                    closeContactModal();
                }
            });

            window.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeContactModal();
                }
            });

            window.addEventListener('hashchange', function() {
                if (window.location.hash === '#contact') {
                    openContactModal();
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                if (window.location.hash === '#contact' || document.querySelector('.contact-success, .contact-error')) {
                    openContactModal();
                }
            });
        </script>
    </main>
</body>
</html>
