/**
 * OrthoSmile - Main JavaScript file
 * Handles interactive functionality for the orthodontist theme
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainMenu = document.querySelector('.main-menu');
    
    if (menuToggle && mainMenu) {
        menuToggle.addEventListener('click', function() {
            mainMenu.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', 
                menuToggle.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (menuToggle && mainMenu && mainMenu.classList.contains('active')) {
            if (!menuToggle.contains(e.target) && !mainMenu.contains(e.target)) {
                mainMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Close mobile menu if open
                if (mainMenu && mainMenu.classList.contains('active')) {
                    mainMenu.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });

    // Header scroll effect
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', function() {
                const isActive = item.classList.contains('active');
                
                // Close all items
                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                });
                
                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });

    // Before/after image comparison slider
    const beforeAfterStages = document.querySelectorAll('.before-after-stage');
    beforeAfterStages.forEach(stage => {
        const beforeImage = stage.querySelector('.before-after-image');
        const overlay = stage.querySelector('.before-after-overlay');
        const divider = stage.querySelector('.before-after-divider');
        const handle = stage.querySelector('.before-after-handle');
        
        if (beforeImage && overlay && divider && handle) {
            let isDragging = false;

            // Set initial position
            const setInitialPosition = () => {
                const width = stage.offsetWidth;
                const initialPosition = width * 0.5;
                overlay.style.clipPath = `inset(0 ${width - initialPosition}px 0 0)`;
                divider.style.left = `${initialPosition}px`;
                handle.style.left = `${initialPosition}px`;
            };

            setInitialPosition();

            // Handle mouse events
            const handleMove = (clientX) => {
                const rect = stage.getBoundingClientRect();
                const x = clientX - rect.left;
                const width = rect.width;
                
                // Constrain position
                const position = Math.max(0, Math.min(width, x));
                
                overlay.style.clipPath = `inset(0 ${width - position}px 0 0)`;
                divider.style.left = `${position}px`;
                handle.style.left = `${position}px`;
            };

            const handleDown = (e) => {
                isDragging = true;
                stage.classList.add('is-dragging');
                handleMove(e.clientX);
            };

            const handleMoveEvent = (e) => {
                if (isDragging) {
                    handleMove(e.clientX);
                }
            };

            const handleUp = () => {
                isDragging = false;
                stage.classList.remove('is-dragging');
            };

            // Event listeners
            handle.addEventListener('mousedown', handleDown);
            window.addEventListener('mousemove', handleMoveEvent);
            window.addEventListener('mouseup', handleUp);

            // Touch events for mobile
            handle.addEventListener('touchstart', (e) => {
                handleDown(e.touches[0]);
            });

            window.addEventListener('touchmove', (e) => {
                if (isDragging) {
                    handleMoveEvent(e.touches[0]);
                }
            });

            window.addEventListener('touchend', handleUp);

            // Reset on resize
            window.addEventListener('resize', setInitialPosition);
        }
    });

    // Form validation and submission
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                } else {
                    field.style.borderColor = '#e5e7eb';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires.');
            }
        });
    }

    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('.newsletter-input');
            const email = emailInput.value.trim();
            
            if (!email) {
                alert('Veuillez saisir votre email.');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Veuillez saisir une adresse email valide.');
                return;
            }

            // Simulate successful submission
            emailInput.value = '';
            alert('Merci pour votre inscription à notre newsletter !');
        });
    }

    // Utility function to validate email
    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // Intersection Observer for fade-in animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements with fade-in-up class
        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }

    // Scroll to top button
    const scrollToTopBtn = document.createElement('button');
    scrollToTopBtn.innerHTML = '<span class="material-symbols-outlined">arrow_upward</span>';
    scrollToTopBtn.className = 'scroll-to-top';
    scrollToTopBtn.setAttribute('aria-label', 'Retour en haut');
    document.body.appendChild(scrollToTopBtn);

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollToTopBtn.style.display = 'block';
        } else {
            scrollToTopBtn.style.display = 'none';
        }
    });
});

// Register service worker after the page has fully loaded to avoid
// InvalidStateError caused by registering during document navigation.
if ('serviceWorker' in navigator && typeof orthosmile_ajax !== 'undefined' && orthosmile_ajax.sw_url) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register(orthosmile_ajax.sw_url)
            .catch(function (err) {
                // Ignore registration failures in restricted contexts (e.g.
                // webviews or cross-origin iframes where service workers are
                // not allowed). Log a warning to help developers diagnose issues.
                if (typeof console !== 'undefined' && console.warn) {
                    console.warn('[OrthoSmile] Service worker registration failed:', err);
                }
            });
    });
}