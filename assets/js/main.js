/**
 * OrthoSmile – Main JavaScript
 * Handles interactive functionality for the premium orthodontist theme
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ====================================================
       1. MOBILE MENU TOGGLE
       ==================================================== */
    const menuToggle   = document.querySelector('.menu-toggle');
    const siteNav      = document.querySelector('#site-navigation');
    const menuIcon     = menuToggle ? menuToggle.querySelector('.material-symbols-outlined') : null;

    if (menuToggle && siteNav) {
        menuToggle.addEventListener('click', function () {
            const isOpen = siteNav.classList.toggle('mobile-open');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (menuIcon) menuIcon.textContent = isOpen ? 'close' : 'menu';
        });

        document.addEventListener('click', function (e) {
            if (siteNav.classList.contains('mobile-open') &&
                !menuToggle.contains(e.target) &&
                !siteNav.contains(e.target)) {
                siteNav.classList.remove('mobile-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                if (menuIcon) menuIcon.textContent = 'menu';
            }
        });
    }

    /* ====================================================
       2. SMOOTH SCROLLING
       ==================================================== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerH = document.querySelector('.site-header') ? document.querySelector('.site-header').offsetHeight : 0;
                const top = target.getBoundingClientRect().top + window.pageYOffset - headerH - 16;
                window.scrollTo({ top: top, behavior: 'smooth' });

                if (siteNav && siteNav.classList.contains('mobile-open')) {
                    siteNav.classList.remove('mobile-open');
                    menuToggle && menuToggle.setAttribute('aria-expanded', 'false');
                    if (menuIcon) menuIcon.textContent = 'menu';
                }
            }
        });
    });

    /* ====================================================
       3. STICKY HEADER SHADOW
       ==================================================== */
    var header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    }

    /* ====================================================
       4. FAQ ACCORDION
       ==================================================== */
    var faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(function (item) {
        var question = item.querySelector('.faq-question');
        if (!question) return;
        question.addEventListener('click', function () {
            var isActive = item.classList.contains('active');
            faqItems.forEach(function (other) { other.classList.remove('active'); });
            if (!isActive) item.classList.add('active');
        });
    });

    /* ====================================================
       5. BEFORE / AFTER IMAGE SLIDER
       ==================================================== */
    document.querySelectorAll('.before-after-stage').forEach(function (stage) {
        var overlay  = stage.querySelector('.before-after-overlay');
        var divider  = stage.querySelector('.before-after-divider');
        var handle   = stage.querySelector('.before-after-handle');
        if (!overlay || !divider || !handle) return;

        var dragging = false;

        function setPos(clientX) {
            var rect  = stage.getBoundingClientRect();
            var pos   = Math.max(0, Math.min(rect.width, clientX - rect.left));
            var pct   = (pos / rect.width * 100).toFixed(2);
            overlay.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
            divider.style.left     = pct + '%';
            handle.style.left      = pct + '%';
        }

        setPos(stage.getBoundingClientRect().left + stage.offsetWidth / 2);

        handle.addEventListener('mousedown',  function () { dragging = true; });
        window.addEventListener('mouseup',    function () { dragging = false; });
        window.addEventListener('mousemove',  function (e) { if (dragging) setPos(e.clientX); });

        handle.addEventListener('touchstart', function (e) { dragging = true; e.preventDefault(); }, { passive: false });
        window.addEventListener('touchend',   function () { dragging = false; });
        window.addEventListener('touchmove',  function (e) { if (dragging) setPos(e.touches[0].clientX); }, { passive: true });

        window.addEventListener('resize', function () {
            setPos(stage.getBoundingClientRect().left + stage.offsetWidth / 2);
        }, { passive: true });
    });

    /* ====================================================
       6. CONTACT FORM CLIENT-SIDE VALIDATION
       ==================================================== */
    var contactForm = document.querySelector('form.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            var valid = true;
            contactForm.querySelectorAll('[required]').forEach(function (field) {
                if (!field.value.trim()) {
                    valid = false;
                    field.style.borderColor = '#ef4444';
                    field.addEventListener('input', function () {
                        field.style.borderColor = '';
                    }, { once: true });
                }
            });
            if (!valid) {
                e.preventDefault();
            }
        });
    }

    /* ====================================================
       7. SCROLL-TO-TOP BUTTON
       ==================================================== */
    var scrollBtn = document.getElementById('scrollToTop');
    if (scrollBtn) {
        window.addEventListener('scroll', function () {
            scrollBtn.style.opacity  = window.scrollY > 400 ? '1' : '0';
            scrollBtn.style.pointerEvents = window.scrollY > 400 ? 'auto' : 'none';
        }, { passive: true });

        scrollBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ====================================================
       8. INTERSECTION OBSERVER (fade-in-up)
       ==================================================== */
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.fade-in-up').forEach(function (el) {
            observer.observe(el);
        });
    }

});
