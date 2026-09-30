/**
 * ============================================================
 *  Robotsoft ERP - Admin Panel JavaScript v2.0
 *  Professional Enterprise Dashboard Interactions
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', () => {

    // ============================================================
    // 1. THEME MANAGEMENT (Dark / Light Mode)
    // ============================================================
    const themeToggleBtn = document.getElementById('theme-toggle');
    const savedTheme = localStorage.getItem('admin_theme') || 'dark';
    document.documentElement.setAttribute('data-admin-theme', savedTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const current = document.documentElement.getAttribute('data-admin-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-admin-theme', next);
            localStorage.setItem('admin_theme', next);
            showToast(next === 'dark' ? 'تم التبديل إلى الوضع الليلي 🌙' : 'تم التبديل إلى الوضع النهاري ☀️', 'info');
        });
    }

    // ============================================================
    // 2. SIDEBAR TOGGLE (Desktop Collapse & Mobile Slide-In)
    // ============================================================
    const sidebarToggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');

    if (sidebarToggleBtn && sidebar) {
        sidebarToggleBtn.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('mobile-open');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar_collapsed', document.body.classList.contains('sidebar-collapsed'));
            }
        });

        // Restore sidebar state on desktop
        if (window.innerWidth > 992 && localStorage.getItem('sidebar_collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
    }

    // Close mobile sidebar when clicking outside
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 992 && sidebar && sidebar.classList.contains('mobile-open')) {
            if (!sidebar.contains(e.target) && sidebarToggleBtn && !sidebarToggleBtn.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        }
    });

    // ============================================================
    // 3. USER PROFILE DROPDOWN
    // ============================================================
    const userProfileBtn = document.getElementById('user-profile-btn');
    const userDropdown = document.getElementById('user-dropdown');

    if (userProfileBtn && userDropdown) {
        userProfileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target) && !userProfileBtn.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }

    // ============================================================
    // 4. MODAL SYSTEM (CRUD Operations)
    // ============================================================
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            // Focus first input in modal
            setTimeout(() => {
                const firstInput = modal.querySelector('input:not([type="hidden"]):not([type="checkbox"]), textarea, select');
                if (firstInput) firstInput.focus();
            }, 150);
        }
    };

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    // Close modal on overlay click
    document.querySelectorAll('.admin-modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Close modal on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.admin-modal-overlay.active').forEach(modal => {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
    });

    // ============================================================
    // 5. DYNAMIC TABLE SEARCH / FILTER
    // ============================================================
    const searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(input => {
        const tableId = input.getAttribute('data-table-search');
        const table = document.getElementById(tableId);
        if (!table) return;

        let debounceTimer;
        input.addEventListener('keyup', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const filter = input.value.toLowerCase().trim();
                const rows = table.querySelectorAll('tbody tr');
                let visibleCount = 0;

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const matches = !filter || text.includes(filter);
                    row.style.display = matches ? '' : 'none';
                    if (matches) visibleCount++;
                });

                // Update count badge if exists
                const countBadge = document.querySelector('.table-card-title .row-count');
                if (countBadge && filter) {
                    countBadge.textContent = ` (${visibleCount} نتيجة)`;
                } else if (countBadge) {
                    countBadge.textContent = '';
                }
            }, 200);
        });

        // Clear search on escape
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                input.value = '';
                input.dispatchEvent(new Event('keyup'));
            }
        });
    });

    // ============================================================
    // 6. FLASH ALERT AUTO-DISMISS
    // ============================================================
    const alerts = document.querySelectorAll('.flash-alert');
    alerts.forEach((alert, idx) => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 600);
        }, 5000 + (idx * 500));
    });

    // ============================================================
    // 7. TOAST NOTIFICATION SYSTEM
    // ============================================================
    window.showToast = function(message, type = 'success', duration = 3500) {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.style.cssText = `
                position: fixed;
                bottom: 1.5rem;
                left: 1.5rem;
                z-index: 9999;
                display: flex;
                flex-direction: column;
                gap: 0.6rem;
                max-width: 340px;
            `;
            document.body.appendChild(container);
        }

        const icons = {
            success: '✅',
            error:   '❌',
            warning: '⚠️',
            info:    'ℹ️',
        };
        const colors = {
            success: 'var(--success)',
            error:   'var(--danger)',
            warning: 'var(--warning)',
            info:    'var(--primary)',
        };

        const toast = document.createElement('div');
        toast.style.cssText = `
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-right: 4px solid ${colors[type] || colors.info};
            border-radius: 10px;
            padding: 0.85rem 1.1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            transform: translateX(-20px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.875rem;
            color: var(--text-primary);
            font-family: var(--font-arabic);
            cursor: pointer;
        `;
        toast.innerHTML = `
            <span style="font-size:1.1rem; flex-shrink:0; margin-top:1px;">${icons[type] || icons.info}</span>
            <span style="flex:1; line-height:1.5;">${message}</span>
        `;
        toast.addEventListener('click', () => removeToast(toast));
        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                toast.style.transform = 'translateX(0)';
                toast.style.opacity = '1';
            });
        });

        // Auto-remove
        const timer = setTimeout(() => removeToast(toast), duration);

        function removeToast(el) {
            clearTimeout(timer);
            el.style.transform = 'translateX(-20px)';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 350);
        }

        return toast;
    };

    // ============================================================
    // 8. DELETE CONFIRMATION WITH BETTER UX
    // ============================================================
    document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', (e) => {
            const msg = form.getAttribute('data-confirm') || 'هل أنت متأكد من هذا الإجراء؟';
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    });

    // ============================================================
    // 9. STATUS BADGE UPDATE (AJAX for quick status toggle)
    // ============================================================
    document.querySelectorAll('[data-status-form]').forEach(select => {
        select.addEventListener('change', function() {
            const form = this.closest('form');
            if (form) form.submit();
        });
    });

    // ============================================================
    // 10. COUNTER ANIMATION FOR STAT CARDS
    // ============================================================
    const statValues = document.querySelectorAll('.stat-value[data-target]');
    if (statValues.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        statValues.forEach(el => observer.observe(el));
    }

    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const duration = 1200;
        const start = performance.now();
        const startVal = 0;

        function step(timestamp) {
            const elapsed = timestamp - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(startVal + (target - startVal) * eased);
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    // ============================================================
    // 11. ACTIVE NAV HIGHLIGHT (additional check)
    // ============================================================
    const currentPath = window.location.pathname;
    document.querySelectorAll('.menu-item').forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentPath.startsWith(href) && href !== '/admin') {
            item.classList.add('active');
        }
    });

    // ============================================================
    // 12. TOOLTIP SYSTEM (title attribute enhancement)
    // ============================================================
    document.querySelectorAll('[title]').forEach(el => {
        // Native title works fine, just ensure data-title fallback
        if (!el.getAttribute('data-title')) {
            el.setAttribute('data-title', el.getAttribute('title'));
        }
    });

    // ============================================================
    // 13. FORM SUBMISSION LOADING STATE
    // ============================================================
    document.querySelectorAll('form:not([data-no-loading])').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جارٍ الحفظ...';

                // Restore after 8 seconds as failsafe
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 8000);
            }
        });
    });

});
