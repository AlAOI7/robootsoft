document.addEventListener('DOMContentLoaded', () => {
    // Initialize Theme and Language
    initTheme();
    initLanguage();
    
    // Core Layout Animations & Handlers
    initLoader();
    initStickyNavbar();
    initMobileMenu();
    initScrollReveal();
    initBackToTop();
    initModals();

    // Page-specific Features (Self-detecting)
    initTypingEffect();
    initStatsCounters();
    initTestimonialsSlider();
    initFaqAccordions();
    initPortfolioFilter();
    initContactForm();
});

/* ==========================================
   THEME SWITCHER
   ========================================== */
function initTheme() {
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'dark';
    
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const activeTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = activeTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
}

/* ==========================================
   LANGUAGE SWITCHER (Arabic / English)
   ========================================== */
function initLanguage() {
    const langToggle = document.getElementById('lang-toggle');
    let currentLang = localStorage.getItem('lang') || 'ar';
    
    applyLanguage(currentLang);
    
    if (langToggle) {
        langToggle.addEventListener('click', () => {
            currentLang = currentLang === 'ar' ? 'en' : 'ar';
            localStorage.setItem('lang', currentLang);
            applyLanguage(currentLang);
            
            // Re-run elements that need dynamic sizing or layout recalculation
            window.dispatchEvent(new Event('resize'));
        });
    }
}

function applyLanguage(lang) {
    document.documentElement.setAttribute('lang', lang);
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
    
    const translatable = document.querySelectorAll('[data-ar]');
    translatable.forEach(el => {
        const translation = el.getAttribute(`data-${lang}`);
        if (translation !== null) {
            // Check if input/textarea placeholder
            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                if (el.hasAttribute('placeholder')) {
                    el.setAttribute('placeholder', translation);
                }
            } else {
                el.innerHTML = translation;
            }
        }
    });

    // Update active visual language switcher indicators if any
    const langText = document.getElementById('lang-toggle-text');
    if (langText) {
        langText.textContent = lang === 'ar' ? 'English' : 'عربي';
    }
}

/* ==========================================
   LOADING SCREEN
   ========================================== */
function initLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.classList.add('hidden');
            }, 600); // Small delay for premium feel
        });
        
        // Fail-safe in case window load event doesn't fire
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 3000);
    }
}

/* ==========================================
   STICKY NAVBAR
   ========================================== */
function initStickyNavbar() {
    const header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });
    }
}

/* ==========================================
   MOBILE MENU & MEGA MENU TOGGLE
   ========================================== */
function initMobileMenu() {
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const megaMenuParent = document.querySelector('.has-mega-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });
    }

    // Mega menu trigger for mobile screens (touch/click instead of hover)
    if (megaMenuParent) {
        megaMenuParent.addEventListener('click', (e) => {
            if (window.innerWidth <= 991) {
                e.stopPropagation();
                megaMenuParent.classList.toggle('active');
            }
        });
    }
}

/* ==========================================
   BACK TO TOP BUTTON
   ========================================== */
function initBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.add('active');
            } else {
                backToTopBtn.classList.remove('active');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

/* ==========================================
   SCROLL REVEAL (Intersection Observer)
   ========================================== */
function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal');
    
    if ('IntersectionObserver' in window && reveals.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target); // Trigger only once
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        reveals.forEach(el => observer.observe(el));
    } else {
        // Fallback for older browsers
        reveals.forEach(el => el.classList.add('revealed'));
    }
}

/* ==========================================
   STATS COUNTERS
   ========================================== */
function initStatsCounters() {
    const stats = document.querySelectorAll('.stat-number');
    if (stats.length === 0) return;
    
    const startCounter = (el) => {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const suffix = el.getAttribute('data-suffix') || '';
        let count = 0;
        const duration = 2000; // 2 seconds
        const stepTime = Math.max(Math.floor(duration / target), 15);
        
        const timer = setInterval(() => {
            count += Math.ceil(target / (duration / stepTime));
            if (count >= target) {
                el.textContent = target + suffix;
                clearInterval(timer);
            } else {
                el.textContent = count + suffix;
            }
        }, stepTime);
    };

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        stats.forEach(stat => observer.observe(stat));
    } else {
        stats.forEach(stat => startCounter(stat));
    }
}

/* ==========================================
   TYPING EFFECT (Hero Section)
   ========================================== */
function initTypingEffect() {
    const element = document.getElementById('typing-text');
    if (!element) return;
    
    const arWords = ["المال والأعمال.", "المبيعات والمخازن.", "الموارد البشرية.", "التطبيقات والتحول الرقمي."];
    const enWords = ["Finance & Business.", "Sales & Inventory.", "Human Resources.", "Apps & Digital Transformation."];
    
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 100;
    
    function type() {
        const currentLang = document.documentElement.getAttribute('lang') || 'ar';
        const words = currentLang === 'ar' ? arWords : enWords;
        
        const currentWord = words[wordIndex];
        const displayedText = currentWord.substring(0, charIndex);
        
        element.textContent = displayedText;
        
        if (!isDeleting && charIndex < currentWord.length) {
            charIndex++;
            typingSpeed = 80;
        } else if (isDeleting && charIndex > 0) {
            charIndex--;
            typingSpeed = 40;
        } else if (!isDeleting && charIndex === currentWord.length) {
            isDeleting = true;
            typingSpeed = 1500; // Pause at end of word
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            typingSpeed = 500; // Pause before typing next word
        }
        
        setTimeout(type, typingSpeed);
    }
    
    setTimeout(type, 1000);
}

