/**
 * OrthoSmile - main.js
 * Vanilla JS: header scroll, mobile menu, counters, Splide carousel,
 * before/after slider, FAQ accordion, fade-in observer, scroll-to-top.
 *
 * @package OrthoSmile
 */

(function () {
    'use strict';

    /* ─── Helpers ──────────────────────────────────────── */
    const qs  = (sel, ctx = document) => ctx.querySelector(sel);
    const qsa = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

    /* ─── Header: sticky + glassmorphism class ─────────── */
    function initStickyHeader() {
        const header = qs('.site-header');
        if (!header) return;

        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    header.classList.toggle('scrolled', window.scrollY > 60);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    /* ─── Mobile Menu ───────────────────────────────────── */
    function initMobileMenu() {
        const toggle = qs('.menu-toggle');
        const nav    = qs('.site-navigation');
        if (!toggle || !nav) return;

        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen);
            document.body.classList.toggle('menu-open', isOpen);
            const icon = qs('.material-symbols-outlined', toggle);
            if (icon) icon.textContent = isOpen ? 'close' : 'menu';
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!nav.contains(e.target) && !toggle.contains(e.target) && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
                const icon = qs('.material-symbols-outlined', toggle);
                if (icon) icon.textContent = 'menu';
            }
        });

        // Close on ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
                const icon = qs('.material-symbols-outlined', toggle);
                if (icon) icon.textContent = 'menu';
            }
        });
    }

    /* ─── Smooth Scroll ─────────────────────────────────── */
    function initSmoothScroll() {
        qsa('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                const href   = anchor.getAttribute('href');
                if (href === '#') return;
                const target = qs(href);
                if (!target) return;
                e.preventDefault();
                const header = qs('.site-header');
                const offset = header ? header.offsetHeight + 16 : 80;
                const top    = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            });
        });
    }

    /* ─── Counter Animation (Intersection Observer) ─────── */
    function animateCounter(el) {
        const rawTarget = el.dataset.target || '0';
        const target    = parseInt(rawTarget.replace(/\D/g, ''), 10) || 0;
        const suffix    = el.dataset.suffix || rawTarget.replace(/[0-9]/g, '');
        const duration  = 1800;
        const startTime = performance.now();

        function step(now) {
            const elapsed  = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Ease-out cubic
            const eased    = 1 - Math.pow(1 - progress, 3);
            const current  = Math.round(eased * target);
            el.textContent = current.toLocaleString('fr-FR') + suffix;
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    function initCounters() {
        const counters = qsa('.stat-value[data-target]');
        if (!counters.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = 'true';
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counters.forEach(c => observer.observe(c));
    }

    /* ─── Splide Carousel (Team) ────────────────────────── */
    function initSplide() {
        if (typeof Splide === 'undefined') return;

        const teamEl = qs('.team-splide');
        if (teamEl) {
            new Splide(teamEl, {
                type:        'loop',
                perPage:     3,
                perMove:     1,
                gap:         '2rem',
                pagination:  false,
                arrows:      true,
                breakpoints: {
                    1024: { perPage: 2 },
                    640:  { perPage: 1, gap: '1rem' },
                },
            }).mount();
        }
    }

    /* ─── Before / After Slider ─────────────────────────── */
    function initBeforeAfter() {
        const stages = qsa('.before-after-stage');

        stages.forEach(stage => {
            const overlay  = qs('.before-after-overlay', stage);
            const handle   = qs('.before-after-handle', stage);
            const divider  = qs('.before-after-divider', stage);
            if (!overlay || !divider) return;

            let isDragging = false;

            function setPosition(x) {
                const rect  = stage.getBoundingClientRect();
                const ratio = Math.min(Math.max((x - rect.left) / rect.width, 0.02), 0.98);
                const pct   = Math.round(ratio * 100);
                overlay.style.clipPath  = `inset(0 0 0 ${pct}%)`;
                divider.style.left      = pct + '%';
            }

            // Mouse
            divider.addEventListener('mousedown', (e) => {
                isDragging = true;
                e.preventDefault();
            });
            document.addEventListener('mousemove', (e) => {
                if (isDragging) setPosition(e.clientX);
            });
            document.addEventListener('mouseup', () => { isDragging = false; });

            // Touch
            divider.addEventListener('touchstart', (e) => {
                isDragging = true;
            }, { passive: true });
            document.addEventListener('touchmove', (e) => {
                if (isDragging && e.touches[0]) setPosition(e.touches[0].clientX);
            }, { passive: true });
            document.addEventListener('touchend', () => { isDragging = false; });

            // Initialise à 50%
            overlay.style.clipPath = 'inset(0 0 0 50%)';
            divider.style.left     = '50%';
        });
    }

    /* ─── FAQ Accordion ─────────────────────────────────── */
    function initFaqAccordion() {
        const items = qsa('.faq-item');

        items.forEach(item => {
            const btn    = qs('.faq-question', item);
            const answer = qs('.faq-answer', item);
            const icon   = qs('.faq-icon', item);
            if (!btn || !answer) return;

            btn.addEventListener('click', () => {
                const isOpen = item.classList.contains('is-open');

                // Close all
                items.forEach(other => {
                    if (other !== item) {
                        other.classList.remove('is-open');
                        const otherBtn    = qs('.faq-question', other);
                        const otherAnswer = qs('.faq-answer', other);
                        const otherIcon   = qs('.faq-icon', other);
                        if (otherBtn)    otherBtn.setAttribute('aria-expanded', 'false');
                        if (otherAnswer) otherAnswer.setAttribute('hidden', '');
                        if (otherIcon)   otherIcon.textContent = 'add';
                    }
                });

                // Toggle clicked
                item.classList.toggle('is-open', !isOpen);
                btn.setAttribute('aria-expanded', !isOpen);
                if (!isOpen) {
                    answer.removeAttribute('hidden');
                    if (icon) icon.textContent = 'remove';
                } else {
                    answer.setAttribute('hidden', '');
                    if (icon) icon.textContent = 'add';
                }
            });
        });
    }

    /* ─── Fade-in-up (Intersection Observer) ────────────── */
    function initFadeInUp() {
        const elements = qsa('.fade-in-up');
        if (!elements.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        elements.forEach(el => observer.observe(el));
    }

    /* ─── Scroll to Top ─────────────────────────────────── */
    function initScrollToTop() {
        const btn = qs('#scrollToTop');
        if (!btn) return;

        window.addEventListener('scroll', () => {
            btn.classList.toggle('is-visible', window.scrollY > 600);
        }, { passive: true });

        btn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ─── Init ──────────────────────────────────────────── */
    document.addEventListener('DOMContentLoaded', () => {
        initStickyHeader();
        initMobileMenu();
        initSmoothScroll();
        initCounters();
        initSplide();
        initBeforeAfter();
        initFaqAccordion();
        initFadeInUp();
        initScrollToTop();
    });

})();