/* ==========================================
   TESTIMONIALS SLIDER
   ========================================== */
function initTestimonialsSlider() {
    const slider = document.querySelector('.testimonials-slider-container');
    if (!slider) return;
    
    const wrapper = slider.querySelector('.testimonials-wrapper');
    const slides = slider.querySelectorAll('.testimonial-slide');
    const dotsContainer = slider.querySelector('.slider-dots');
    
    let currentIndex = 0;
    const slidesCount = slides.length;
    
    // Create dots
    dotsContainer.innerHTML = '';
    for (let i = 0; i < slidesCount; i++) {
        const dot = document.createElement('div');
        dot.classList.add('slider-dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
    }
    
    const dots = dotsContainer.querySelectorAll('.slider-dot');
    
    function updateSlider() {
        const direction = document.documentElement.getAttribute('dir') === 'rtl' ? 1 : -1;
        wrapper.style.transform = `translateX(${direction * currentIndex * 100}%)`;
        
        dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === currentIndex);
        });
    }
    
    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
    }
    
    // Next/Prev buttons
    const prevBtn = slider.querySelector('.slider-nav-prev');
    const nextBtn = slider.querySelector('.slider-nav-next');
    
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slidesCount) % slidesCount;
            updateSlider();
        });
        
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % slidesCount;
            updateSlider();
        });
    }
    
    // Auto slide
    let autoPlay = setInterval(() => {
        currentIndex = (currentIndex + 1) % slidesCount;
        updateSlider();
    }, 6000);
    
    slider.addEventListener('mouseenter', () => clearInterval(autoPlay));
    slider.addEventListener('mouseleave', () => {
        autoPlay = setInterval(() => {
            currentIndex = (currentIndex + 1) % slidesCount;
            updateSlider();
        }, 6000);
    });
}

/* ==========================================
   FAQ ACCORDIONS
   ========================================== */
function initFaqAccordions() {
    const faqHeaders = document.querySelectorAll('.faq-header');
    if (faqHeaders.length === 0) return;
    
    faqHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const isActive = item.classList.contains('active');
            
            // Close other accordions in the same list
            const parentList = item.parentElement;
            parentList.querySelectorAll('.faq-item').forEach(sibling => {
                sibling.classList.remove('active');
            });
            
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

/* ==========================================
   PORTFOLIO FILTER
   ========================================== */
function initPortfolioFilter() {
    const filterContainer = document.querySelector('.portfolio-filter-container');
    const portfolioGrid = document.querySelector('.portfolio-grid');
    if (!filterContainer || !portfolioGrid) return;
    
    const filterBtns = filterContainer.querySelectorAll('.filter-btn');
    const cards = portfolioGrid.querySelectorAll('.portfolio-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const category = btn.getAttribute('data-filter');
            
            cards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                
                if (category === 'all' || cardCat === category) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.transform = 'scale(1)';
                        card.style.opacity = '1';
                    }, 50);
                } else {
                    card.style.transform = 'scale(0.8)';
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
}

/* ==========================================
   CONTACT FORM VALIDATION
   ========================================== */
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    
    const nameInput = document.getElementById('form-name');
    const emailInput = document.getElementById('form-email');
    const phoneInput = document.getElementById('form-phone');
    const messageInput = document.getElementById('form-message');
    
    // Realtime indicators
    const validateField = (input, regex, errorEl) => {
        if (!input) return false;
        const isValid = regex.test(input.value.trim());
        if (input.value.trim() === '') {
            input.classList.remove('valid', 'invalid');
            if (errorEl) errorEl.style.display = 'none';
            return false;
        }
        if (isValid) {
            input.classList.remove('invalid');
            input.classList.add('valid');
            if (errorEl) errorEl.style.display = 'none';
            return true;
        } else {
            input.classList.remove('valid');
            input.classList.add('invalid');
            if (errorEl) errorEl.style.display = 'block';
            return false;
        }
    };
    
    if (nameInput) {
        nameInput.addEventListener('input', () => {
            validateField(nameInput, /^.{3,50}$/, document.getElementById('name-error'));
        });
    }
    
    if (emailInput) {
        emailInput.addEventListener('input', () => {
            validateField(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, document.getElementById('email-error'));
        });
    }
    
    if (phoneInput) {
        phoneInput.addEventListener('input', () => {
            validateField(phoneInput, /^[0-9+\s-]{8,15}$/, document.getElementById('phone-error'));
        });
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const isNameValid = validateField(nameInput, /^.{3,50}$/, document.getElementById('name-error'));
        const isEmailValid = validateField(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, document.getElementById('email-error'));
        const isPhoneValid = validateField(phoneInput, /^[0-9+\s-]{8,15}$/, document.getElementById('phone-error'));
        
        let isMsgValid = true;
        if (messageInput && messageInput.value.trim().length < 10) {
            messageInput.classList.add('invalid');
            const msgError = document.getElementById('message-error');
            if (msgError) msgError.style.display = 'block';
            isMsgValid = false;
        } else if (messageInput) {
            messageInput.classList.remove('invalid');
            messageInput.classList.add('valid');
            const msgError = document.getElementById('message-error');
            if (msgError) msgError.style.display = 'none';
        }

        if (isNameValid && isEmailValid && isPhoneValid && isMsgValid) {
            // Get language
            const lang = document.documentElement.getAttribute('lang') || 'ar';
            
            // Direct WhatsApp Submission
            const phone = "966550000000"; // Target official whatsapp
            const text = encodeURIComponent(
                `Robotsoft Contact Form:\n` +
                `- Name: ${nameInput.value.trim()}\n` +
                `- Email: ${emailInput.value.trim()}\n` +
                `- Phone: ${phoneInput.value.trim()}\n` +
                `- Message: ${messageInput.value.trim()}`
            );
            
            // Show Success Modal
            const successTitle = lang === 'ar' ? 'تم الإرسال بنجاح!' : 'Sent Successfully!';
            const successBody = lang === 'ar' 
                ? 'شكراً لتواصلك مع Robotsoft ERP. سنقوم بتوجيهك الآن إلى الواتساب لإكمال المحادثة أو التواصل المباشر مع الدعم الفني.' 
                : 'Thank you for contacting Robotsoft ERP. We will redirect you to WhatsApp for direct chat support.';
            
            openCustomModal(successTitle, successBody, 'success');
            
            setTimeout(() => {
                window.open(`https://wa.me/${phone}?text=${text}`, '_blank');
                form.reset();
                [nameInput, emailInput, phoneInput, messageInput].forEach(el => {
                    if (el) el.classList.remove('valid', 'invalid');
                });
            }, 2000);
        }
    });
}

/* ==========================================
   MODAL MANAGER
   ========================================== */
function initModals() {
    const modalOverlay = document.getElementById('modal-overlay');
    const modalClose = document.getElementById('modal-close');
    const triggers = document.querySelectorAll('[data-modal-target]');
    
    if (!modalOverlay) return;
    
    const closeModal = () => {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    };
    
    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }
    
    modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
            closeModal();
        }
    });
    
    triggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            const target = trigger.getAttribute('data-modal-target');
            const lang = document.documentElement.getAttribute('lang') || 'ar';
            
            if (target === 'demo-modal') {
                const title = lang === 'ar' ? 'طلب عرض توضيحي (Demo)' : 'Request a Live Demo';
                const body = `
                    <form id="demo-form" class="reveal" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div>
                            <label class="form-label">${lang === 'ar' ? 'الاسم بالكامل' : 'Full Name'}</label>
                            <input type="text" id="demo-name" class="form-control" required placeholder="${lang === 'ar' ? 'أدخل اسمك الكريم' : 'Enter your name'}">
                        </div>
                        <div>
                            <label class="form-label">${lang === 'ar' ? 'اسم المنشأة' : 'Company Name'}</label>
                            <input type="text" id="demo-company" class="form-control" required placeholder="${lang === 'ar' ? 'أدخل اسم شركتك' : 'Enter company name'}">
                        </div>
                        <div>
                            <label class="form-label">${lang === 'ar' ? 'البريد الإلكتروني' : 'Email Address'}</label>
                            <input type="email" id="demo-email" class="form-control" required placeholder="name@company.com">
                        </div>
                        <div>
                            <label class="form-label">${lang === 'ar' ? 'رقم الهاتف' : 'Phone Number'}</label>
                            <input type="tel" id="demo-phone" class="form-control" required placeholder="+966 50 000 0000">
                        </div>
                        <div>
                            <label class="form-label">${lang === 'ar' ? 'النظام المطلوب تجربة' : 'System to Demo'}</label>
                            <select id="demo-system" class="form-control" style="background-image: none;">
                                <option value="accounting">${lang === 'ar' ? 'النظام المحاسبي والمالي' : 'Accounting & Finance'}</option>
                                <option value="hr">${lang === 'ar' ? 'نظام الموارد البشرية والرواتب' : 'HR & Payroll'}</option>
                                <option value="pos">${lang === 'ar' ? 'نقاط البيع POS' : 'Points of Sale'}</option>
                                <option value="crm">${lang === 'ar' ? 'إدارة علاقات العملاء CRM' : 'Customer Relationship'}</option>
                                <option value="inventory">${lang === 'ar' ? 'إدارة المستودعات والمخازن' : 'Inventory Management'}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; border: none; margin-top: 1rem;">
                            ${lang === 'ar' ? 'إرسال طلب التجربة' : 'Submit Request'}
                        </button>
                    </form>
                `;
                openCustomModal(title, body, 'form');
                
                // Add validation to demo form
                const demoForm = document.getElementById('demo-form');
                if (demoForm) {
                    demoForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const demoTitle = lang === 'ar' ? 'تم استلام طلبك!' : 'Request Received!';
                        const demoBody = lang === 'ar'
                            ? 'شكراً لاهتمامك بـ Robotsoft ERP. سيقوم أحد مهندسي المبيعات بالتواصل معك خلال 24 ساعة لتحديد موعد العرض التجريبي.'
                            : 'Thank you for your interest. A sales engineer will contact you within 24 hours to schedule your demo.';
                        openCustomModal(demoTitle, demoBody, 'success');
                    });
                }
            } else if (target === 'system-modal') {
                const systemKey = trigger.getAttribute('data-system');
                const systemData = getSystemDetail(systemKey, lang);
                if (systemData) {
                    const content = `
                        <div class="modal-header-visual">
                            ${systemData.icon}
                        </div>
                        <h3 class="modal-title">${systemData.title}</h3>
                        <p class="modal-body-text" style="margin-bottom: 1.5rem;">${systemData.desc}</p>
                        <h4 style="margin-bottom: 0.75rem; color: var(--primary); font-weight:700;">${lang === 'ar' ? 'أبرز الخصائص والمميزات:' : 'Key Features & Capabilities:'}</h4>
                        <ul style="list-style: circle; padding-left: 1.5rem; margin-bottom: 2rem; line-height:1.8; color: var(--text-secondary);">
                            ${systemData.features.map(f => `<li>${f}</li>`).join('')}
                        </ul>
                        <div style="display: flex; gap: 1rem;">
                            <a href="#" data-modal-target="demo-modal" class="btn btn-primary" style="flex:1; text-align:center;">${lang === 'ar' ? 'طلب تجربة مجانية' : 'Request Free Demo'}</a>
                            <button onclick="document.getElementById('modal-overlay').classList.remove('active')" class="btn btn-secondary">${lang === 'ar' ? 'إغلاق' : 'Close'}</button>
                        </div>
                    `;
                    openCustomModal(systemData.title, content, 'system');
                    
                    // Re-bind demo modal triggers created inside
                    const newTriggers = document.querySelectorAll('.modal-window [data-modal-target]');
                    newTriggers.forEach(nt => {
                        nt.addEventListener('click', (ev) => {
                            ev.preventDefault();
                            closeModal();
                            setTimeout(() => {
                                triggerDemoModal(lang);
                            }, 300);
                        });
                    });
                }
            }
        });
    });
}

function triggerDemoModal(lang) {
    const title = lang === 'ar' ? 'طلب عرض توضيحي (Demo)' : 'Request a Live Demo';
    const body = `
        <form id="demo-form" class="reveal" style="display: flex; flex-direction: column; gap: 1.25rem;">
            <div>
                <label class="form-label">${lang === 'ar' ? 'الاسم بالكامل' : 'Full Name'}</label>
                <input type="text" id="demo-name" class="form-control" required placeholder="${lang === 'ar' ? 'أدخل اسمك الكريم' : 'Enter your name'}">
            </div>
            <div>
                <label class="form-label">${lang === 'ar' ? 'اسم المنشأة' : 'Company Name'}</label>
                <input type="text" id="demo-company" class="form-control" required placeholder="${lang === 'ar' ? 'أدخل اسم شركتك' : 'Enter company name'}">
            </div>
            <div>
                <label class="form-label">${lang === 'ar' ? 'البريد الإلكتروني' : 'Email Address'}</label>
                <input type="email" id="demo-email" class="form-control" required placeholder="name@company.com">
            </div>
            <div>
                <label class="form-label">${lang === 'ar' ? 'رقم الهاتف' : 'Phone Number'}</label>
                <input type="tel" id="demo-phone" class="form-control" required placeholder="+966 50 000 0000">
            </div>
            <div>
                <label class="form-label">${lang === 'ar' ? 'النظام المطلوب تجربة' : 'System to Demo'}</label>
                <select id="demo-system" class="form-control" style="background-image: none;">
                    <option value="accounting">${lang === 'ar' ? 'النظام المحاسبي والمالي' : 'Accounting & Finance'}</option>
                    <option value="hr">${lang === 'ar' ? 'نظام الموارد البشرية والرواتب' : 'HR & Payroll'}</option>
                    <option value="pos">${lang === 'ar' ? 'نقاط البيع POS' : 'Points of Sale'}</option>
                    <option value="crm">${lang === 'ar' ? 'إدارة علاقات العملاء CRM' : 'Customer Relationship'}</option>
                    <option value="inventory">${lang === 'ar' ? 'إدارة المستودعات والمخازن' : 'Inventory Management'}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; border: none; margin-top: 1rem;">
                ${lang === 'ar' ? 'إرسال طلب التجربة' : 'Submit Request'}
            </button>
        </form>
    `;
    openCustomModal(title, body, 'form');
    
    const demoForm = document.getElementById('demo-form');
    if (demoForm) {
        demoForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const demoTitle = lang === 'ar' ? 'تم استلام طلبك!' : 'Request Received!';
            const demoBody = lang === 'ar'
                ? 'شكراً لاهتمامك بـ Robotsoft ERP. سيقوم أحد مهندسي المبيعات بالتواصل معك خلال 24 ساعة لتحديد موعد العرض التجريبي.'
                : 'Thank you for your interest. A sales engineer will contact you within 24 hours to schedule your demo.';
            openCustomModal(demoTitle, demoBody, 'success');
        });
    }
}

function openCustomModal(title, content, type) {
    const modalOverlay = document.getElementById('modal-overlay');
    const modalContent = document.getElementById('modal-content');
    
    if (!modalOverlay || !modalContent) return;
    
    if (type === 'success') {
        modalContent.innerHTML = `
            <div style="text-align: center; padding: 2rem 1rem;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: #10b981; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:40px; height:40px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="modal-title">${title}</h3>
                <p class="modal-body-text" style="color: var(--text-secondary); margin-bottom: 2rem;">${content}</p>
                <button onclick="document.getElementById('modal-overlay').classList.remove('active')" class="btn btn-primary" style="padding: 0.75rem 2rem;">موافق / OK</button>
            </div>
        `;
    } else if (type === 'form' || type === 'system') {
        modalContent.innerHTML = content;
    } else {
        modalContent.innerHTML = `
            <h3 class="modal-title">${title}</h3>
            <div class="modal-body-text">${content}</div>
        `;
    }
    
    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

/* ==========================================
   ERP SYSTEMS DATA CATALOG
   ========================================== */
function getSystemDetail(key, lang) {
    const systems = {
        accounting: {
            ar: {
                title: "النظام المحاسبي والمالي المتكامل",
                desc: "نظام مالي متكامل مصمم خصيصاً لتلبية متطلبات الشركات الكبرى ومكاتب المحاسبة. يوفر النظام إدارة شاملة للحسابات العامة، مراكز التكلفة، القيود اليومية الآلية واليدوية، وميزان المراجعة مع إصدار تقارير ختامية وضرائبية متوافقة بالكامل مع هيئة الزكاة والضريبة والجمارك والربط المباشر (الفاتورة الإلكترونية - المرحلة الثانية).",
                features: [
                    "شجرة حسابات مرنة ومتعددة المستويات.",
                    "إصدار تلقائي للقيود المحاسبية من الحركات التشغيلية كالمبيعات والمشتريات.",
                    "إدارة التدفقات النقدية ومطابقات البنوك الآلية.",
                    "إقرارات ضريبة القيمة المضافة الجاهزة بنقرة واحدة.",
                    "تعدد العملات وأسعار الصرف الحية."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`
            },
            en: {
                title: "Comprehensive Accounting & Financial System",
                desc: "A powerful, fully-integrated financial suite designed for enterprise accounting. Manages general ledgers, multi-level cost centers, automatic journal entries, and dynamic trial balances, with complete ZATCA Phase 2 E-invoicing integration and tax compliance in the Gulf region.",
                features: [
                    "Flexible multi-tier Chart of Accounts.",
                    "Automated journal generation from operational workflows (sales, payroll, inventory).",
                    "Cashflow management and automatic bank reconciliation.",
                    "One-click VAT calculation and tax return generation.",
                    "Multi-currency support with dynamic conversion rates."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`
            }
        },
        sales: {
            ar: {
                title: "إدارة المبيعات والعملاء",
                desc: "أتمتة كاملة لدورة المبيعات من عروض الأسعار والاتفاقيات، مروراً بأوامر البيع وطلبات التوريد، وحتى الفواتير النهائية ومرتجعات البيع. يتكامل تماماً مع نظام المستودعات والمالية لتحديث الأرصدة والقيود بشكل لحظي.",
                features: [
                    "متابعة دورة عرض السعر وتتبع حالة الموافقة.",
                    "إصدار الفواتير الإلكترونية المتوافقة مع متطلبات هيئة الزكاة الفاتورة المبسطة والضريبية.",
                    "قوائم أسعار مرنة وسياسات خصومات وائتمان مخصصة لكل عميل.",
                    "تتبع عمولات المندوبين ومناطق التوزيع.",
                    "تقارير تفصيلية لتحليلات المبيعات ونسب الربحية."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>`
            },
            en: {
                title: "Sales & Account Management",
                desc: "Complete automation of your sales cycle from sales quotations, orders, credit approvals to final invoices and returns. Seamless integration with inventory and finance modules assures instant ledger and stock updates.",
                features: [
                    "Track quotation cycles and multi-level approvals.",
                    "ZATCA compliant simplified and standard tax e-invoicing.",
                    "Flexible pricing lists, customer-specific discounts, and credit limits.",
                    "Salesperson commissions tracking and distribution logistics.",
                    "Detailed sales analytics and profitability dashboards."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>`
            }
        },
        purchases: {
            ar: {
                title: "إدارة المشتريات والموردين",
                desc: "أدوات متطورة لإدارة سلسلة التوريد ودورة المشتريات بدءاً من طلبات الشراء الداخلية، مقارنات أسعار الموردين، أوامر الشراء، الاستلام الفعلي بالمخازن وفواتير المشتريات الآجلة والنقدية.",
                features: [
                    "مقارنة آلية لعروض أسعار الموردين واختيار الأفضل.",
                    "نظام اعتمادات شراء مرن بناءً على قيم الطلبات والإدارات.",
                    "ربط مباشر مع المخازن لإنشاء أذونات الإضافة فور الاستلام.",
                    "تسوية حسابات الموردين والدفعات المقدمة.",
                    "تقييم أداء الموردين من حيث جودة التوريد والالتزام بالمواعيد."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>`
            },
            en: {
                title: "Procurement & Supplier Management",
                desc: "Advanced tools to govern procurement and supply chain. Handles internal requisition requests, supplier quotation comparisons, purchase orders, goods receipt notes (GRN), and supplier invoicing.",
                features: [
                    "Automated comparison matrix for supplier quotes.",
                    "Hierarchical approval workflows based on purchase limits.",
                    "Direct linking to GRN for instant warehouse receipt registration.",
                    "Supplier account reconciliation and advance payments tracking.",
                    "Supplier performance rating (delivery speed, product quality)."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>`
            }
        },
        inventory: {
            ar: {
                title: "إدارة المخازن والمستودعات",
                desc: "تحكم كامل ومطلق في المخزون وحركات السلع والمواد الخام. يدعم النظام تعدد المخازن، والربط الجغرافي، وحساب تكلفة المخزون (متوسط التكلفة، FIFO)، والباركود والترميز الدولي، مع أذونات الصرف والإضافة والتسويات الجردية الدورية.",
                features: [
                    "تتبع المنتجات بالرقم التسلسلي (Serial Number) وتاريخ الصلاحية (Batch Number).",
                    "عمليات الجرد الآلي عبر قارئ الباركود أو الأجهزة المحمولة.",
                    "أتمتة طلبات التحويل بين الفروع والمستودعات.",
                    "إشعارات ذكية لحد إعادة الطلب لتفادي نفاد المخزون.",
                    "مصفوفات الأصناف المعقدة (المقاس، اللون، الحجم)."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>`
            },
            en: {
                title: "Inventory & Warehouse Management",
                desc: "Complete, absolute control over stocks and raw materials. Supports multi-warehouse setups, location mapping, inventory valuation (Average Cost, FIFO), barcoding, dynamic item tracking, internal transfers, and cyclic inventory checks.",
                features: [
                    "Product tracking via serial numbers and batch expiration dates.",
                    "Automated stocktakes using barcode scanners or mobile PDA.",
                    "Inter-branch/warehouse transfer order workflows.",
                    "Smart reorder point notifications to prevent stockouts.",
                    "Complex item variants management (size, color, dimension)."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>`
            }
        },
        assets: {
            ar: {
                title: "إدارة الأصول الثابتة",
                desc: "نظام مخصص لتتبع الأصول الثابتة للشركة وتسجيل مواقعها، وحساب الإهلاك التلقائي بناءً على الطرق المحاسبية المختلفة (القسط الثابت، المتناقص)، وإثبات عمليات الصيانة، الاستبعاد والبيع للأصل.",
                features: [
                    "تعريف الأصول وربطها بمراكز التكلفة والموظفين المسؤولين.",
                    "احتساب الإهلاك الشهري والسنوي تلقائياً وتوليد قيودها في النظام المالي.",
                    "تتبع تكاليف الصيانة وقطع الغيار المضافة لقيمة الأصل.",
                    "إثبات الاستبعاد، التكهين، والبيع والربح أو الخسارة الرأسمالية.",
                    "ترميز الأصول بملصقات الباركود والـ QR لسهولة الجرد السنوي."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>`
            },
            en: {
                title: "Fixed Assets Management",
                desc: "Track company equipment, property, and physical assets. Automates monthly/yearly depreciation using standard methods (Straight Line, Declining Balance), updates asset values, and logs service, disposals, and asset sales.",
                features: [
                    "Asset profiling with cost center and custodian assignments.",
                    "Automated depreciation run and auto-generated financial journal entries.",
                    "Maintains maintenance history and cost additions to asset book values.",
                    "Registers asset write-offs, scrapping, sales, and capital gains/losses.",
                    "Assets tagging via Barcode/QR labels for quick annual audits."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>`
            }
        },
        hr: {
            ar: {
                title: "إدارة الموارد البشرية والرواتب",
                desc: "حل متكامل لإدارة رأس المال البشري للشركة من التوظيف، شؤون الموظفين، الحضور والانصراف (الربط المباشر مع أجهزة البصمة)، طلبات الإجازات والتذاكر، وحتى احتساب مسيرات الرواتب المتوافقة مع نظام حماية الأجور بالكامل.",
                features: [
                    "ملف متكامل للموظف يشمل العقود والوثائق الرسمية وتنبيهات انتهاء الإقامات والرخص.",
                    "دورة الموافقات والاعتمادات الذاتية للطلبات (إجازة، سلفة، تفويض).",
                    "حساب الرواتب والبدلات، التأمينات الاجتماعية، وحسميات الغياب والتأخير آلياً.",
                    "إصدار ملف الأجور (WPS) المعتمد للبنوك السعودية والخليجية بنقرة واحدة.",
                    "تقييم الأداء السنوي ومتابعة مؤشرات كفاءة الموارد البشرية."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>`
            },
            en: {
                title: "HR & Payroll Management",
                desc: "A complete solution to manage your organization's human capital. Streamlines recruitment, core employee profiles, biometric attendance machine integration, leave workflows, and payroll calculations aligned with local Wage Protection Systems (WPS).",
                features: [
                    "Comprehensive employee profiles with contract docs and document expiry alerts.",
                    "Self-service workflow approvals (leaves, loans, letters).",
                    "Automated payroll calculation with allowances, social insurance, and lateness penalties.",
                    "One-click WPS payroll file generation accepted by major banks.",
                    "Performance appraisals (KPIs) and HR analytics."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>`
            }
        },
        crm: {
            ar: {
                title: "نظام إدارة علاقات العملاء CRM",
                desc: "تنظيم تواصل المبيعات مع العملاء المحتملين وتتبع الفرص البيعية، أداء خدمة العملاء، وتاريخ المحادثات والاتصالات لتحويل العملاء المحتملين إلى صفقات رابحة بفعالية متناهية.",
                features: [
                    "إدارة العملاء المهتمين (Leads) ومصادرهم (موقع، حملات إعلانية).",
                    "أتمتة ومراقبة قمع المبيعات (Sales Pipeline) من البداية للإغلاق.",
                    "تذكيرات وتنبيهات ذكية للمتابعات الهاتفية والاجتماعات.",
                    "إصدار تذاكر الدعم الفني وحل مشاكل العملاء وتتبع سرعة الاستجابة.",
                    "تكامل مع البريد الإلكتروني والـ SMS والواتساب المباشر."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>`
            },
            en: {
                title: "CRM - Customer Relationship Management",
                desc: "Systemize lead tracking, sales pipelines, client relationships, and customer care history. Empower your sales representatives to nurture prospects and convert leads into closed deals smoothly.",
                features: [
                    "Lead management with source attribution (website, ads, social).",
                    "Interactive Sales Pipeline with drag-and-drop phases.",
                    "Smart notifications for follow-up calls, emails, and meetings.",
                    "Customer support ticketing system with SLA response tracking.",
                    "Integrations with Email, SMS, and WhatsApp messaging APIs."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>`
            }
        },
        pos: {
            ar: {
                title: "نقاط البيع السحابية POS",
                desc: "واجهة فائقة السرعة وسهلة الاستخدام لنقاط البيع في قطاعات التجزئة والمطاعم والكافيهات. يعمل النظام بكفاءة تامة أوفلاين (بدون إنترنت) مع مزامنة لحظية للبيانات فور عودة الاتصال، ويدعم الربط المباشر مع جميع الأجهزة والشبكات.",
                features: [
                    "متوافق بنسبة 100% مع الفوترة الإلكترونية والـ QR code من هيئة الزكاة.",
                    "يدعم العمل بدون إنترنت ومزامنة البيانات في الخلفية.",
                    "يتكامل مع أجهزة الدفع ببطاقات الائتمان، موازين الباركود، وطابعات الفواتير.",
                    "دورة إقفال الصناديق اليومية وإدارة عجز وفوائض الخزائن.",
                    "إدارة الطاولات للمطاعم وتوصيل الطلبات وتتبع السائقين."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`
            },
            en: {
                title: "Cloud-Based POS Systems",
                desc: "High-performance interface for retail stores, supermarkets, restaurants, and cafes. Runs offline with automatic background sync when internet connection is restored, connecting directly to POS hardware.",
                features: [
                    "Fully compliant with ZATCA Phase 1 & 2 e-invoicing. QR codes on all receipt thermal printouts.",
                    "Offline-first design ensuring smooth sales without internet drop interruptions.",
                    "Hardware integrations: card payment terminals, barcode scales, and cash drawers.",
                    "Daily shift closure management, cash audits, and register control.",
                    "Table management, kitchen display systems (KDS), and delivery driver tracking."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>`
            }
        },
        manufacturing: {
            ar: {
                title: "التصنيع والإنتاج",
                desc: "إدارة خطوط الإنتاج والعمليات الصناعية للمصانع والورش. يوفر النظام تخطيط الاحتياجات من المواد الخام (MRP)، تتبع مراحل التصنيع، وإصدار أوامر الإنتاج الفعلية وتحميل الأجور المباشرة وغير المباشرة على المنتج النهائي.",
                features: [
                    "إنشاء هيكل المنتج (BOM - Bill of Materials) المعقد ومتعدد المستويات.",
                    "تخطيط الاحتياجات من المواد (MRP) بناءً على مستويات الطلب والمخزون الحالي.",
                    "مراقبة مراحل الإنتاج الفعلي في صالة التصنيع وتحديث المراحل خطوة بخطوة.",
                    "توزيع وحساب التكاليف غير المباشرة (كهرباء، إيجارات، أجور إشرافية) على المنتجات.",
                    "مراقبة الجودة وفحوصات المواد الخام والمنتجات النهائية."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>`
            },
            en: {
                title: "Manufacturing & Assembly",
                desc: "Drive production planning and shop floor operations. Includes multi-level Material Requirements Planning (MRP), routing controls, work order executions, quality checks, and automated calculations of direct/indirect overhead costs on finished goods.",
                features: [
                    "Multi-level Bill of Materials (BOM) creation and cloning.",
                    "Automated Material Requirements Planning (MRP) scheduling based on order forecasts.",
                    "Shop floor routing control and work-in-progress (WIP) tracking.",
                    "Indirect overhead cost allocations (energy, factory leases, supervisor wages).",
                    "Quality assurance (QA) inspection checkpoints for raw items and final units."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>`
            }
        },
        projects: {
            ar: {
                title: "إدارة المشاريع والأنشطة",
                desc: "تخطيط المشاريع وإدارة المهام وتتبع الموارد البشرية والمادية المستهلكة في كل مشروع. يتكامل النظام تماماً مع المبيعات والمستودعات والرواتب لحساب ربحية المشاريع وإصدار تقارير نسبة الإنجاز والمقارنة بين المخطط والفعلي.",
                features: [
                    "تخطيط المهام وتوزيعها ورسم مخططات Gantt التفاعلية لنسب التقدم.",
                    "تتبع التكاليف الفعلية ومقارنتها بالميزانية التقديرية المحددة سلفاً.",
                    "تسجيل ساعات عمل الموظفين (Time Sheets) وتكلفة العمل المباشر.",
                    "إصدار فواتير المشاريع بناءً على نسب الإنجاز أو الدفعات التعاقدية.",
                    "تتبع مراحل تسليم البنود والمستندات الهندسية والفنية للمشاريع."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>`
            },
            en: {
                title: "Project & Task Management",
                desc: "Plan complex operations, outline task milestones, allocate resources, and oversee project financials. Fully synced with procurement, timesheets, and invoicing to deliver real-time gross margin figures and Gantt progress charts.",
                features: [
                    "Task assignment, dependencies mapping, and interactive Gantt charts.",
                    "Cost tracking (actuals vs initial budget estimates).",
                    "Employee timesheet tracking linked directly to direct labor cost records.",
                    "Milestone-based invoicing and progress billing.",
                    "Document management for project contracts, blueprints, and approvals."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>`
            }
        },
        archiving: {
            ar: {
                title: "الأرشفة الإلكترونية ونظام إدارة الوثائق DMS",
                desc: "تخلص من المعاملات الورقية تماماً عبر أرشفة جميع وثائق المؤسسة وفواتيرها وعقودها في نظام سحابي آمن يدعم تقنيات التعرف البصري على النصوص (OCR) والبحث الذكي وتحديد صلاحيات الوصول الفائقة للمستخدمين.",
                features: [
                    "تخزين سحابي غير محدود بهيكل مجلدات شجري مرن.",
                    "نظام صلاحيات وصول مشددة على مستوى المستند أو المجلد الفرعي.",
                    "تقنية التعرف الضوئي على الحروف (OCR) للبحث داخل النصوص والمستندات المصورة.",
                    "تتبع تعديلات المستندات والنسخ التاريخية (Version Control) لحماية البيانات.",
                    "ربط المستندات المؤرشفة بالقيود المحاسبية أو فواتير المشتريات والعملاء مباشرة."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>`
            },
            en: {
                title: "Electronic Archiving & DMS",
                desc: "Transition to a paperless enterprise. Store, index, and secure company agreements, invoices, and employee records in a cloud storage framework backed by OCR text searching and multi-role user accessibility rules.",
                features: [
                    "Unlimited cloud repository with customizable directory paths.",
                    "Fine-grained access rights (view, edit, delete, export) per document/folder.",
                    "Built-in OCR technology to index text inside scanned PDF images.",
                    "Document version control, audit trails, and file locking logs.",
                    "Directly attach documents to accounting vouchers, sales invoices, or employee profiles."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>`
            }
        },
        bi: {
            ar: {
                title: "ذكاء الأعمال والتقارير المتقدمة BI",
                desc: "لوحات تحكم ذكية وقابلة للتخصيص تجمع البيانات التشغيلية والمالية من جميع الأنظمة لعرض مؤشرات الأداء الرئيسية (KPIs) وتقارير الأرباح والخسائر ونسب الإنتاج في الوقت الفعلي لدعم اتخاذ القرار الإداري السليم.",
                features: [
                    "لوحات تحكم تفاعلية رسومية (Charts, Heatmaps) قابلة للتخصيص بالكامل.",
                    "مؤشرات أداء مالية وتجارية حية يتم تحديثها لحظة بلحظة.",
                    "تقارير مقارنة بين أداء الفروع المختلفة أو نقاط البيع المختلفة.",
                    "توليد وجدولة إرسال التقارير اليومية والأسبوعية تلقائياً لبريد الإدارة.",
                    "محرك تنبؤات ذكي يعتمد على البيانات التاريخية للمبيعات والطلب."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>`
            },
            en: {
                title: "Business Intelligence & BI Reporting",
                desc: "Dynamic reporting consoles and KPI dashboards consolidating data from all ERP modules. Provides C-level management with real-time profitability graphs, sales forecasts, and operational health summaries for proactive decision-making.",
                features: [
                    "Interactive graphic charts, heatmaps, and financial analytics templates.",
                    "Real-time corporate KPI trackers updated every minute.",
                    "Cross-branch performance comparison reports.",
                    "Schedule automated reports (daily, weekly, monthly) delivered to executive inboxes.",
                    "Predictive intelligence using historical database records."
                ],
                icon: `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>`
            }
        }
    };
    return systems[key] ? systems[key][lang] : null;
}
